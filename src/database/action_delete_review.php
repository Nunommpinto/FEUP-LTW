<?php
	session_start();

	include_once('connection.php');
	include_once('db_review.php');

	$review = getReviewById($_GET['idReview']);

	if (isset($_SESSION['username'])) {
		if ($_SESSION['userId'] == getUserId($_GET['idReview']))
			deleteReview($_GET['idReview']);
	}

	header('Location: ../templates/restaurant.php?idRestaurant=' . $_SESSION['idRestaurant']);
?>