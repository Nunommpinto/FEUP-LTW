<?php

include_once('db_user.php');

session_start();

$referer;
if (isset($_COOKIE['redirect'])) $referer = $_COOKIE['redirect'];
else $referer = 'myprofile.php';

if (isset($_POST['login_btn'])) {
    if (checkCredentials($_POST['username'], $_POST['password'])) {
        $_SESSION['username'] = $_POST['username'];
        echo "<script>alert('Login successful')</script>";
    }
    else if (isRegistered($_POST['username'])) {
        echo "<script>alert('Wrong password!')</script>";
    }
    else echo "<script>alert('User is not registered!')</script>";

    header('Location: ' . $referer);
}
else {
    header('Location: ../pages/');
}

?>
