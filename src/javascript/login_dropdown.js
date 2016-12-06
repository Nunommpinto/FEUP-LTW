loginDropdownTablinks = function (tabName) {
    var i, tabcontent, tablinks;
    
    // Get all elements with class="login-dropdown-tabcontent" and hide them
    tabcontent = document.getElementsByClassName("login-dropdown-tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="login-dropdown-tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("login-dropdown-tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" header-elem-active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(tabName).style.display = "block";
    document.getElementById(tabName + 'link').className += " header-elem-active";
    //evt.currentTarget.className += " active";
}

// Close the dropdown menu if the user clicks outside of it
$(document).mousedown(function (e)
{
    var container =  $('.login-dropdown')

    // if the target of the click isn't the container neither a child of it 
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        $('.login-dropdown').children('a').removeClass('header-elem-active');
        $('.login-dropdown-content').removeClass('show');
    }
});

$(document).ready(function() {
    if (document.getElementsByTagName('login-dropdown').length > 0) {
        // Add login/register link click handler
        $('.login-dropdown').children('a').on('click', function() {
            $('.login-dropdown').children('a').toggleClass('header-elem-active');
            $('.login-dropdown-content').toggleClass('show');
        });

        // Add login and register tablinks functionality
        $('#login-tablink').on('click', function() { loginDropdownTablinks('login-tab'); });
        $('#register-tablink').on('click', function() { loginDropdownTablinks('register-tab'); });

        // Open default tab
        loginDropdownTablinks('login-tab'); 
    }
});
