var userInfoBtn = $('#user-info');
var userInfoContent = $('#user-info-content');
var userInfoContentChildren = userInfoContent.children();
var showUserContent = true;

userInfoBtn.on('click', function() {

    if (showUserContent)
        userInfoContentChildren.remove();
    else
        userInfoContentChildren.appendTo(userInfoContent);
        showUserContent = !showUserContent;
});

$(document).ready(function() {
    
    //userInfoContentChildren.remove();
});