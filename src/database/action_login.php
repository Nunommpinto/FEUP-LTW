<?php

    include_once('db_user.php');
    include_once('constants.php');
    include_once('../templates/alert.php');

    if (session_status() == PHP_SESSION_NONE) 
        session_start();

    if (isset($_COOKIE['redirect'])) $referer = $_COOKIE['redirect'];
    else $referer = '../index.php';

    if (checkCredentials($_POST['username'], $_POST['password'])) {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['userId'] = getUserId($_POST['username']);
        if (isset($_SESSION[$LOGIN_KEY]))
            unset($_SESSION[$LOGIN_KEY]);
    } 
    else if (isRegistered($_POST['username'])) {
        addWarn("Wrong password.", 'Warning!');
        $_SESSION[$LOGIN_KEY] = $_POST['username'];
    }
    else {
        addWarn("Wrong username.", 'Warning!');
        $_SESSION[$LOGIN_KEY] = $LOGIN_WRONG_USER;
    }
        
    header('Location: ' . $referer);
?>
