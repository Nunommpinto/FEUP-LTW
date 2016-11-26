<?php
    if(!isset($_GET['idRestaurant']))
        die('There was no id');

    include_once('database/connection.php');
    include_once('database/db_restaurants.php');

    try {
        $restaurant = getRestaurantById($_GET['idRestaurant']);
        if($restaurant === false)
            die('There was no restaurant with the specified id');
    } catch(PDOException $e) {
        die($e->getMessage());
    }

    include_once('templates/header.php');
    include_once('templates/restaurant.php');
?>