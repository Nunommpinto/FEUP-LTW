<?php
    if (session_status() == PHP_SESSION_NONE) 
        session_start();

    if(!isset($_POST['review']))
        die('The user did not follow the protocol');

    include_once('connection.php');
    include_once('db_review.php');
    include_once('db_restaurants.php');

    var_dump($_SESSION['idUser']);

    registerReview($_POST['rating'], $_POST['review'], $_POST['idRestaurant'], $_SESSION['idUser']);
    updateScore($_POST['idRestaurant']);

    header('Location: ../templates/restaurant.php?idRestaurant=' . $_POST['idRestaurant']);
?>