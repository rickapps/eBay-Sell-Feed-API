<?php
// Error reporting. Overrides our php.ini
ini_set("display_errors", 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('WINDOWS', false);
define('SITE_URL', 'http://feedapi/');
define('CURL_PGM', '/usr/bin/curl');
define('AUTHORIZATION', 'base64 authorization token goes here');
define('REFRESHTOKEN', 'token for a specific eBay user goes here');

// Where to find our export files
define('OUT_FOLDER', PROJECT_ROOT . '/public_html/export/');
// List all file extensions we will allow for upload
define('FILE_TYPES', 'csv');

?>