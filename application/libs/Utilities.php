<?php 
//===================================================//
// FUNCTION: getFileList                             //
//                                                   //
// Parameters:                                       //
//  - $root: The directory to process                //
//  - $file_types: the extensions of file types to   //
//                 to return if files selected       //
//===================================================//
function getFileList($root, $file_types=false) {
  $fileList = array();
  if ($file_types) { $file_types=explode(',',$file_types); }
  if ($handle = opendir($root)) {
    while (false !== ($file = readdir($handle))) {
      if ($file != "." && $file != "..") {
        if (is_dir($root . "/" . $file))
          continue;
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if ( !$file_types || in_array($ext, $file_types) ) {
          $fileList[] = $file;
        }
      }
    } // End While
    closedir($handle);
  } // End If
  return $fileList;
}

// Upload a file to our webserver. If it meets standards, 
// copy the datafile to our upload folder
function addNewDatafile($key)
{
  $msg = ""; 
  $fileTypes=explode(',',FILE_TYPES); 

  $fileName = $_FILES[$key]['name'];
  $fileSize = $_FILES[$key]['size'];
  $fileTmpName  = $_FILES[$key]['tmp_name'];
  $fileType = $_FILES[$key]['type'];
  $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

  $uploadPath = OUT_FOLDER . basename($fileName); 

  if (!in_array($fileExtension,$fileTypes)) 
  {
    $msg = "File not accepted. File extension must be " . FILE_TYPES;
  }
  elseif ($fileSize == 0) 
  {
    $msg = "File not accepted. File is empty";
  }
  elseif ($fileSize > 4000000) 
  {
    $msg = "File exceeds maximum size (4MB)";
  }
  elseif (move_uploaded_file($fileTmpName, $uploadPath)) 
  {
      $msg = "File added.";
  }
  else
  {
      $msg = "Your file could not be uploaded";
  }

  return $msg;
}

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