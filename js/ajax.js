jQuery(document).ready(function ($) {

    $('#form').on('submit', function (e) {
        e.preventDefault();
        convertZCode();
    });

});

//TODO: add ids to vals
function convertZCode() {
    let data = {
        fname: $('#fName').val(),
        lname: $('#lName').val(),
        email: $('#email').val(),
        zcode: $('#zip').val()
    };

    alert(data);

    jQuery.ajax({
        url: 'convertZipCode.php',
        data: data,
        method: 'POST',
        success: function (resp) {
            console.log(resp);

        },
        error: function (resp) {
            console.log("error")
        }
    });
    // $.ajax({
    //     url: "test.html",
    //     context: document.body
    // }).done(function () {
    //     $(this).addClass("done");
    // });

}
