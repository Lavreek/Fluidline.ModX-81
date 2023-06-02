<?php
global $modx;

$resourceName = "Вебинар";
$resourceAnotherName = "Webinar";
$parent = 0;

$findWebinars = $modx->query(
    sprintf("SELECT `id` FROM `modx_site_content` WHERE `pagetitle` IN ('%s', '%s') AND `parent` = %s", $resourceName, $resourceAnotherName, $parent)
);

if (is_bool($findWebinars)) {
    return null;
}

$webinars = $findWebinars->fetch(PDO::FETCH_ASSOC);

$htmlPlannedWebinars = getPlannedWebinars($modx, $webinars['id']);
$htmlCompletedWebinars = getCompletedWebinars($modx, $webinars['id']);

/**
 * @param modX $modx
 * @param $parent
 * @return string
 */
function getPlannedWebinars($modx, int|string $parent) : string
{
    $planned = "";

    $findPlanned = $modx->query(
        sprintf("SELECT `id`, `pagetitle`, `unpub_date` FROM `modx_site_content` WHERE `parent` = %s AND `unpub_date` <> 0 AND `published` = 1 ORDER BY unpub_date ASC LIMIT 4", $parent)
    );

    if (!is_bool($findPlanned)) {
        $plannedWebinars = $findPlanned->fetchAll(PDO::FETCH_ASSOC);
        foreach ($plannedWebinars as $webinar) {
            $webinar['unpub_date'] = date("j F", $webinar['unpub_date'] - 84600);
            $planned .= $modx->getChunk('showWebinarsItem', $webinar);
        }
    }

    return $planned;
}

function getCompletedWebinars($modx, $parent)
{
    $completed = "";

    $findCompleted = $modx->query(
        sprintf("SELECT `id`, `pagetitle` FROM `modx_site_content` WHERE `parent` = %s AND `published` = 0 ORDER BY unpub_date DESC LIMIT 4", $parent)
    );

    if (!is_bool($findCompleted)) {
        $completedWebinars = $findCompleted->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($completedWebinars as $webinar) {
            $completed .= $modx->getChunk('showWebinarsItem', $webinar);
        }
    }

    return $completed;
}



return $modx->getChunk('showWebinars', ['planned' => $htmlPlannedWebinars, 'completed' => $htmlCompletedWebinars]);