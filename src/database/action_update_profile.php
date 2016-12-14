<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    include_once('connection.php');
    include_once('db_user.php');
    include_once('db_user_info.php');
    include_once('../templates/constants.php');
    include_once('../templates/alert.php');

    if (!isset($_SESSION['username']) || !isset($_POST['updating']))
        sendErrorWarn();
    else {
        // Update email
        if ($_POST['updating'] == "email" && isset($_POST['email'])) {
            updateEmail($_SESSION['username'], $_POST['email']);
            addSuccess("", 'Email updated successfully!');
        // Update password
        } else if ($_POST['updating'] == "pw" && isset($_POST['password']) && isset($_POST['confirm'])) {
            if ($_POST['password'] != $_POST['confirm'])
                addError("Please check your passwords", "Passwords don't match!");
            else if (strlen($_POST['password']) < $PASSWORD_MIN_CHAR)
                addError("Please check your passwords", "Password is too short!");
            else if (checkCredentials($_SESSION['username'], $_POST['password']))
                addError("Please check your passwords", "Password cannot be the same as previous!");
            else {
                updatePassword($_SESSION['username'], $_POST['password']);
                addSuccess("", 'Password updated successfully!');
            }
        // Update biography
        } else if ($_POST['updating'] == "bio") {
            updateUserinfoBio($_SESSION['username'], $_POST['name'], $_POST['biography']);
            addSuccess("", 'Biography updated successfully!');

        // TODO UPDATE PICTURE
        } else 
            sendErrorWarn();
    }

    header('Location: ../pages/profile.php');

    function sendErrorWarn() {
        addWarn("Please try again later.", 'An error occurred while updating profile!');
    }
?>