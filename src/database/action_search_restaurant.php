<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    include_once('connection.php');
    include_once('db_restaurants.php');

    $restaurants = retrieveAdvanceSearch($_GET['name'], $_GET['min-score'], $_GET['max-score'], $_GET['price'], $_GET['country'], $_GET['city']);
    $arrayCount = count($restaurants);

    if($arrayCount > 0) {
        echo "success,";
        foreach($restaurants as $restaurant) {
            echo $restaurant['name'] . ',';
        }
    } else
        echo "failure, no matches."
/*
    if($arrayCount > 1) {
        //include_once('../templates/header.php');
        include_once('../templates/restaurants.php');
    } else if($arrayCount == 1)
        header('Location: ../templates/restaurant.php?idRestaurant=' . $restaurants[0]['idRestaurant']);
    else
        header('Location: ../pages/index.php');*/
?>