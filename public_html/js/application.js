/**********************************************
 * @author RickApps
 * @link https://github.com/rickapps/eBay-Sell-Feed-API
 * @license http://opensource.org/licenses/MIT MIT License
***********************************************/
// We use jquery to make it easier to post requests. Code without jquery is commented out.
$(document).ready(function() {
    // When the second accordian item expands, copy the name
    // of our selected upload file from section 1 to section 2.
    $('#collapseTwo').on('shown.bs.collapse', function () {
        var source = $('#selectFile').val();
        // Copy contents to block two
        $('#uploadName').val(source);
        // If we don't have a value, disable the upload button
        if (!source) {
            $('#upload').prop('disabled', true);
        }
    });

    // Send a post request to the server to get updated
    // upload results.
    $('#btnUpdate').click(function(){
        var location = encodeURIComponent($('#taskid').val().trim());
        if (location)
        {
            var results = $('#results');
            results.empty();
            $.getJSON('/getResults.php', {location: location}, function(data){
            var task = data.taskId;
            var status = data.status;
            var loadCnt = data.uploadSummary.successCount;
            var failCnt = data.uploadSummary.failureCount;
            var msg = 'Task: ' + task + '\r\nStatus: ' + status + '\r\nAdded: ' + loadCnt + '\r\nFailed: ' + failCnt;
            results.val(msg);
            });  
        }  
    });

})   
// Move contents of accordian block one to block two
// whenever block two is shown.
// let uploadAcc = document.getElementById("collapseTwo");
// uploadAcc.addEventListener("shown.bs.collapse", function () {
//     source = document.getElementById('selectFile');
//     // Copy contents to block two
//     val = source.options[source.selectedIndex].value
//     dest = document.getElementById('uploadName');
//     dest.value = val;
//     // If we don't have a value, disable the upload button
//     if (!val) {
//         sub = document.getElementById('upload');
//         sub.disabled = true;
//     }
// });

