$(document).ready(function() {
    initElem('email');
    initElem('name');
    initElem('bio');
    initPw();

    // Close button
    $('#profile-close').on('click', function() {
        $('#profile-form').hide();
    });
});

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

    if ($('#profile-label-' + elem)[0].innerHTML.length > 0) {
        // Hide input text
        $('#profile-input-' + elem).toggle();
        // Hide save button
        $('#profile-save-' + elem).toggle();
        // Hide cancel button
        $('#profile-cancel-' + elem).toggle();    
    } else {
        $('#profile-label-' + elem).toggle();
        $('#profile-edit-' + elem).toggle();
    }
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


/* AJAX Request */
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