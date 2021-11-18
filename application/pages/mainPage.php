<div class="accordion" id="uploadToEbay">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Step 1: Select File to Upload
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#uploadToEbay">
      <div class="accordion-body">
        <?php include PROJECT_ROOT . '/application/pages/selectFile.php'; ?>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Step 2: Upload File to eBay
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#uploadToEbay">
      <div class="accordion-body">
      <?php include PROJECT_ROOT . '/application/pages/uploadFile.php'; ?>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Step 3: View Upload Results
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#uploadToEbay">
      <div class="accordion-body">
      <?php include PROJECT_ROOT . '/application/pages/viewResults.php'; ?>
      </div>
    </div>
  </div>
</div>