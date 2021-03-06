<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    include_once('../database/connection.php');
    include_once('../database/db_restaurants.php');

    try {
        $restaurants = getNewestRestaurants();
        $_SESSION['restaurants'] = $restaurants;
    } catch(PDOException $e) {
        die($e->getMessage());
    }

    include_once('../templates/header.php');
    include_once('../templates/restaurants.php');
?>