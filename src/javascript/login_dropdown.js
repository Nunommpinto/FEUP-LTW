loginDropdownTablinks = function (tabName) {
    // Get all elements with class="login-dropdown-tabcontent" and hide them
    $('.login-dropdown-tabcontent').hide();

    // Get all elements with class="login-dropdown-tablinks" and remove the class "active"
    $('#register-tablink').removeClass('header-elem-active')
    $('#login-tablink').removeClass('header-elem-active')

    // Show the current tab, and add an "active" class to the link that opened the tab
    $('#' + tabName).show();
    $('#' + tabName + 'link').addClass('header-elem-active');
}

// Close the dropdown menu if the user clicks outside of it
$(document).mousedown(function (e)
{
    var container = $('.login-dropdown')

    // if the target of the click isn't the container neither a child of it 
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        $('.login-dropdown').children('a').removeClass('header-elem-active');
        $('.login-dropdown-content').removeClass('show');
    }
});

$(document).ready(function() {
    // Add login/register link click handler
    $('.login-dropdown').children('a').on('click', function() {
        $('.login-dropdown').children('a').toggleClass('header-elem-active');
        $('.login-dropdown-content').toggleClass('show');
    });

    // Add login and register tablinks functionality
    $('#login-tablink').on('click', function() { loginDropdownTablinks('login-tab'); });
    $('#register-tablink').on('click', function() { loginDropdownTablinks('register-tab'); });

    // Add login event handler
    $('#login-btn').on('click', function() { login($('#login-input-username').val(), $('#login-input-password').val()); });
});

disableLogin = function() {
    $('#login-input-username').prop("disabled", true);
    $('#login-input-password').prop("disabled", true);
}

enableLogin = function() {
    $('#login-input-username').prop("disabled", false);
    $('#login-input-password').prop("disabled", false);
}

login = function(username, password) {
    $.ajax({
        type: "POST",
        url: "../database/action_login.php",
        data: {username: username, password: password},
        success: function(result) {
            if (result.indexOf('success') != -1) {
                location.reload();
            } else {
                // Show error in username label
                if (result.indexOf('sername') != -1) 
                    $('#login-label-username').addClass("error");
                else
                    $('#login-label-username').removeClass("error");
                if (result.indexOf('assword') != -1) 
                    $('#login-label-password').addClass("error");
                else
                    $('#login-label-password').removeClass("error");

                // Show snackbar
                $('#profile-snackbar')[0].innerHTML = result;
                $('#profile-snackbar').removeClass("show");
                $('#profile-snackbar').addClass("show");
                setTimeout(function(){ $('#profile-snackbar').removeClass("show"); }, 5000);
            }
        },
        error: function(result) {
            // Show error button
            $('#login-btn').addClass("error");
            
            // Show snackbar
            $('#profile-snackbar')[0].innerHTML = 'Unexpected error occured: ' + result['status'];
            $('#profile-snackbar').removeClass("show");
            $('#profile-snackbar').addClass("show");
            setTimeout(function(){ $('#profile-snackbar').removeClass("show"); }, 5000);
        },
        complete: function() {
            enableLogin();
        }
    });
}
