<?php
global $modx;

$findSlider = $modx->query("SELECT `id` FROM `modx_site_content` WHERE `pagetitle` IN ('Слайдер', 'Slider')");

if (!is_bool($findSlider)) {
    $find = $findSlider->fetch(PDO::FETCH_ASSOC);

    foreach ($modx->getChildIds($find['id']) as $slideID) {
        $request = $modx->query("SELECT `content` FROM `modx_site_content` WHERE `id` = $slideID");
        if (!is_bool($request)) {
            var_dump($request->fetch(PDO::FETCH_ASSOC));
        }
    }
} else {
    return null;
}