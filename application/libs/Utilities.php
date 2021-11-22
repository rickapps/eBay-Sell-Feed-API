<?php 
/**********************************************
 * @author RickApps
 * @link https://github.com/rickapps/eBay-Sell-Feed-API
 * @license http://opensource.org/licenses/MIT MIT License
***********************************************/

// After post requests, we always redirect back to our main page
function redirect($url) {
  ob_start();
  header('Location: '.$url);
  ob_end_flush();
  die();
}

// List all files in the root folder that have the extensions
// specified in file_types. 
function getFileList($root, $file_types=false) {
  $fileList = array();
  if ($file_types) { 
    $file_types=explode(',',$file_types); 
  }
  if ($handle = opendir($root)) 
  {
    while (false !== ($file = readdir($handle))) 
    {
      if ($file != "." && $file != "..") 
      {
        if (is_dir($root . "/" . $file))
          continue;
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if ( !$file_types || in_array($ext, $file_types) ) 
        {
          $fileList[] = $file;
        }
      }
    } // End While
    closedir($handle);
  } // End If
  return $fileList;
}

// Half baked attempt at error handling
abstract class Responses {
  const None = -1;
  const Success = 0;
  const BadExtension = 1;
  const EmptyFile = 2;
  const TooLarge = 3;
  const OtherError = 4;
}

// More half baked attempt at error handling
function GetMsg($err) {
  $msg = "";
  if ($err == Responses::Success)
  {
    $msg = "File added.";
  }
  elseif ($err == Responses::BadExtension)
  {
    $msg = "File not accepted. File extension must be " . FILE_TYPES;
  }
  elseif ($err == Responses::EmptyFile)
  {
    $msg = "File not accepted. File is empty";
  }
  elseif ($err == Responses::TooLarge)
  {
    $msg = "File exceeds maximum size (4MB)";
  }
  elseif ($err == Responses::OtherError)
  {
    $msg = "Your file could not be uploaded";
  }
  return $msg;
}

// Upload a file to our webserver. If it meets standards, 
// copy the datafile to our upload folder
function addNewDatafile($name, $size, $tmpName)
{
  $fileTypes=explode(',',FILE_TYPES); 

  $fileExtension = pathinfo($name, PATHINFO_EXTENSION);

  $uploadPath = OUT_FOLDER . basename($name); 

  if (!in_array($fileExtension,$fileTypes)) 
  {
    $result = Responses::BadExtension;
  }
  elseif ($size == 0) 
  {
    $result = Responses::EmptyFile;
  }
  elseif ($size > 4000000) 
  {
    $result = Responses::TooLarge;
  }
  elseif (move_uploaded_file($tmpName, $uploadPath)) 
  {
      $result = Responses::Success;
  }
  else
  {
      $result = Responses::OtherError;
  }

  return $result;
}

// Upload a datafile to eBay
function sendToEbay($dataFile)
{
    // Get a user token. It is generated when the one stored in SESSION has expired.
    $token = $ebayRep()->getUserToken();
    // Create a task for SellerHub
    $location = $eBayRep()->getTaskID($token);
    // Use our task to upload our export file
    $out = $eBayRep()->uploadFile($token, $location, $dataFile);
    // Get the status of our upload and notify the user
    $out = $eBayRep()->getUploadStatus($token, $location);
    // Parse our status results
    $val = json_decode($out);
    $task = $val->taskId;
    $status = $val->status;
    $loadCnt = $val->uploadSummary->successCount;
    $failCnt = $val->uploadSummary->failureCount;

    $fmt = "Task: %s<br>Status: %s<br>Listed: %s<br>Errors: %s";
    $msg = sprintf($fmt, $task, $status, $loadCnt, $failCnt);
    print($msg);
}
?>