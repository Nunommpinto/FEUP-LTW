<?php
    include_once('database/connection.php');
    include_once('database/db_restaurants.php');

    $restaurants = searchTopRestaurants();

    include_once('templates/header.php');
    include_once('templates/restaurants.php');
?>