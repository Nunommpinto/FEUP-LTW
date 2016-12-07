<?php

include_once('db_user.php');

session_start();

$referer;
    if (isset($_COOKIE['redirect'])) $referer = $_COOKIE['redirect'];
    else $referer = '../index.php';

	if (checkCredentials($_POST['username'], $_POST['password'])) {
        $_SESSION['username'] = $_POST['username'];
        header('Location: ' . $referer);
	}

    else if (isRegistered($_POST['username'])) {
        echo "<script>alert('Wrong password!')</script>";
        //header('Location: ' . $referer);
    }
    
	else echo "<script>alert('User is not registered!')</script>";

?>
