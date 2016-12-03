<?php
    if(!isset($_POST['review']))
        die('The user did not follow the protocol');

    include_once('database/connection.php');
    include_once('database/db_review.php');
    include_once('database/db_restaurants.php');

    registerReview($_POST['rating'], $_POST['review'], $_POST['idRestaurant'], 1);

    header('Location: homepage.php');
?>