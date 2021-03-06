<?php
//setlocale(LC_CTYPE, "ukr");
//define('IS_DEBUG', true);
setlocale(LC_ALL, 'en_US.UTF-8');
define('IS_DEBUG', false);

define('HTTP_SERVER', 'https://test.prote.ua/');
define('HTTPS_SERVER', 'https://test.prote.ua/');
define('HTTPS_SERVER_ADMIN', 'https://test.prote.ua/adminka/');
define('USE_EXTERNAL_STATIC_SERVER', false);
define('EXTERNAL_STATIC_SERVER', '');
define('KEY_NP', '43e7a8f1a20d6bd3277cafc8081493a6');
define('GOOGLE_GEOCODING_KEY', 'AIzaSyCuS1fOzIT7eoShjF4GuQyx5NY0DNTS0-8');

// Memcache
//define('CACHE_DRIVER', 'memcached');
//define('MEMCACHE_HOSTNAME', 'localhost');
//define('MEMCACHE_PORT', '11211');
//define('MEMCACHE_NAMESPACE', 'prote');
//define('MEMCACHE_COMPRESSED', '');

// Redis
define('CACHE_DRIVER', 'redis');
define('CACHE_HOSTNAME', '127.0.0.1');
define('CACHE_PORT', '6379');
define('CACHE_PREFIX', 'rd_');
define('CACHE_PASSWORD', '');

// DIR
define('DIR_ROOT', '/var/www/prote/data/www/test.prote.ua/');
define('DIR_APPLICATION', DIR_ROOT.'catalog/');
define('DIR_CATALOG', DIR_ROOT.'catalog/');
define('DIR_SYSTEM', DIR_ROOT.'system/');
define('DIR_LANGUAGE', DIR_ROOT.'catalog/language/');
define('DIR_TEMPLATE', DIR_ROOT.'catalog/view/theme/');
define('DIR_CONFIG', DIR_ROOT.'system/config/');
define('DIR_IMAGE', DIR_ROOT.'image/');
define('DIR_CACHE', DIR_ROOT.'system/storage/cache/');
define('DIR_DOWNLOAD', DIR_ROOT.'system/storage/download/');
define('DIR_LOGS', DIR_ROOT.'system/storage/logs/');
define('DIR_MODIFICATION', DIR_ROOT.'system/storage/modification/');
define('DIR_UPLOAD', DIR_ROOT.'system/storage/upload/');
define('DIR_FILE', DIR_ROOT.'instructions/');

// Axapta docs
define('DIR_AX_DOCS', '/var/www/prote/data/www/new-partner.vm.ua/ax_docs/');
define('DIR_AX_DOCS_Description', '/var/www/prote/data/www/new-partner.vm.ua/ax_docs/Description/');
define('DIR_AX_DOCS_IMAGE', '/var/www/prote/data/www/new-partner.vm.ua/ax_docs/PhotoWeb/');
define('DIR_AX_DOCS_CERTIFICATE', '/var/www/prote/data/www/new-partner.vm.ua/ax_docs/Certificate/');
define('DIR_AX_DOCS_MANUAL', '/var/www/prote/data/www/new-partner.vm.ua/ax_docs/Manual/');

// DB

define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', '127.0.0.1');
define('DB_USERNAME', 'dima');
define('DB_PASSWORD', ';flyjcnm');
define('DB_DATABASE', 'prote.ua');
define('DB_PORT', '3306'); 
define('DB_PREFIX', 'oc_');

/*
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'internpm.beget.tech');
define('DB_USERNAME', 'internpm_prote');
define('DB_PASSWORD', 'QwertXz1');
define('DB_DATABASE', 'internpm_prote');
define('DB_PORT', '3306'); //mysql 8.0.19
define('DB_PREFIX', 'oc_');

*/



define('DO_DEBUG', '0');
define('SERVER_IP', '192.168.200.170');
define('SERVER_PORT', '8081');
define('DO_TRACE', '0');
define('LOG_DIR', DIR_ROOT.'system/storage/logs/');
define('AXAPTA_URL', 'http://192.168.200.170:8081/service/Service.asmx/daxProcessRequest');


define('DB_AX_DRIVER', 'mpdo');
//define('DB_AX_HOSTNAME', 'bee.vm.net');
define('DB_AX_HOSTNAME', '192.168.200.170');
define('DB_AX_USERNAME', 'partnersite');
define('DB_AX_PASSWORD', 'part#10_911');
define('DB_AX_DATABASE', 'VMDB-1');
define('DB_AX_PORT', '');


if(isset($import_prote)){
    define('DB_VM_HOSTNAME', '192.168.200.13');
    define('DB_VM_USERNAME', 'root');
    define('DB_VM_PASSWORD', 'RooT');
    define('DB_VM_DATABASE', 'vm');
    define('DB_VM_PORT', '3306');
}
//???? 22.04.2020 13:13:18
