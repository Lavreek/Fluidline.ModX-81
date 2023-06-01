<?php
global $modx;

$imageTv = 1;
$context = "prd";
$parent = 0;
$published = 1;

$format = "SELECT msc.`id`, `pagetitle` as `title`, `value` as `src` FROM `modx_site_content` AS msc INNER JOIN `modx_site_tmplvar_contentvalues` AS mstc ON msc.`id` = mstc.`contentid` WHERE `tmplvarid` = %s AND `context_key` = '%s' AND `parent` = %s AND `published` = %s";
$query = sprintf($format, $imageTv,  $context, $parent, $published);
$find = $modx->query($query);

if (!is_bool($find)) {
    $resources = $find->fetchAll(PDO::FETCH_ASSOC);
    $htmlProductCards = "";

    if (!is_bool($resources)) {
        foreach ($resources as $resource) {
            $resource['alt'] = $resource['title'];

            $htmlProductCards .= $modx->getChunk('productCard', $resource);
        }
        return $modx->getChunk('productView', ['cards' => $htmlProductCards]);
    }
} else {
    return null;
}