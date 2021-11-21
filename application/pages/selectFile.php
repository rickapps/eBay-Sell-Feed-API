<?php $fileList = getFileList(OUT_FOLDER, FILE_TYPES); ?>

<h3>Select file to upload</h3>

<div class="d-flex gap-5 justify-content-center" id="dropdownMacos">
  <select class="form-select" aria-label="Select file to upload">
    <?php
      foreach ($fileList as $file) {
        echo "<option value=\"$file\">$file</option>"; 
      }
      if (count($fileList) == 0) {
        echo "<option value=\"\">No csv files found.</option>";
      }
    ?>
  </select>
</div>
<form action=<?php echo SITE_URL ?> enctype="multipart/form-data" method="post">
    <!-- Note that the onchange event could be blocked. Some browsers do not allow form to be submitted using javascript. -->
    <input type="file" multiple style="display: none;" id="files" name="files" onchange="this.form.submit();" />
    <input type="button" value="Add File..." class="btn btn-primary" onclick="document.getElementById('files').click();" />
</form>  
