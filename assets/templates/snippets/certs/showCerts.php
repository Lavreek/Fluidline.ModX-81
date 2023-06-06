<?php
global $modx;

function getIdByPagetitle(modX $modx, int|string $parent, string $name, string $another) : array|null|bool
{
    $request = $modx->query(
        sprintf("SELECT `id` FROM `modx_site_content` WHERE `parent` = %s AND `pagetitle` IN ('%s', '%s') ORDER BY `id` ASC LIMIT 1;", $parent, $name, $another)
    );

    if (is_bool($request)) {
        return null;
    }

    return $request->fetch(PDO::FETCH_ASSOC);
}

$aboutName = "О компании";
$aboutNameAnother = "Company";

$findAbout = getIdByPagetitle($modx, 0, $aboutName, $aboutNameAnother);
if (is_null($findAbout) or is_bool($findAbout)) {
    return null;
}

$certName = "Сертификаты";
$certNameAnother = "Certificates";

$findCerts = getIdByPagetitle($modx, $findAbout['id'], $certName, $certNameAnother);

if (is_null($findCerts) or is_bool($findCerts)) {
    return null;
}

$certResources = $modx->query(
    sprintf(" SELECT `id`, `pagetitle`, `content` FROM `modx_site_content` WHERE `parent` = %s LIMIT 5;", $findCerts['id'])
);

if (is_bool($certResources)) {
    return null;

} else {
    $certs = $certResources->fetchAll(PDO::FETCH_ASSOC);

    $htmlCerts = "";

    foreach ($certs as $cert) {
        $htmlCerts .= $modx->getChunk('certsItem', $cert);
    }

    return $modx->getChunk('certsGrid', ['items' => $htmlCerts]);
}