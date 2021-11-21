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

// Upload a file to our webserver. If it meets standards, copy it to our upload folder
function uploadFile($key)
{
  $errors = []; // Store errors here
  $fileTypes=explode(',',FILE_TYPES); 

  $fileName = $_FILES[$key]['name'];
  $fileSize = $_FILES[$key]['size'];
  $fileTmpName  = $_FILES[$key]['tmp_name'];
  $fileType = $_FILES[$key]['type'];
  // Apparently, this is safer than just relying on $fileType.
  $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

  $uploadPath = OUT_FOLDER . basename($fileName); 

  if (!in_array($fileExtension,$fileTypes)) {
    $errors[] = "This file extension is not allowed. Please upload " . FILE_TYPES . " files";
  }

  if ($fileSize == 0) {
    $errors[] = "File is empty";
  }

  if ($fileSize > 4000000) {
    $errors[] = "File exceeds maximum size (4MB)";
  }

  if (empty($errors)) {
    if (move_uploaded_file($fileTmpName, $uploadPath)) {
      $errors[] = "File added";
    }
    else
    {
      $errors[] = "File could not be uploaded";
    }
  }
  return $errors;
}
?>