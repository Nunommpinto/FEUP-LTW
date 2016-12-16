// Close the dropdown menu if the user clicks outside of it
$(document).mousedown(function (e)
{
    var container = $('.user-dropdown')

    // if the target of the click isn't the container neither a child of it 
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        $('.user-dropdown').children('a').removeClass('header-elem-active');
        $('.user-dropdown-content').removeClass('show');
    }
});

$(document).ready(function() {
    // Add login/register link click handler
    $('.user-dropdown').children('a').on('click', function() {
        $('.user-dropdown').children('a').toggleClass('header-elem-active');
        $('.user-dropdown-content').toggleClass('show');
    });

    // Add profile click handler
    $('#user-dropdown-a-profile').on('click', function() {
        loadProfile($('#user-dropdown-username')[0].innerHTML, true);
    });
});
