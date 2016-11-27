var loginBox = $('.login-box');
var loginLink = loginBox.children('.login-link');
var registerLink = loginBox.children('.register-link');
var loginComponent = loginBox.children('.login-component');
var registerComponent = loginBox.children('.register-component');
var showing;

loginLink.on('click', function() {
    if(showing != "login") {
        registerComponent.remove();
        loginComponent.appendTo(loginBox);
        showing = "login";
    }
});

registerLink.on('click', function() {
    if(showing != "register") {
        loginComponent.remove();
        registerComponent.appendTo(loginBox);
        showing = "register";
    }
});

$(document).ready(function() {
    registerComponent.remove();
    showing = "login";
});
