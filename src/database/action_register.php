<?php
    include_once('connection.php');
    include_once('db_user.php');
    include_once('../templates/alert.php');

    $referer;
    if (isset($_COOKIE['redirect'])) $referer = $_COOKIE['redirect'];
    else $referer = '../index.php';

    if (isset($_POST['owner'])) $owner = 1;
    else $owner = 0;

    if (!registerUser($_POST['email'], $_POST['username'], $_POST['password'], $owner)) {
        if (usernameExists($_POST['username']))
            addWarn("Please try again with a different username.", 'Username already exists!');
        else if (emailExists($_POST['email']))
            addWarn("Please try again with a different email address.", 'Email already exists!');
        else 
            addWarn("Please try again later.", 'An error occurred!');
    } else
        addSuccess("Login with your new account.", 'Registration successful!');
    
    header('Location: ' . $referer);
?>