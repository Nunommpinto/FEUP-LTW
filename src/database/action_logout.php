<?php
    if (isset($_COOKIE['redirect'])) $referer = $_COOKIE['redirect'];
    else $referer = '../index.php';
    session_start();
    session_unset();
    session_destroy();
    header('Location: ' . $referer);
?>