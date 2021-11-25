<?php
  // We will periodically ask eBay for task updates until our task
  // has reached its final state. The update requests will be made
  // client side via javascript.

  // Check if we got our task
  isset($_GET['task']) ? $location = $_GET['task'] : $location = "";
?>
<h3>Display Results</h3>
<div>
    <!-- Form -->
    <form method='post' action=''>
        <input type="text" style="display: none;" value=<?php echo '"' . $location . '"' ?> id="taskid" name="taskid">
        <button type="button" class="btn btn-primary" id="btnUpdate">Refresh</button>
    </form>
    <!-- Show results --->
    <div class="form-group row py-2">
        <div class="col-sm-12">
            <textarea rows=4 name="results" id="results" class="form-control" placeholder="No results" readonly></textarea>  
        </div>
    </div>
</div><!-- End Body -->
