var loginBox = $('.login-box');
var loginLink = loginBox.children('.login-link');
var registerLink = loginBox.children('.register-link');
var loginComponent = loginBox.children('.login-component');
var registerComponent;
var showing;

loginLink.on('click', function() {
    if(showing != "login") {
        registerComponent = $('.register-component').detach();
        loginComponent.appendTo(loginBox);
        showing = "login";
    }
});

registerLink.on('click', function() {
    if(showing != "register") {
        loginComponent = $('.login-component').detach();
        registerComponent.appendTo(loginBox);
        showing = "register";
    }
});

$(document).ready(function() {
    registerComponent = $('.register-component').detach();
    showing = "login";
});
