<?php
	include_once('connection.php');
    include_once('db_review.php');
	
    if (session_status() == PHP_SESSION_NONE) 
        session_start();

    if(!isset($_POST['reply']))
        die('The user did not follow the protocol');

    //var_dump($_SESSION['idUser']);

    replyReview($_POST['reply'], $_POST['idReview'], $_SESSION['idUser']);

    header('Location: ../templates/restaurant.php?idRestaurant=' . $_POST['idRestaurant']);
?>