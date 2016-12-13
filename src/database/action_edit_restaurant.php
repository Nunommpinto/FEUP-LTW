<?php
    include_once('connection.php');
    include_once('db_restaurants.php');
    include_once('db_restaurants_info.php');
    include_once('db_localization.php');

    $restaurant = getRestaurantById($_POST['idRestaurant']);
    updateRestaurant($_POST['idRestaurant'], $_POST['name'], $_POST['description']);
    
    $restaurantInfo = getInfoById($restaurant['idRestaurantInfo']);
    updateRestaurantInfo($restaurantInfo['idRestaurantInfo'], $_POST['price'], $_POST['openHours'], $_POST['closeHours']);

    $localization = getLocalizationById($restaurantInfo['idLocalization']);
    updateLocalization($localization['idLocalization'], $_POST['country'], $_POST['city'], $_POST['road'], $_POST['postalCode']);

    header('Location: ../templates/restaurant.php?idRestaurant=' . $_POST['idRestaurant']);
?>