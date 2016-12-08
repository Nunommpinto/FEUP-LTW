<?php
	session_start();

	include_once('connection.php');
	include_once('db_review.php');


	if (isset($_SESSION['username'])) {
		//if ($_SESSION['userId'] == getUserId($_GET['idReview']))
			deleteReview($_GET['idReview']);
		
		//else echo "<script>alert('Cannot remove review!')</script>";
	}

	header('Location: ../templates/restaurant.php?idRestaurant=' . $_SESSION['idRestaurant']);
?>