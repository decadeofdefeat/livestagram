jQuery(document).ready(function() {
});

function loginForm() {

    
    var username = $('#username').val();
    var password = $('#password').val();

    $.ajax({
        url: site_url + 'admin/login/validate/',
        type: "POST",
        data: { username: username, password: password },
        dataType: "json",
        success: function(data, textStatus) {
            if (data.redirect) {
                // data.redirect contains the string URL to redirect to
                window.location.href = data.redirect;
            }
            else {
                // data.form contains the HTML for the replacement form
                $(".error").show(1000);
                $(".error").html(data.form);
            }
        }
    });

}