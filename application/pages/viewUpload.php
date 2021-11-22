<?php

?>
<h3>Upload Page</h3>
<form action=<?php print('"' . SITE_URL . 'uploadtoEbay.php"'); ?> method="post">
    <input type="text" id=uploadName name="uploadName"/>
    <input type="submit" value="Send to eBay" id="upload" name="upload" />
</form>  

