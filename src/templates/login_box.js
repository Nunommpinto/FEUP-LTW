var loginComponent;
var registerComponent;
//$('.login-box.login-component');
//$('.login-box.register-component');

$('.login-box.login-link').on('click', function() {
    console.log("Login called");
    if(loginComponent) {
        console.log("Login showed");
        registerComponent = $('.login-box.register-component').detach();
        loginComponent.appendTo(".login-box.container");
        loginComponent = null;
    }
});

$('.login-box.register-link').on('click', function() {
    console.log("Register called");
    if(registerComponent) {
        console.log("Register showed");
        loginComponent = $('.login-box.login-component').detach();
        registerComponent.appendTo(".login-box.container");
        registerComponent = null;
    }
});

$(document).ready(function() {
    registerComponent = $('.login-box.register-component').detach();
});
