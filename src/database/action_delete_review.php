<?php
	session_start();

	include_once('connection.php');
	include_once('db_review.php');

	$id = $_GET['idReview'];
	$user = getUserId($id);
	$review = getReviewById($id);

	if (isset($_SESSION['name'])) {
		if ($_SESSION['idUser'] == $user)
			deleteReview($id, $_SESSION['name']);
	}

	header('Location: ../templates/restaurant.php?idRestaurant=' . $_SESSION['idRestaurant']);
?>