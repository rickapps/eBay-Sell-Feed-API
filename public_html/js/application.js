// Move contents of accordian block one to block two
// whenever block two is shown.
let uploadAcc = document.getElementById("collapseTwo");
uploadAcc.addEventListener("shown.bs.collapse", function () {
    source = document.getElementById('selectFile');
    // Copy contents to block two
    val = source.options[source.selectedIndex].value
    dest = document.getElementById('uploadName');
    dest.value = val;
    // If we don't have a value, disable the upload button
    if (!val) {
        sub = document.getElementById('upload');
        sub.disabled = true;
    }
});
