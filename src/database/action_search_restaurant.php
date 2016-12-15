<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    include_once('connection.php');
    include_once('db_restaurants.php');

    $restaurants = retrieveAdvanceSearch($_GET['name'], $_GET['min-score'], $_GET['max-score'], $_GET['price'], $_GET['country'], $_GET['city']);
    $arrayCount = count($restaurants);

    if($arrayCount > 0) {
        echo 'success=';
        foreach($restaurants as $restaurant)
            echo $restaurant['idRestaurant'] . ',' . $restaurant['name'] . ',';
    } else
        echo 'failure.';
?>