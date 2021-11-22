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

if (isset($_POST['upload'])) 
{
    // We are uploading a file to our export folder.
    // This file can later be choosen to upload to eBay.
    $fileName = $_FILES['picker']['name'];
    $fileSize = $_FILES['picker']['size'];
    $fileTmpName  = $_FILES['picker']['tmp_name'];
    $fileType = $_FILES['picker']['type'];

    $PageMsg = addNewDatafile($fileName, $fileSize, $fileTmpName);
}
redirect(SITE_URL . "index.php?resp=" . $PageMsg);