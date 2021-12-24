<?php
// HTTP
define('HTTP_SERVER', 'http://prote.demo.webbylab.com/adminka/');
define('HTTP_CATALOG', 'http://prote.demo.webbylab.com/');

// HTTPS
define('HTTPS_SERVER', 'http://prote.demo.webbylab.com/adminka/');
define('HTTPS_CATALOG', 'http://prote.demo.webbylab.com/');

define('CACHE_DRIVER', 'file');

// DIR
define('DIR_ROOT', '/var/www/prote.ua/');
define('DIR_APPLICATION', DIR_ROOT.'adminka/');
define('DIR_SYSTEM', DIR_ROOT.'system/');
define('DIR_LANGUAGE', DIR_ROOT.'adminka/language/');
define('DIR_TEMPLATE', DIR_ROOT.'adminka/view/template/');
define('DIR_CONFIG', DIR_ROOT.'system/config/');
define('DIR_IMAGE', DIR_ROOT.'image/');
define('DIR_CACHE', DIR_ROOT.'system/storage/cache/');
define('DIR_DOWNLOAD', DIR_ROOT.'system/storage/download/');
define('DIR_LOGS', DIR_ROOT.'system/storage/logs/');
define('DIR_MODIFICATION', DIR_ROOT.'system/storage/modification/');
define('DIR_UPLOAD', DIR_ROOT.'system/storage/upload/');
define('DIR_CATALOG', DIR_ROOT.'catalog/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'prote');
define('DB_PORT', '3306');
define('DB_PREFIX', 'oc_');
