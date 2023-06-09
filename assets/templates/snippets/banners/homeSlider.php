<?php
global $modx;

$resourceName = "Слайдер";
$anotherName = "Slider";
$parent = 0;

$findSlider = $modx->query(
    sprintf("SELECT `id` FROM `modx_site_content` WHERE `pagetitle` IN ('%s', '%s') AND `parent` = %d", $resourceName, $anotherName, $parent)
);

if (!is_bool($findSlider)) {
    $find = $findSlider->fetch(PDO::FETCH_ASSOC);

    $htmlSlides = "";

    foreach ($modx->getChildIds($find['id']) as $loopIndex => $slideID) {
        $request = $modx->query("SELECT `content` as `src` FROM `modx_site_content` WHERE `id` = $slideID ORDER BY `menuindex` ASC");

        if (!is_bool($request)) {
            $response = $request->fetch(PDO::FETCH_ASSOC);

            if ($loopIndex == 0) {
                $response['class'] = " active";
            }

            $response['alt'] = sprintf("SLIDE %d", $loopIndex + 1);

            $htmlSlides .= $modx->getChunk('homeSliderItem', $response);
        }
    }
    return $modx->getChunk('homeSlider', ['items' => $htmlSlides]);
} else {
    return null;
}