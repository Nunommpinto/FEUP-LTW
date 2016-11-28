<?php
include_once('database/connection.php');
include_once('database/db_users.php');


$referer;
if (isset($_COOKIE['redirect'])) $referer = $_COOKIE['redirect'];
else $referer = 'myprofile.php';

if (isset($_POST['confirm_btn'])) {
    if (!registerUser($_POST['email'],$_POST['username'], $_POST['password'],$_POST['privileges'])) {
        echo "<script>alert('User is already registered, try again!')</script>";
    }
    else echo "<script>alert('Successfully registered')</script>";

    header('Location: ' . $referer);
}
else if(isset($_POST['cancel_btn'])) {
	header('Location: ' . $referer);
}
else {
    echo "<h1>Please go back to homepage.</h1>";
}

?>
