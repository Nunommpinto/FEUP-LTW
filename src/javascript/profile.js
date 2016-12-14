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
        toggleElem(elem);
    });

    // Save click
    $('#profile-save-' + elem).on('click', function(){
        toggleElem(elem);
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
        clearPw();
        togglePw();
        
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