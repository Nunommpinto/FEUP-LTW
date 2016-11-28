<?php
    if(!isset($_GET['idRestaurant']))
        die('There was no id');

    include_once('database/connection.php');
    include_once('database/db_restaurants.php');
    include_once('database/db_restaurants_info.php');
    include_once('database/db_photo.php');
    include_once('database/db_localization.php');

    try {
        $restaurant = getRestaurantById($_GET['idRestaurant']);
        if($restaurant === false)
            die('There was no restaurant with the specified id');
        $info = getInfoById($restaurant['idRestaurantInfo']);
        $localization = getLocalizationById($info['idLocalization']);
        $photo = getPhotoById($info['idRestaurantInfo']);
    } catch(PDOException $e) {
        die($e->getMessage());
    }

    include_once('templates/header.php');
    include_once('templates/restaurant.php');

    if($info)
        include_once('templates/restaurant_info.php');
    if($localization)
        include_once('templates/localization.php');
    if($photo)
        include_once('templates/photo.php');

    echo $info['idRestaurantInfo'] . " --> Ola --> ";
    echo $photo['idPhoto'] . " --> Ola";
?>