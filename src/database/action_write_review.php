<?php
    if(!isset($_POST['review']))
        die('The user did not follow the protocol');

    include_once('connection.php');
    include_once('db_review.php');
    include_once('db_restaurants.php');

    registerReview($_POST['rating'], $_POST['review'], $_POST['idRestaurant'], 1);
    updateScore($_POST['idRestaurant']);

    header('Location: ../templates/restaurant.php?idRestaurant=' . $_POST['idRestaurant']);
?>