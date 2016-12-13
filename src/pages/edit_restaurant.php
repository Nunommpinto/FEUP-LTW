<?php
    include_once('../database/connection.php');
    include_once('../database/db_restaurants.php');
    include_once('../database/db_restaurants_info.php');
    include_once('../database/db_localization.php');
    include_once('../database/db_photo.php');

    $restaurant = getRestaurantById($_GET['idRestaurant']);

    include_once('../templates/header.php');
    include_once('../templates/edit_restaurant.php');
?>