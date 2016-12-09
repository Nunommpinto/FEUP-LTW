<?php
	session_start();

	include_once('connection.php');
	include_once('db_review.php');

	$revuser = getUserId($_GET['idReview']);
	$user = $_SESSION['idUser'];
	
	
	if (isset($_SESSION['username'])) {
		//if ($user == $revuser)
			deleteReview($_GET['idReview']);
		
		//else echo "<script>alert('Cannot remove review!')</script>";
	}

	header('Location: ../templates/restaurant.php?idRestaurant=' . $_SESSION['idRestaurant']);
?>