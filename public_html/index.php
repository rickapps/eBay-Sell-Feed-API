<?php
/**
 * Application to upload eBay bulk listings/orders using the Feed API.
 *
 * @author RickApps
 * @link https://rickapps.com
 * @license http://opensource.org/licenses/MIT MIT License
 */

// Modify the root to be wherever you cloned this project.
define('PROJECT_ROOT', '/home/rickapps/Exhibits/eBay-Sell-Feed-API');

// load application config (error reporting etc.)
// This will be the file PHPConstants.php or a copy. You need
// to modify this file before you run this app.
require PROJECT_ROOT . '/application/conf/PHPConstants.php';

// load application class
require PROJECT_ROOT . '/application/libs/eBayRepository.php';

// Construct our view
include PROJECT_ROOT . '/application/_templates/header.php';
include PROJECT_ROOT . '/application/pages/mainPage.php';
include PROJECT_ROOT . '/application/_templates/footer.php';
