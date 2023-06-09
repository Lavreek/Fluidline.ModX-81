<?php
global $modx;

$find = $modx->query("SELECT `id`, `pagetitle` FROM `modx_site_content` WHERE `published` = 1 AND `parent` = 40");

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
                    case pageImage : {
                        $product += ['pageImage' => $param['value']];
                        break;
                    }
                    case pageMiniDescription : {
                        $product += ['pageMiniDescription' => $param['value']];
                        break;
                    }
                }
            }
        }

        $htmlProductCards .= $modx->getChunk('productCard', $product);
    }

    return $modx->getChunk('productView', ['items' => $htmlProductCards]);
} else {
    return null;
}