<?php
  // We will periodically ask eBay for task updates until our task
  // has reached its final state. The update requests will be made
  // client side via javascript.

  // Check if we got our task
  isset($_GET['task']) ? $location = $_GET['task'] : $location = "";
  if ($location)
  {
    $eBayRep = new eBayrepository(AUTHORIZATION, REFRESHTOKEN);
    // Get the status of our upload and notify the user
    $out = $eBayRep->getResults($location);
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
<h2>Results Page</h2>
<div>
    <!-- Form -->
    <form method='post' action=''>
        <div class="form-group row py-2">
            <div class='col-sm-9'>
            <input type="text" class="form-control" value=<?php echo '"' . $location . '"' ?> id="taskid" name="taskid" readonly>
            <input type="text" class="form-control" value=<?php echo '"' . $status . '"' ?> id="status" name="status" readonly>
            </div>
            <div class='col-sm-3'>
                <button type="button" class="btn btn-primary" id="btnUpdate">Update</button>
            </div>
        </div>
    </form>
    <!-- Upload results --->
    <div class="form-group row py-2">
        <div class="col-sm-12">
            <select name="results" id="results" class="selectpicker form-control" size="8">  
            </select>  
        </div>
    </div>
</div><!-- End Body -->
