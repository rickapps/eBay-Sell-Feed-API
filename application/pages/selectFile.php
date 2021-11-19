<h2>Select file to upload</h2>
<div class="d-flex gap-5 justify-content-center" id="dropdownMacos">
  <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-macos mx-0 border-0 shadow" style="width: 220px;">
    <li><a class="dropdown-item active" href="#">Action</a></li>
    <li><a class="dropdown-item" href="#">Another action</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="#">Separated link</a></li>
  </ul>
</div>
<form action="/Photo/UploadFiles" enctype="multipart/form-data" method="post">
    <input data-val="true" data-val-number="The field ItemID must be a number." data-val-required="The ItemID field is required." id="ItemID" name="ItemID" type="hidden" value="19142" />
    <!-- Note that the onchange event could be blocked. Some browsers do not allow form to be submitted using javascript. -->
    <input type="file" multiple style="display: none;" id="files" name="files" onchange="this.form.submit();" />
    <input type="button" value="Upload..." class="btn btn-primary" onclick="document.getElementById('files').click();" />
    <a class="btn btn-default" href="/Admin?ItemStatus=Active">Cancel and return to List</a>
</form>        