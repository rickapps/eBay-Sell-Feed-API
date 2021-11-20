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
?>