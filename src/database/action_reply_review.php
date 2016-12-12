<?php
	include_once('connection.php');
    include_once('db_review.php');
	
    if (session_status() == PHP_SESSION_NONE) 
        session_start();

    if(!isset($_POST['comment']))
        die('The user did not follow the protocol');

    $idUserSESSION = intval($_SESSION['idUser'][0]);
    var_dump($idUserSESSION);

    replyReview($_POST['comment'], $_POST['idReview'], $idUserSESSION);

    header('Location: ../templates/restaurant.php?idRestaurant=' . $_POST['idRestaurant']);
?>