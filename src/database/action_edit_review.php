<?php
    session_start();

    include_once('../database/connection.php');
    include_once('../database/db_review.php');

    updateReview($_POST['idReview'], $_POST['score'], $_POST['comment']);

    header('Location: ../templates/restaurant.php?idRestaurant=' . $_SESSION['idRestaurant']);
?>