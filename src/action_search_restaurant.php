<?php

    if(!isset($_GET['name']))
        die('No name typed!');

    include_once('database/connection.php');
    include_once('database/db_restaurants.php');

    $result = searchRestaurant($_GET['name']);

    header('Location: view_restaurant.php?idRestaurant=<?=$result['idRestaurant']?>');
?>