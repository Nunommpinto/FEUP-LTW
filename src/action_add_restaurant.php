<?php
    if(!isset($_POST['name'])
        || trim($_POST['name']) == ''
        || !isset($_POST['description'])
        || trim($_POST['description']) == ''
        || !isset($_POST['idOwner'])
        || !isset($_POST['idRestaurantInfo']))
        die('The user did not follow the protocol');

    include_once('database/connection.php');
    include_once('database/db_restaurants.php');

    registerRestaurant($_POST['name'], $_POST['description'], $_POST['idOwner'], $_POST['idRestaurantInfo']);

    //Redirects to the homepage
    header('Location: homepage.php');
?>