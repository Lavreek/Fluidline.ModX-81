<?php

require_once dirname(__DIR__, 2) . "/vendor/autoload.php";

use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(dirname(__DIR__, 2) . '/.env');

$base_path = $_ENV['BASE_PATH'] ?: dirname(__DIR__, 2);

/**
 * Custom const variables
 */

const pageImage = 1;
const pageMiniDescription = 2;
const webinarDate = 3;
const eventsDateStart = 4;
const eventsDateEnd = 5;


/**
 *  MODX Configuration file
 */
$database_type = $_ENV['DATABASE_TYPE'];
$database_server = $_ENV['DATABASE_SERVER'];
$database_user = $_ENV['DATABASE_USER'];
$database_password = $_ENV['DATABASE_PASSWORD'];
$database_connection_charset = $_ENV['DATABASE_CONNECTION_CHARSET'];
$dbase = $_ENV['DATABASE_NAME'];
$table_prefix = $_ENV['TABLE_PREFIX'];
$database_dsn = $_ENV['DATABASE_DSN'];

$config_options = array();
$driver_options = array();

$lastInstallTime = 1684844842;

$site_id = 'modx646cb12a735c36.12783089';
$site_sessionname = 'SN646cb0e1a76f2';
$https_port = '443';
$uuid = '7a3e779c-440a-4df4-b6d9-094a796565d9';

if (!defined('MODX_BASE_PATH')) {
    $modx_base_path = $base_path . '/';
    $modx_base_url = '/';
    define('MODX_BASE_PATH', $modx_base_path);
    define('MODX_BASE_URL', $modx_base_url);
}

if (!defined('MODX_CORE_PATH')) {
    $modx_core_path = $base_path . '/core/';
    define('MODX_CORE_PATH', $modx_core_path);
}

if (!defined('MODX_MANAGER_PATH')) {
    $modx_manager_path = $base_path . "/manager/";
    $modx_manager_url = '/manager/';
    define('MODX_MANAGER_PATH', $modx_manager_path);
    define('MODX_MANAGER_URL', $modx_manager_url);
}

if (!defined('MODX_PROCESSORS_PATH')) {
    $modx_processors_path= $base_path . '/core/src/Revolution/Processors/';
    define('MODX_PROCESSORS_PATH', $modx_processors_path);
}

if (!defined('MODX_CONNECTORS_PATH')) {
    $modx_connectors_path= $base_path . '/connectors/';
    $modx_connectors_url= '/connectors/';
    define('MODX_CONNECTORS_PATH', $modx_connectors_path);
    define('MODX_CONNECTORS_URL', $modx_connectors_url);
}

if(defined('PHP_SAPI') && (PHP_SAPI == "cli" || PHP_SAPI == "embed")) {
    $isSecureRequest = false;
} else {
    $isSecureRequest = ((isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') || $_SERVER['SERVER_PORT'] == $https_port);
}

if (!defined('MODX_URL_SCHEME')) {
    $url_scheme=  $isSecureRequest ? 'https://' : 'http://';
    define('MODX_URL_SCHEME', $url_scheme);
}

if (!defined('MODX_HTTP_HOST')) {
    if(defined('PHP_SAPI') && (PHP_SAPI == "cli" || PHP_SAPI == "embed")) {
        $http_host='dev-fluid-line.ru';
        define('MODX_HTTP_HOST', $http_host);
    } else {
        $http_host= array_key_exists('HTTP_HOST', $_SERVER) ? htmlspecialchars($_SERVER['HTTP_HOST'], ENT_QUOTES) : $_ENV['APP_NAME'];
        if ($_SERVER['SERVER_PORT'] != 80) {
            $http_host = str_replace(':' . $_SERVER['SERVER_PORT'], '', $http_host); // remove port from HTTP_HOST
        }
        $http_host .= in_array($_SERVER['SERVER_PORT'], [80, 443]) ? '' : ':' . $_SERVER['SERVER_PORT'];
        define('MODX_HTTP_HOST', $http_host);
    }
}

if (!defined('MODX_SITE_URL')) {
    $site_url= $url_scheme . $http_host . MODX_BASE_URL;
    define('MODX_SITE_URL', $site_url);
}

if (!defined('MODX_ASSETS_PATH')) {
    $modx_assets_path= $base_path . '/assets/';
    $modx_assets_url= '/assets/';
    define('MODX_ASSETS_PATH', $modx_assets_path);
    define('MODX_ASSETS_URL', $modx_assets_url);
}

if (!defined('MODX_ENCORE_PATH')) {
    $modx_encore_path = $base_path . '/assets/templates/source/';
    $modx_encore_url = '/assets/templates/source/';
    define('MODX_ENCORE_PATH', $modx_encore_path);
    define('MODX_ENCORE_URL', $modx_encore_url);
}

if (!defined('MODX_LOG_LEVEL_FATAL')) {
    define('MODX_LOG_LEVEL_FATAL', 0);
    define('MODX_LOG_LEVEL_ERROR', 1);
    define('MODX_LOG_LEVEL_WARN', 2);
    define('MODX_LOG_LEVEL_INFO', 3);
    define('MODX_LOG_LEVEL_DEBUG', 4);
}
