<?php

include_once('database/db_users.php');


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
else if (isset($_POST['cancel_btn'])){
    header('Location: ' . $referer);
}
else {
    echo "<h1>Please go back to homepage.</h1>";
}

?>
