<?php
    if(!isset($_GET['id']))
        die('There was no id');

    include_once('database/connection.php');
    include_once('database/db_restaurants.php');

    try {
        $restaurant = getRestaurantById($_GET['id']);
        if($restaurant === false)
            die('There was no restaurant with the specified id');
        //$p = explode("\n", $restaurant['fulltext']);
    } catch(PDOException $e) {
        die($e->getMessage());
    }

    include_once('templates/header.php');
    include_once('templates/restaurant.php');
?>