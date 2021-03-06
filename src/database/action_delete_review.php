<?php
	if(session_start() == PHP_SESSION_NONE)
		session_start();

	include_once('connection.php');
	include_once('db_review.php');
	include_once('db_restaurants.php');

	$idUserReview = getUserIdFromReview($_GET['idReview']);
	$idUserReview = intval($idUserReview[0]);
	$idUserSESSION = intval($_SESSION['idUser'][0]);
	
	if (!isset($_SESSION['idUser']) || $idUserReview != $idUserSESSION)
		die(header('Location: ../pages/index.php'));

	deleteReview($_GET['idReview']);
	updateScore($_GET['idRestaurant']);
	header('Location: ../templates/restaurant.php?idRestaurant=' . $_SESSION['idRestaurant']);
?>