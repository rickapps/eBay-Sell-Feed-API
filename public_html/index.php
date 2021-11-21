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

// load our code
require PROJECT_ROOT . '/application/libs/Utilities.php';
require PROJECT_ROOT . '/application/libs/eBayRepository.php';

$PageTitle = "eBay Feed API Demo";
$PageMsg = "";

if (isset($_POST['upload'])) 
{
    // We are uploading a file to our export folder.
    // This file can later be choosen to upload to eBay.
    $PageMsg = uploadFile('picker');
}

// Construct our view
include PROJECT_ROOT . '/application/pages/_templates/header.php';
include PROJECT_ROOT . '/application/pages/mainPage.php';
include PROJECT_ROOT . '/application/pages/_templates/footer.php';
