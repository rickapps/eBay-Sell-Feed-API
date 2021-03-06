<?php 
  // Goal for the file upload form was to use one button to select the file and upload it.
  // Our 'Add File' button clicks the browse button on the invisible 'picker' field.
  // The invisible 'picker' field clicks the submit button when 'picker' changes value.
  // Can't use javascript to directly submit the upload form, have to to click submit button. 
  // Otherwise, $_POST array does not get populated. 
  // That's why we have invisible submit button, invisible 'picker' field. 
  // This probably could be improved with more testing, but it works for now 

   // Check if any selection message was passed in the url
  isset($_GET['resp']) ? $response = $_GET['resp'] : $response = Responses::None;
  $msg = GetMsg($response);

   // Get a list of all export files currently in our export folder
   $fileList = getFileList(OUT_FOLDER, FILE_TYPES); 
?>

<h3>Select file to upload</h3>

<div class="d-flex gap-5 justify-content-center" id="dropdownMacos">
  <select class="form-select" aria-label="Select file to upload" id="selectFile">
    <?php
      // Populate the drop down with our list of files.
      foreach ($fileList as $file) 
      {
        echo "<option value=\"$file\">$file</option>"; 
      }
      if (count($fileList) == 0) 
      {
        echo "<option value=\"\">No csv files found.</option>";
      }
    ?>
  </select>
</div>
<!-- Allow the user to upload additional files. These files will be added -->
<!-- to the drop down list after the form posts.                          -->
<form action=<?php print('"' . SITE_URL . 'addDatafile.php"'); ?> enctype="multipart/form-data" method="post">
    <input type="file" style="display: none;" id="picker" name="picker" onchange="document.getElementById('add').click();"/>
    <!-- If you don't give the submit button a name, $_POST does not get populated. -->
    <input type="submit" style="display: none;" id="add" name="add" />
    <input type="button" value="Add File..." class="btn btn-primary" onclick="document.getElementById('picker').click();" />
    <?php print("<em>" . $msg . "</em>"); ?>
</form>  
