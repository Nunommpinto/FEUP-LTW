<?php
    include_once('connection.php');
    include_once('db_user.php');


    $referer;
    if (isset($_COOKIE['redirect'])) $referer = $_COOKIE['redirect'];
    else $referer = '../index.php';

    if (isset($_POST['owner'])) $owner = 1;
    else $owner = 0;

    if (!registerUser($_POST['email'], $_POST['username'], $_POST['password'], $owner)) {
        echo "<script>alert('User is already registered, try again!')</script>";
    }

    else echo "<script>alert('Successfully registered')</script>";

    //header('Location: ' . $referer);
?>