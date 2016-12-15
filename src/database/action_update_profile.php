<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    include_once('connection.php');
    include_once('db_user.php');
    include_once('db_user_info.php');
    include_once('../templates/constants.php');
    include_once('../templates/alert.php');

    if (!isset($_SESSION['username']) || !isset($_POST['updating']))
        header('Location: ../pages/profile.php');
    else {
        // Update email
        if ($_POST['updating'] == "email" && isset($_POST['data'])) {
            updateEmail($_SESSION['username'], $_POST['data']);
            echo 'Email updated successfully!';
        // Update password
        } else if ($_POST['updating'] == "pw" && isset($_POST['data']) && isset($_POST['confirm'])) {
            if ($_POST['data'] != $_POST['confirm'])
                echo "Passwords don't match!";
            else if (strlen($_POST['data']) < $PASSWORD_MIN_CHAR)
                echo "Password is too short!";
            else if (checkCredentials($_SESSION['username'], $_POST['data']))
                echo "Password cannot be the same as previous!";
            else {
                updatePassword($_SESSION['username'], $_POST['data']);
                echo 'Password updated successfully!';
            }
        // Update name
        } else if ($_POST['updating'] == "name") {
            updateUserinfoName($_SESSION['username'], $_POST['data']);
            echo 'Name updated successfully!';
        // Update biography
        } else if ($_POST['updating'] == "bio") {
            updateUserinfoBio($_SESSION['username'], $_POST['data']);
            echo 'Name updated successfully!';
        // TODO UPDATE PICTURE
        } else 
            sendErrorWarn();
    }

    function sendErrorWarn() {
        echo 'An error occurred while updating profile!';
    }
?>