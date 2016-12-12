<?php
    include_once('connection.php');
    include_once('db_restaurants.php');

    updateRestaurant($_POST['idRestaurant'], $_POST['name'], $_POST['description']);

    header('Location: ../templates/restaurant.php?idRestaurant=' . $_POST['idRestaurant']);
?>