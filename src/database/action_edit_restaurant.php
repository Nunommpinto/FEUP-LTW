<?php
    include_once('connection.php');
    include_once('db_restaurants.php');
    include_once('db_restaurants_info.php');
    include_once('db_localization.php');

    $restaurant = getRestaurantById($_POST['idRestaurant']);
    updateRestaurant($_POST['idRestaurant'], $_POST['name'], $_POST['description']);
    
    $restaurantInfo = getInfoById($restaurant['idRestaurantInfo']);
    updateRestaurantInfo($restaurantInfo['idRestaurantInfo'], $_POST['price'], $_POST['openHours'], $_POST['closeHours']);

    header('Location: ../templates/restaurant.php?idRestaurant=' . $_POST['idRestaurant']);
?>