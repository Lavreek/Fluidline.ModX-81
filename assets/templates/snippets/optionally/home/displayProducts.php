<?php
global $modx;

$context = "prd";
$parent = 0;
$published = 1;

$format = "SELECT `id`, `pagetitle` FROM `modx_site_content` WHERE `context_key` = '%s' AND `parent` = %s AND `published` = %s";
$query = sprintf($format, $context, $parent, $published);
$find = $modx->query($query);

if (!is_bool($find)) {
    $products = $find->fetchAll(PDO::FETCH_ASSOC);
    $htmlProductCards = "";

    foreach ($products as $product) {
        $productParams = $modx->query(
            sprintf("SELECT `tmplvarid`, `value` FROM `modx_site_tmplvar_contentvalues` WHERE `contentid` = %d", $product['id'])
        );

        if (!is_bool($productParams)) {
            $params = $productParams->fetchAll(PDO::FETCH_ASSOC);

            foreach ($params as $param) {
                switch ($param['tmplvarid']) {
                    case 1 : {
                        $product += ['src' => $param['value']];
                        break;
                    }
                    case 2 : {
                        $product += ['mini_description' => $param['value']];
                        break;
                    }
                }
            }
        }

        $product['alt'] = $product['pagetitle'];

        $htmlProductCards .= $modx->getChunk('productCard', $product);
    }

    return $modx->getChunk('productView', ['cards' => $htmlProductCards]);
} else {
    return null;
}