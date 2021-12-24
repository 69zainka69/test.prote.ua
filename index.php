<?php
ini_set('session.gc_maxlifetime', 120960);
ini_set('session.cookie_lifetime', 120960);
//$start = microtime(true);
ini_set('display_errors', 1);
error_reporting(E_ALL);
//echo microtime(true)-$start.'-10<br>';



/*if (preg_match('/apple|baidu|bingbot|facebookexternalhit|googlebot|-google|ia_archiver|msnbot|naverbot|pingdom|seznambot|slurp|teoma|twitter|yandex|yeti/i', $_SERVER['HTTP_USER_AGENT'])) {
    //$bot = false;
} else if (preg_match('/bot|crawl|curl|dataprovider|search|get|spider|find|java|majesticsEO|google|yahoo|teoma|contaxe|yandex|libwww-perl|facebookexternalhit/i', $_SERVER['HTTP_USER_AGENT'])) {
    exit;
}*/

/*function _bot_detected() {

  return (
    isset($_SERVER['HTTP_USER_AGENT'])
    && preg_match('/bot|crawl|slurp|spider|mediapartners/i', $_SERVER['HTTP_USER_AGENT'])
  );
}*/

if (isset($_SERVER['HTTP_USER_AGENT'])) {
    //$res = preg_match('/bot|crawl|slurp|spider|mediapartners/i', $_SERVER['HTTP_USER_AGENT']);
    //$res = preg_match('/bot|crawl|slurp|spider|mediapartners/i', $_SERVER['HTTP_USER_AGENT']);
    $res = preg_match('/bingbot|AdBot|search.com.ua|Cliqzbot|Applebot|crawl|slurp|Mail.RU|mail.ru|Miralinks|spider|mediapartners|SemrushBot|FatBot|MJ12bot|AhrefsBot|Riddler|aiHitBot|trovitBot|Detectify|BLEXBot|LinkpadBot|dotbot|FlipboardProxy|email|PycURL/i', $_SERVER['HTTP_USER_AGENT']);
    //wget|

    if ($res) {

        $handle = fopen('/var/www/test.prote.ua/HTTP_USER_AGENT_block_log.txt', 'a');
        fwrite($handle, date('Y-m-d G:i:s') . "\n");
        fwrite($handle, date('Y-m-d G:i:s') . ' - HTTP_USER_AGENT ' . print_r($_SERVER['HTTP_USER_AGENT'], true) . "\n");
        fwrite($handle, date('Y-m-d G:i:s') . ' - REMOTE_ADDR = ' . print_r($_SERVER['REMOTE_ADDR'], true) . "\n");
        if (isset($_SERVER['HTTP_REFERER'])) {
            fwrite($handle, ' - HTTP_REFERER = ' . print_r($_SERVER['HTTP_REFERER'], true) . "\n");
        }
        fwrite($handle, date('Y-m-d G:i:s') . ' - QUERY_STRING = ' . print_r($_SERVER['QUERY_STRING'], true) . "\n\n");
        fclose($handle);


        //header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
        exit;
    } else {
     
    }
}

define('VERSION', '2.1.0.2');
if ($_SERVER['HTTP_HOST'] == 'barva.ua' || $_SERVER['HTTP_HOST'] == 'patron.ua') {
    header("Location: http://" . $_SERVER['HTTP_HOST'], true, 301);
    die();
}

if (is_file('config.php')) {
    require_once('config.php');
}

require_once(DIR_SYSTEM . 'startup.php');

$registry = new Registry();

$loader = new Loader($registry);
$registry->set('load', $loader);

$config = new Config();
$registry->set('config', $config);

$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
$registry->set('db', $db);

if (isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1'))) {
    $store_query = $db->query("SELECT * FROM " . DB_PREFIX . "store WHERE REPLACE(`ssl`, 'www.', '') = '" . $db->escape('https://' . str_replace('www.', '', $_SERVER['HTTP_HOST']) . rtrim(dirname($_SERVER['PHP_SELF']), '/.\\') . '/') . "'");
} else {
    $store_query = $db->query("SELECT * FROM " . DB_PREFIX . "store WHERE REPLACE(`url`, 'www.', '') = '" . $db->escape('http://' . str_replace('www.', '', $_SERVER['HTTP_HOST']) . rtrim(dirname($_SERVER['PHP_SELF']), '/.\\') . '/') . "'");
}

if ($store_query->num_rows) {
    $config->set('config_store_id', $store_query->row['store_id']);
} else {
    $config->set('config_store_id', 0);
}
$query = $db->query("SELECT * FROM `" . DB_PREFIX . "setting` WHERE store_id = '0' OR store_id = '" . (int)$config->get('config_store_id') . "' ORDER BY store_id ASC");

foreach ($query->rows as $result) {
    if (!$result['serialized']) {
        $config->set($result['key'], $result['value']);
    } else {
        $config->set($result['key'], json_decode($result['value'], true));
    }
}

if (!$store_query->num_rows) {
    $config->set('config_url', HTTP_SERVER);
    $config->set('config_ssl', HTTPS_SERVER);
}

$url = new Url($config->get('config_url'), $config->get('config_secure') ? $config->get('config_ssl') : $config->get('config_url'));
$registry->set('url', $url);

$log = new Log($config->get('config_error_filename'));
$registry->set('log', $log);

function error_handler($code, $message, $file, $line)
{
    global $log, $config;

    if (error_reporting() === 0) {
        return false;
    }

    switch ($code) {
        case E_NOTICE:
        case E_USER_NOTICE:
            $error = 'Notice';
            break;
        case E_WARNING:
        case E_USER_WARNING:
            $error = 'Warning';
            break;
        case E_ERROR:
        case E_USER_ERROR:
            $error = 'Fatal Error';
            break;
        default:
            $error = 'Unknown';
            break;
    }

    if ($config->get('config_error_display')) {
        echo '<b>' . $error . '</b>: ' . $message . ' in <b>' . $file . '</b> on line <b>' . $line . '</b>';
    }

    if ($config->get('config_error_log')) {
        $log->write('PHP ' . $error . ':  ' . $message . ' in ' . $file . ' on line ' . $line);

    }

    return true;
}

set_error_handler('error_handler');

$request = new Request();
$registry->set('request', $request);

$response = new Response();
$response->addHeader('Content-Type: text/html; charset=utf-8');
$response->setCompression($config->get('config_compression'));
$registry->set('response', $response);

// Cache
/*
$cache = new Cache();
$registry->set('cache', $cache);
*/
//Redis 
$cache = new Cache('redis');
$registry->set('cache', $cache);

if (isset($request->get['token']) && isset($request->get['route']) && substr($request->get['route'], 0, 4) == 'api/') {
    $db->query("DELETE FROM `" . DB_PREFIX . "api_session` WHERE TIMESTAMPADD(HOUR, 1, date_modified) < NOW()");

    $query = $db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "api` `a` LEFT JOIN `" . DB_PREFIX . "api_session` `as` ON (a.api_id = as.api_id) LEFT JOIN " . DB_PREFIX . "api_ip `ai` ON (as.api_id = ai.api_id) WHERE a.status = '1' AND as.token = '" . $db->escape($request->get['token']) . "' AND ai.ip = '" . $db->escape($request->server['REMOTE_ADDR']) . "'");

    if ($query->num_rows) {
        // Does not seem PHP is able to handle sessions as objects properly so so wrote my own class
        $session = new Session($query->row['session_id'], $query->row['session_name']);
        $registry->set('session', $session);

        // keep the session alive
        $db->query("UPDATE `" . DB_PREFIX . "api_session` SET date_modified = NOW() WHERE api_session_id = '" . $query->row['api_session_id'] . "'");
    }
} else {
    $session = new Session();
    $registry->set('session', $session);
}
$languages = array();
$query = $db->query("SELECT * FROM `" . DB_PREFIX . "language` WHERE status = '1'");

foreach ($query->rows as $result) {
    $languages[$result['code']] = $result;
}
if (isset($request->get['lang'])) {
    $dataLanguage = $request->get['lang'];
}
else {
    $urlLanguage = '';
    $urlArray = explode("/", $request->server['REQUEST_URI']);
    foreach ($urlArray as $value) {
        if (array_key_exists($value, $languages)) {
            $urlLanguage = $value;
        }
    }
    if (!empty($urlLanguage)) {
        $dataLanguage = $urlLanguage;
    }
}

if (!empty($dataLanguage)) {
    $session->data['language'] = $dataLanguage;
}
if (isset($session->data['language']) && array_key_exists($session->data['language'], $languages)) {
    $code = $session->data['language'];
}
else {
    $code = $session->data['language'] = 'ru';
}
$config->set('config_language_id', $languages[$code]['language_id']);
$config->set('config_language', $languages[$code]['code']);
$language = new Language($languages[$code]['directory']);
$language->load($languages[$code]['directory']);
$registry->set('language', $language);
$registry->set('document', new Document());
$customer = new Customer($registry);
$registry->set('customer', $customer);
if ($customer->isLogged()) {
    $config->set('config_customer_group_id', $customer->getGroupId());
} elseif (isset($session->data['customer']) && isset($session->data['customer']['customer_group_id'])) {
    $config->set('config_customer_group_id', $session->data['customer']['customer_group_id']);
} elseif (isset($session->data['guest']) && isset($session->data['guest']['customer_group_id'])) {
    $config->set('config_customer_group_id', $session->data['guest']['customer_group_id']);
}

// Tracking Code
if (isset($request->get['tracking'])) {
    setcookie('tracking', $request->get['tracking'], time() + 3600 * 24 * 1000, '/');

    $db->query("UPDATE `" . DB_PREFIX . "marketing` SET clicks = (clicks + 1) WHERE code = '" . $db->escape($request->get['tracking']) . "'");
}

// Affiliate
$registry->set('affiliate', new Affiliate($registry));

// Currency
$registry->set('currency', new Currency($registry));

// Tax
$registry->set('tax', new Tax($registry));

// Weight
$registry->set('weight', new Weight($registry));

// Length
$registry->set('length', new Length($registry));

// Cart
$registry->set('cart', new Cart($registry));

// Encryption
$registry->set('encryption', new Encryption($config->get('config_encryption')));

// OpenBay Pro
$registry->set('openbay', new Openbay($registry));

// Event
$event = new Event($registry);
$registry->set('event', $event);

$query = $db->query("SELECT * FROM " . DB_PREFIX . "event");

foreach ($query->rows as $result) {
    $event->register($result['trigger'], $result['action']);
}
$controller = new Front($registry);
if (!$seo_type = $config->get('config_seo_url_type')) {
    $seo_type = 'seo_url';
}

$user = new User($registry);

if ($user->isLogged() && $user->getUserName() == 'Manis') {
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    include_once DIR_ROOT . 'function.php';
    define('ISADMIN', 'true');
} else {
    function vdump()
    {
    }

    define('ISADMIN', 'false');
}
//echo microtime(true)-$start.'-8<br>';
$controller->addPreAction(new Action('common/' . $seo_type));

// Router
if (isset($request->get['route'])) {
    $action = new Action($request->get['route']);
} else {
    $action = new Action('common/home');
}
$controller->dispatch($action, new Action('error/not_found'));
$response->output();
require_once('system/debug_after_index.php');