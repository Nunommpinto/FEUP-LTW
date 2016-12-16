$(document).ready(function() {
    initElem('email');
    initElem('name');
    initElem('bio');
    initPw();
    initAvatar();
    
    // Close button
    $('#profile-close').on('click', function() {
        $('#profile-form').hide();
    });
});

// Called when profile modal is to become visible
loadProfile = function(username, isCurrentUser) {
    if (!isCurrentUser) { $('.profile.fa, #profile-span-pw').hide(); }
    else $('.profile.fa').show();
    getProfile(username);
    $('#profile-form').show();
}

// Initializes (elem) elements
initElem = function(elem) {
    // Icon click
    $('#profile-edit-' + elem).on('click', function(){
        $('#profile-input-' + elem).val($('#profile-label-' + elem).text());
        toggleElem(elem);
    });

    // Save click
    $('#profile-save-' + elem).on('click', function(){
        disableElem(elem);
        sendRequest(elem, $('#profile-input-' + elem).val());
        //toggleElem(elem);
    });

    // Cancel click
    $('#profile-cancel-' + elem).on('click', function(){
        toggleElem(elem);
    });

    // Hide input text
    $('#profile-input-' + elem).toggle();
    // Hide save button
    $('#profile-save-' + elem).toggle();
    // Hide cancel button
    $('#profile-cancel-' + elem).toggle();    
}

// Toggles all (elem) elements
toggleElem = function(elem) {
    $('#profile-label-' + elem).toggle();
    $('#profile-edit-' + elem).toggle();
    $('#profile-input-' + elem).toggle();
    $('#profile-save-' + elem).toggle();
    $('#profile-cancel-' + elem).toggle();
}

// Disables some (elem) elems
disableElem = function(elem) {
    $('#profile-input-' + elem).prop("disabled", true);
    $('#profile-save-' + elem).prop("disabled", true);
    $('#profile-save-' + elem).addClass("disabled");
    $('#profile-cancel-' + elem).prop("disabled", true);
    $('#profile-cancel-' + elem).addClass("disabled");
}

// Enables some (elem) elems
enableElem = function(elem) {
    $('#profile-input-' + elem).prop("disabled", false);
    $('#profile-save-' + elem).prop("disabled", false);
    $('#profile-save-' + elem).removeClass("disabled");
    $('#profile-cancel-' + elem).prop("disabled", false);
    $('#profile-cancel-' + elem).removeClass("disabled");
}

/* Password */
initPw = function() {
    $('#profile-input-pw').toggle();
    $('#profile-input-pw-confirm').toggle();
    $('#profile-save-pw').toggle();
    $('#profile-cancel-pw').toggle();

    // Icon click
    $('#profile-edit-pw').on('click', function(){
        togglePw();
    });

    // Save click
    $('#profile-save-pw').on('click', function(){
        sendRequest('pw', $('#profile-input-pw').val(), $('#profile-input-pw-confirm').val());
        clearPw();
        disablePw();
    });

    // Cancel click
    $('#profile-cancel-pw').on('click', function(){
        clearPw();
        togglePw();
    });
}

// Toggles all password elements
togglePw = function() {
    $('#profile-edit-pw').toggle();
    $('#profile-input-pw').toggle();
    $('#profile-input-pw-confirm').toggle();
    $('#profile-save-pw').toggle();
    $('#profile-cancel-pw').toggle();
}

// Clears password fields
clearPw = function() {
    $('#profile-input-pw').val('');
    $('#profile-input-pw-confirm').val('');
}

// Disables some pw elems
disablePw = function() {
    $('#profile-input-pw').prop("disabled", true);
    $('#profile-input-pw-confirm').prop("disabled", true);
    $('#profile-save-pw').prop("disabled", true);
    $('#profile-save-pw').addClass("disabled");
    $('#profile-cancel-pw').prop("disabled", true);
    $('#profile-cancel-pw').addClass("disabled");
}

// Enables some pw elems
enablePw = function() {
    $('#profile-input-pw').prop("disabled", false);
    $('#profile-input-pw-confirm').prop("disabled", false);
    $('#profile-save-pw').prop("disabled", false);
    $('#profile-save-pw').removeClass("disabled");
    $('#profile-cancel-pw').prop("disabled", false);
    $('#profile-cancel-pw').removeClass("disabled");
}


/* Avatar */
initAvatar = function() {
    $('#profile-change-avatar').on('click', function() {
        $('#profile-input-avatar').trigger('click');
    });

    // Upload avatar on file change
    $('#profile-input-avatar').change(function() {
        updateAvatar();
    });

    $('#profile-remove-avatar').on('click', function() {
        removeAvatar();
    });
}


/* AJAX Requests */
sendRequest = function(elem, data, confirm) {
    $.ajax({
        type: "POST",
        url: "../database/action_update_profile.php",
        data: {updating: elem, data: data, confirm: confirm},
        success: function(result) {
            if (result.indexOf('success') != -1) {
                // Show success label
                if (elem != 'pw') $('#profile-label-' + elem).text(data);
                $('#profile-label-' + elem).addClass("success");
                $('#profile-label-' + elem).removeClass("error");
            } else {
                // Show error label
                $('#profile-label-' + elem).removeClass("success");
                $('#profile-label-' + elem).addClass("error");

                // Show snackbar
                $('#profile-snackbar')[0].innerHTML = result;
                $('#profile-snackbar').addClass("show");
                setTimeout(function(){ $('#profile-snackbar').removeClass("show"); }, 5000);
            }
        },
        error: function(result) {
            // Show error label
            $('#profile-label-' + elem).removeClass("success");
            $('#profile-label-' + elem).addClass("error");
            
            // Show snackbar
            $('#profile-snackbar')[0].innerHTML = 'Unexpected error occured: ' + result['status'];
            $('#profile-snackbar').addClass("show");
            setTimeout(function(){ $('#profile-snackbar').removeClass("show"); }, 5000);
        },
        complete: function() {
            if (elem != 'pw') {
                toggleElem(elem);
                enableElem(elem);
            } else {
                togglePw();
                enablePw();
            }
        }
    });
}

updateAvatar = function() {
    var formData = new FormData($('#profile-form-avatar')[0]);
    $.ajax({
        url: "../database/action_update_profile.php",
        type: 'POST',
        xhr: function() {  // Custom XMLHttpRequest
            var myXhr = $.ajaxSettings.xhr();
            return myXhr;
        },
        //Ajax events
        //beforeSend: beforeSendHandler,
        success: function(result) {
            if (result.indexOf('file=') == 0) {
                $('#profile-change-avatar').addClass("success");
                $('#profile-change-avatar').removeClass("error");
                
                // "?" + new Date().getTime() prevents avatar cache
                $('#profile-img-avatar').attr("src", result.substring(5) + "?" + new Date().getTime());

                // Shows remove avatar button
                $('#profile-remove-avatar').show();
            } else {
                $('#profile-change-avatar').removeClass("success");
                $('#profile-change-avatar').addClass("error");

                // Show snackbar
                $('#profile-snackbar')[0].innerHTML = result;
                $('#profile-snackbar').addClass("show");
                setTimeout(function(){ $('#profile-snackbar').removeClass("show"); }, 5000);
            }
        },
        error: function(result) {
            // Show error label
            $('#profile-label-' + elem).removeClass("success");
            $('#profile-label-' + elem).addClass("error");
            
            // Show snackbar
            $('#profile-snackbar')[0].innerHTML = 'Unexpected error occured: ' + result['status'];
            $('#profile-snackbar').addClass("show");
            setTimeout(function(){ $('#profile-snackbar').removeClass("show"); }, 5000);
        },
        // Form data
        data: formData,
        //Options to tell jQuery not to process data or worry about content-type.
        cache: false,
        contentType: false,
        processData: false
    });
}

removeAvatar = function() {
    $.ajax({
        type: "POST",
        url: "../database/action_update_profile.php",
        data: {updating: 'removeAvatar'},
        success: function(result) {
            if (result.indexOf('file=') == 0) {
                // "?" + new Date().getTime() prevents avatar cache
                $('#profile-img-avatar').attr("src", result.substring(5) + "?" + new Date().getTime());

                // Show snackbar
                $('#profile-remove-avatar').hide();
                $('#profile-snackbar')[0].innerHTML = 'Avatar was reset!';
            } else 
                $('#profile-snackbar')[0].innerHTML = result;
            
            // Show snackbar
            $('#profile-snackbar').addClass("show");
            setTimeout(function(){ $('#profile-snackbar').removeClass("show"); }, 5000);
        },
        error: function(result) {
            // Show snackbar
            $('#profile-snackbar')[0].innerHTML = 'Unexpected error occured: ' + result['status'];
            $('#profile-snackbar').addClass("show");
            setTimeout(function(){ $('#profile-snackbar').removeClass("show"); }, 5000);
        }
    });
}

getProfile = function(username) {
    $.ajax({
        type: "POST",
        url: "../database/action_get_profile.php",
        data: {username: username},
        success: function(result) {
            var profile = JSON.parse(result);
            $('#profile-label-username').text(profile.username + " (" + profile.owner + ")");
            $('#profile-label-email').text(profile.email);
            $('#profile-label-name').text(profile.name);
            $('#profile-label-bio').text(profile.bio);
            $('#profile-img-avatar').attr("src", profile.avatar + "?" + new Date().getTime());
        },
        error: function(result) {
            $('#profile-form').hide();
            
            // Show snackbar
            $('#profile-snackbar')[0].innerHTML = 'Unexpected error occured: ' + result['status'];
            $('#profile-snackbar').addClass("show");
            setTimeout(function(){ $('#profile-snackbar').removeClass("show"); }, 5000);
        }
    });
}
