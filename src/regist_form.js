function regform(form, email, username, pass, conf, privileges) {
    if (email.value == '' || username.value == '' || pass.value == '' || privileges.value == '') {
        alert('Please fill all the requirements.');
        return false;
    }

    var re = /^\w+$/;
    if(!re.test(form.username.value)) {
        alert("Username must contain only letters, numbers and underscores.");
        form.username.focus();
        return false;
    }
	
	if (email.value.length < 9) {
        alert("Please enter a valid email.");
        form.password.focus();
        return false;
    }

    if (pass.value.length < 6) {
        alert("Password must be at least 6 characters long.");
        form.password.focus();
        return false;
    }

    if (pass.value != conf.value) {
        alert("Passwords don't match, try again.");
        form.confirm.focus();
        return false;
    }

    var confirm_btn = document.createElement("input");
    confirm_btn.name = "confirm_btn";
    confirm_btn.type = "hidden";
    form.appendChild(confirm_btn);

    form.submit();
    return true;
}
