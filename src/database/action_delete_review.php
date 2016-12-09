<?php
	session_start();

	include_once('connection.php');
	include_once('db_review.php');

	$user = getUserId($_GET['idReview']);

	if (isset($_SESSION['username'])) {
		//if ($_SESSION['idUser'] == $user)
			deleteReview($_GET['idReview']);
		
		//else echo "<script>alert('Cannot remove review!')</script>";
	}

	//header('Location: ../templates/restaurant.php?idRestaurant=' . $_SESSION['idRestaurant']);
?>