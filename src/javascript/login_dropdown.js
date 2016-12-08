loginDropdownTablinks = function (tabName) {
    // Get all elements with class="login-dropdown-tabcontent" and hide them
    $('.login-dropdown-tabcontent').hide();

    // Get all elements with class="login-dropdown-tablinks" and remove the class "active"
    $('login-dropdown-tablinks').removeClass('header-elem-active')

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
});
