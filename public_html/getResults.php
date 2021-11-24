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
