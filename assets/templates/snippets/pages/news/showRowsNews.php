<?php
global $modx;

$newsName = "Новости";
$newsNameAnother = "News";

$findNews = $modx->query(
    sprintf("SELECT `id` FROM `modx_site_content` WHERE `parent` = 0 AND `pagetitle` IN ('%s', '%s')", $newsName, $newsNameAnother)
);

if (is_bool($findNews)) {
    return null;
}

$news = $findNews->fetch(PDO::FETCH_ASSOC);

$newsQuery = " SELECT `id`, `pagetitle`, `longtitle`, `publishedon`, `introtext` FROM `modx_site_content` WHERE `parent` = %s ORDER BY `menuindex` DESC";

$findNewsResources = $modx->query(
    sprintf($newsQuery, $news['id'])
);

if (!is_bool($findNewsResources)) {
    $newsResources = $findNewsResources->fetchAll(PDO::FETCH_ASSOC);

    $htmlNews = "";

    foreach ($newsResources as $news) {
        $findNewsParams = $modx->query(
            sprintf("SELECT `tmplvarid`, `value` FROM `modx_site_tmplvar_contentvalues` WHERE `contentid` = %s", $news['id'])
        );

        if (!is_bool($findNewsParams)) {
            $params = $findNewsParams->fetchAll();

            foreach ($params as $param) {
                switch ($param['tmplvarid']) {
                    case pageImage : {
                        $news += ['pageImage' => $param['value']];
                        break;
                    }
                }
            }
        }

        $news['publishedon'] = date("d.m.Y", $news['publishedon']);

        $htmlNews .= $modx->getChunk('newsRowItem', $news);
    }

    return $modx->getChunk('newsRowView', ['items' => $htmlNews]);

} else {
    return null;
}