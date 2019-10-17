/******************************************************************************\
 Custom function by OnyxzeD
 \******************************************************************************/
// validate number input
function validateNumber(e) {
    if ($.inArray(e.keyCode, [8, 9, 35, 36, 37, 38, 39, 40, 46]) !== -1 || e.ctrlKey === true ||
        // Allow: home, end, left, right, down, up
        (e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
}