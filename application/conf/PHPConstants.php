<?php
// Error reporting. Overrides our php.ini
ini_set("display_errors", 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('WINDOWS', false);
define('SITE_URL', 'http://localhost/');
define('CURL_PGM', '/usr/bin/curl');
define('SELLER_ID', 'MySellID');
define('AUTHORIZATION', 'base64 authorization token goes here');

// Where to locate our export files
define('OUT_FOLDER', PROJECT_ROOT . '/public_html/export/');
define('OUT_FILE', 'eBayExchange.csv');
?>