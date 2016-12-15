<?php

    include_once('db_user.php');
    include_once('../templates/constants.php');
    //include_once('../templates/alert.php');

    if (session_status() == PHP_SESSION_NONE) 
        session_start();

    /*if (isset($_COOKIE['redirect'])) $referer = $_COOKIE['redirect'];
    else $referer = '../index.php';*/

    if (!isset($_POST['username']) || !isset($_POST['password']))
        echo "Missing information!";
    else if (checkCredentials($_POST['username'], $_POST['password'])) {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['idUser'] = getUserIdFromUser($_POST['username']);
        echo "Login successful.";
    } else if (usernameExists($_POST['username'])) {
        echo "Wrong password, please try again!";
        //addWarn("Wrong password.", 'Warning!');
        //$_SESSION[$LOGIN_KEY] = $_POST['username'];
    } else {
        echo "Username not found, please try again!";
        //addWarn("Wrong username.", 'Warning!');
        //$_SESSION[$LOGIN_KEY] = $LOGIN_WRONG_USER;
    }
        
    //header('Location: ' . $referer);
?>
