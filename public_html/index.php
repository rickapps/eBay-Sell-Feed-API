<?php
/**
 * Application to upload eBay bulk listings/orders using the Feed API.
 *
 * @author RickApps
 * @link https://rickapps.com
 * @license http://opensource.org/licenses/MIT MIT License
 */

// Get a reference path so we can locate our include files
define('PROJECT_ROOT', realpath(dirname(__FILE__) . "/../"));

// load application config (error reporting etc.)
// This will be the file PHPConstants.php or a copy. You need
// to modify this file before you run this app.
require PROJECT_ROOT . '/application/conf/PHPConstants.php';

// load our code
require PROJECT_ROOT . '/application/libs/Utilities.php';
require PROJECT_ROOT . '/application/libs/eBayRepository.php';

$PageTitle = "eBay Feed API Demo";

// Construct our view
include PROJECT_ROOT . '/application/pages/_templates/header.php';
include PROJECT_ROOT . '/application/pages/viewPage.php';
include PROJECT_ROOT . '/application/pages/_templates/footer.php';
