<h3>Upload File to eBay</h3>
<form action=<?php print('"' . SITE_URL . 'uploadtoEbay.php"'); ?> method="post">
    <label for="uploadName">File selected to upload:</label>
    <input type="text" id=uploadName name="uploadName" readonly/>
    <input type="submit" value="Send to eBay" id="upload" name="upload" />
</form>  

