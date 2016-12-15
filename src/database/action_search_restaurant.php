<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    include_once('connection.php');
    include_once('db_restaurants.php');

    $restaurants = advancedSearch($_GET['name'], $_GET['min-score'], $_GET['max-score'], $_GET['price'], $_GET['country'], $_GET['city']);
    $arrayCount = count($restaurants);

    if($arrayCount > 1) {
        $_SESSION['restaurants'] = $restaurants;
        header('Location: ../templates/restaurants.php');
    } else if($arrayCount == 1) {
        //var_dump($restaurants);
        header('Location: ../templates/restaurant.php?idRestaurant=' . $restaurants[0]['idRestaurant']);
    } else
        header('Location: ../pages/index.php');
?>