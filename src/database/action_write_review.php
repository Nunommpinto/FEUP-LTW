<?php
    if (session_status() == PHP_SESSION_NONE) 
        session_start();

    if(!isset($_POST['review']))
        die('The user did not follow the protocol');

    include_once('connection.php');
    include_once('db_review.php');
    include_once('db_restaurants.php');

    registerReview($_POST['rating'], $_POST['review'], $_POST['idRestaurant'], intval($_SESSION['idUser'][0]));
    updateScore($_POST['idRestaurant']);

    header('Location: ../templates/restaurant.php?idRestaurant=' . $_POST['idRestaurant']);
?>