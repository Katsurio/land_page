jQuery(document).ready(function ($) {
    $('#form').on('submit', function (e) {
        e.preventDefault();
        grabThenSendFormVals();
    });
});

/**
 * Grabs values from the form, then sends
 * them to the backend for processing.
 */
function grabThenSendFormVals() {
    let data = {
        fname: $('#fName').val(),
        lname: $('#lName').val(),
        email: $('#email').val(),
        zcode: $('#zip').val()
    };

    if(!data.fname || !data.lname || !data.email || !data.zcode) {
        return alert("Please ensure everything is filled out properly, thank you!");
    }
    jQuery.ajax({
        url: 'convertZipCode.php',
        data: data,
        method: 'POST',
        success: function (resp) {
            alert(resp);
        },
        error: function (resp) {
            alert("error: ", resp);
        }
    });
}
