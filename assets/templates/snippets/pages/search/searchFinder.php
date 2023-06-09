<?php
global $modx;

if (isset($_GET['title'], $_GET['tag'])) {
    if ($title = $_GET['title'] and $tag = $_GET['tag']) {
        $queryParent = sprintf("SELECT `id` FROM `modx_site_content` WHERE `pagetitle` = '%s' LIMIT 1", $tag);
        $queryResource = sprintf("SELECT `uri` FROM `modx_site_content` WHERE `pagetitle` = '%s' AND parent = (%s) LIMIT 1", $title, $queryParent);

        $findRequest = $modx->query($queryResource);

        if (!is_bool($findRequest)) {
            $findResponse = $findRequest->fetch(PDO::FETCH_ASSOC);

            if (!is_bool($findResponse)) {
                header("Location: /" . $findResponse['uri']);

            }
        } else {
            return $modx->getChunk('searchResult');
        }
    }
}