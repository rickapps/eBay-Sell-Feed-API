<?php
/**********************************************
 * @author RickApps
 * @link https://github.com/rickapps/eBay-Sell-Feed-API
 * @license http://opensource.org/licenses/MIT MIT License
***********************************************/
session_start();
// Get a reference path so we can locate our include files
define('PROJECT_ROOT', realpath(dirname(__FILE__) . "/../"));
require PROJECT_ROOT . '/application/conf/PHPConstants.php';
require PROJECT_ROOT . '/application/libs/Utilities.php';

$targetURL = SITE_URL . "index.php";
if (isset($_POST['add'])) 
{
    // We are uploading a file to our export folder.
    // This file can later be choosen to upload to eBay.
    $fileName = $_FILES['picker']['name'];
    $fileSize = $_FILES['picker']['size'];
    $fileTmpName  = $_FILES['picker']['tmp_name'];
    $fileType = $_FILES['picker']['type'];

    $PageMsg = addNewDatafile($fileName, $fileSize, $fileTmpName);
    $targetURL = $targetURL . "?resp=" . $PageMsg;
}
redirect($targetURL);
