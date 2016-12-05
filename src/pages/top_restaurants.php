<?php
    session_start();

    include_once('../database/connection.php');
    include_once('../database/db_restaurants.php');

    $restaurants = searchTopRestaurants();
    $_SESSION['restaurants'] = $restaurants;

    include_once('../templates/header.php');
    include_once('../templates/restaurants.php');
?>