<?php
    include_once('db_user.php');
    include_once('../templates/constants.php');

    if (session_status() == PHP_SESSION_NONE) 

    if (!isset($_POST['username']) || !isset($_POST['password']))
        echo "Missing information!";
    else if (checkCredentials($_POST['username'], $_POST['password'])) {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['idUser'] = getUserIdFromUser($_POST['username']);
        echo "Login successful.";
    } else if (usernameExists($_POST['username'])) {
        echo "Wrong password, please try again!";
    } else {
        echo "Username not found, please try again!";
    }
?>
