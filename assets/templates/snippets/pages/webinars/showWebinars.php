<?php
global $modx;

const resourceName = "Вебинар";
const resourceAnotherName = "Webinar";
const parent = 0;

$findWebinars = $modx->query(
    sprintf("SELECT `id` FROM `modx_site_content` WHERE `pagetitle` IN ('%s', '%s') AND `parent` = %s", resourceName, resourceAnotherName, parent)
);

if (is_bool($findWebinars)) {
    return null;
}

$webinars = $findWebinars->fetch(PDO::FETCH_ASSOC);

const webinarQuery = "SELECT %s FROM `modx_site_content` AS msc ";
const webinarJoin = " INNER JOIN `modx_site_tmplvar_contentvalues` AS mstc ON msc.`id` = mstc.`contentid` ";
const webinarWhere = " WHERE mstc.`tmplvarid` = 3 AND msc.`published` = 1 AND mstc.`value` %s '%s' AND msc.`parent` = %s ";

const webinarRowLimit = 4;

$htmlPlannedWebinars = getPlannedWebinars($modx, $webinars['id']);
$htmlCompletedWebinars = getCompletedWebinars($modx, $webinars['id']);

/**
 * @param modX $modx
 * @param int|string $parent
 * @return string
 */
function getPlannedWebinars(modX $modx, int|string $parent) : string
{
    $planned = "";
    
    $selection = sprintf(webinarQuery, " msc.`id` AS id, `pagetitle`, `value` AS date ");
    $where = sprintf(webinarWhere, " > ", date("Y-m-d H:i:s"), $parent);
    $order = sprintf(" ORDER BY `value` %s ", " ASC ");
    $limit = sprintf(" LIMIT %d ", webinarRowLimit);

    $findPlanned = $modx->query(
        $selection . webinarJoin . $where . $order . $limit
    );

    if (!is_bool($findPlanned)) {
        $plannedWebinars = $findPlanned->fetchAll(PDO::FETCH_ASSOC);
        foreach ($plannedWebinars as $webinar) {
            $webinar['date'] = date("j F", strtotime($webinar['date']));
            $planned .= $modx->getChunk('showWebinarsItem', $webinar);
        }
    }

    return $planned;
}

/**
 * @param modX $modx
 * @param int|string $parent
 * @return void
 */
function getCompletedWebinars(modX $modx, int|string $parent) : string
{
    $completed = "";

    $selection = sprintf(webinarQuery, " msc.`id` AS id, `pagetitle` ");
    $where = sprintf(webinarWhere," < ", date("Y-m-d H:i:s"), $parent);
    $order = sprintf(" ORDER BY `value` %s ", " DESC ");
    $limit = sprintf(" LIMIT %d ", webinarRowLimit);

    $query = $selection . webinarJoin . $where . $order . $limit;
    $findCompleted = $modx->query($query);

    if (!is_bool($findCompleted)) {
        $completedWebinars = $findCompleted->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($completedWebinars as $webinar) {
            $completed .= $modx->getChunk('showWebinarsItem', $webinar);
        }
    }

    return $completed;
}

return $modx->getChunk('showWebinars', ['planned' => $htmlPlannedWebinars, 'completed' => $htmlCompletedWebinars]);