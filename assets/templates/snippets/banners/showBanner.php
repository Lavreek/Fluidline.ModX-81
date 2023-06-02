<?php
global $modx;

$resourceName = "Баннер";
$anotherName = "Banner";
$parent = 0;

if (!isset($show)) {
    return null;
}

$findBanner = $modx->query(
    sprintf("SELECT `id` FROM `modx_site_content` WHERE `pagetitle` IN ('%s', '%s') AND `parent` = %d", $resourceName, $anotherName, $parent)
);

if (!is_bool($findBanner)) {
    $find = $findBanner->fetch(PDO::FETCH_ASSOC);

    if (!is_bool($find)) {
        $banner = $modx->query(
            sprintf("SELECT `id`, `content`, `longtitle`, `description`, `introtext`  FROM `modx_site_content` WHERE `pagetitle` = '%s' AND `parent` = %d", $show, $find['id'])
        );

        if (!is_bool($banner)) {
            $bannerElement = $banner->fetch(PDO::FETCH_ASSOC);

            $bannerParams = $modx->query(
                sprintf("SELECT `tmplvarid`, `value`  FROM `modx_site_tmplvar_contentvalues` WHERE `contentid` = %s", $bannerElement['id'])
            );

            if (!is_bool($bannerParams)) {
                $paramResponse = $bannerParams->fetchAll(PDO::FETCH_ASSOC);

                foreach ($paramResponse as $param) {
                    switch ($param['tmplvarid']) {
                        case 1 : {
                            $bannerElement += ['src' => $param['value']];

                            $imageInfo = getimagesize(MODX_BASE_PATH . $param['value']);
                            $sizes = preg_match('#height=\"(\d+)\"#', $imageInfo[3], $size);
                            $bannerElement += ['height' => $size[1]];
                            break;
                        }
                    }
                }
            }
            return $modx->getChunk('showBanner', $bannerElement);
        }
    }
}