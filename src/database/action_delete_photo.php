<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    include_once('connection.php');
    include_once('db_photo.php');

    $idUserSESSION = intval($_SESSION['idUser']);
    $idUserPhoto = getUserById($_GET['idPhoto']);
    $idUserPhoto = intval($idUserPhoto);

    if($idUserSESSION != $idUserPhoto)
        die(header('Location: ../pages/user_photos.php'));

    deletePhoto($_GET['idPhoto']);
    header('Location: ../pages/user_photos.php');
?>