<?php
/**********************************************
 * @author RickApps
 * @link https://github.com/rickapps/eBay-Sell-Feed-API
 * @license http://opensource.org/licenses/MIT MIT License
***********************************************/
// Get a reference path so we can locate our include files
define('PROJECT_ROOT', realpath(dirname(__FILE__) . "/../"));
require PROJECT_ROOT . '/application/conf/PHPConstants.php';
require PROJECT_ROOT . '/application/libs/Utilities.php';
require PROJECT_ROOT . '/application/libs/eBayRepository.php';

$targetURL = SITE_URL . "index.php";
if (isset($_POST['upload'])) 
{
    $eBayRep = new eBayrepository(AUTHORIZATION, REFRESHTOKEN);
    $file = OUT_FOLDER . "uploadListings.csv";
    $taskID = $eBayRep->sendToEbay($file);
    $targetURL = $targetURL . "?Task=" . $taskID;
}
redirect($targetURL);