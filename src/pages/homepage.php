<?php
    session_start();

    include_once('../database/connection.php');
    include_once('../database/db_restaurants.php');

    try {
        $restaurants = getAllRestaurants();
        $_SESSION['restaurants'] = $restaurants;
    } catch(PDOException $e) {
        die($e->getMessage());
    }

    include_once('../templates/header.php');
    include_once('../templates/restaurants.php');
?>