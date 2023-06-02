<?php
global $modx;

const eventName = "Мероприятия";
const eventNameAnother = "Events";
$parent = 0;

const eventsDateStart = 4;
const eventsDateEnd = 5;

$findEvents = $modx->query(
    sprintf("SELECT `id` FROM `modx_site_content` WHERE `pagetitle` IN ('%s', '%s') AND `parent` = %d", eventName, eventNameAnother, $parent)
);

if (is_bool($findEvents)) {
    return null;
}

$events = $findEvents->fetch(PDO::FETCH_ASSOC);

const eventsQuery = " SELECT `id`, `pagetitle` FROM `modx_site_content` WHERE `parent` = %s LIMIT 6";

$findEventsResources = $modx->query(
    sprintf(eventsQuery, $events['id'])
);

if (!is_bool($findEventsResources)) {
    $eventResources = $findEventsResources->fetchAll(PDO::FETCH_ASSOC);

    $htmlEvents = "";

    foreach ($eventResources as $event) {

        $findEventsParams = $modx->query(
            sprintf("SELECT `tmplvarid`, `value` FROM `modx_site_tmplvar_contentvalues` WHERE `contentid` = %s", $event['id'])
        );

        if (!is_bool($findEventsResources)) {
            $params = $findEventsParams->fetchAll();

            foreach ($params as $param) {
                switch ($param['tmplvarid']) {
                    case eventsDateStart : {
                        $event += ['date_start' => date("j", strtotime($param['value']))];
                        break;
                    }
                    case eventsDateEnd : {
                        $event += ['date_end' => date("j F Y", strtotime($param['value']))];
                        break;
                    }
                }
            }
        }

        $htmlEvents .= $modx->getChunk('showEventsItem', $event);
    }

    return $modx->getChunk('showEvents', ['events' => $htmlEvents]);

} else {
    return null;
}