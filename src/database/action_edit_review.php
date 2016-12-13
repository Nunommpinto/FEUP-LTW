<?php
    session_start();

    include_once('../database/connection.php');
    include_once('../database/db_review.php');
    include_once('../database/db_restaurants.php');

    updateReview($_POST['idReview'], $_POST['score'], $_POST['comment']);
    updateScore(intval($_SESSION['idRestaurant']));

    header('Location: ../templates/restaurant.php?idRestaurant=' . $_SESSION['idRestaurant']);
?>