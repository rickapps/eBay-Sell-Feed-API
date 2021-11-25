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
require PROJECT_ROOT . '/application/libs/eBayRepository.php';
// We are called in response to a post request. We return JSON
// containing the results of a prior file upload.
$targetURL = SITE_URL . "index.php";
if (isset($_GET['location'])) 
{
    $eBayRep = new eBayrepository(AUTHORIZATION, REFRESHTOKEN);
    $location = urldecode($_GET['location']);
    $response = $eBayRep->getResults($location);
    //Print out the array in a JSON format.
    header('Content-Type: application/json');
    echo $response;        
}
else
{
    redirect($targetURL);
}
