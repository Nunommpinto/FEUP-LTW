<?php
    session_start();

    include_once('connection.php');
    include_once('db_restaurants.php');
    include_once('../pages/search_restaurant.php');

    $restaurants = advancedSearch($_GET['name'], $_GET['min-score'], $_GET['max-score']);
    $arrayCount = count($restaurants);
    
    if($arrayCount > 1) {
        $_SESSION['restaurants'] = $restaurants;
        header('Location: ../templates/restaurants.php');
    } else if($arrayCount == 1) {
        $_SESSION['restaurant'] = $restaurants[0];
        header('Location: ../templates/restaurant.php');
    } else
        header('Location: ../pages/index.php');
?>