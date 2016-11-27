<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    if(!isset($_POST['name'])
        || trim($_POST['name']) == ''
        || !isset($_POST['description'])
        || trim($_POST['description']) == ''
        || !isset($_POST['idOwner'])
        || !isset($_POST['idRestaurantInfo']))
        die('The user did not follow the protocol');

    include_once('database/connection.php');
    include_once('database/db_localization.php');
    include_once('database/db_restaurants_info.php');
    include_once('database/db_restaurants.php');

    registerLocalization($_POST['country'], $_POST['city'], $_POST['road'], $_POST['postalCode']);
    registerRestaurantInfo($_POST['price'], $_POST['category'], $_POST['openHours'], $_POST['closeHours']);
    registerRestaurant($_POST['name'], $_POST['description'], $_POST['idOwner'], $_POST['idRestaurantInfo']);

    //Redirects to the homepage //TODO: redirect to manager of restaurants
    header('Location: homepage.php');
?>