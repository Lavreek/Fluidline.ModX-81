<?php
global $modx;

if (!isset($cols)) {
    $cols = 3;
}

$htmlDocs = "";

if (isset($titles)) {
    $titles = explode(';', $titles);

    for ($i = 0; $i < $cols; $i++) {
        $htmlDocs .= "<div style='padding-bottom: 26px;'>{$titles[$i]}</div>";
    }
}

if (!isset($documents)) {
    return null;
}

$documents = explode(';', $documents);

foreach ($documents as $document) {
    $htmlDocs .= $modx->getChunk('showDocsItem', ['pagetitle' => "", 'content' => $document, 'id' => uniqid()]);
}

return $modx->getChunk('showDocs', ['cols' => $cols, 'items' => $htmlDocs]);