<!-- Functions to handle restaurants in the database -->

<?php

function getRestaurant($idRestaurant) {
    global $db;

    $stmt = $db->prepare('SELECT * FROM Restaurant where idRestaurant = ?');
    $stmt->execute(array($idRestaurant));

    return $stmt->fetch();
}

function getAllRestaurants() {
    global $db;

    $stmt = $db->prepare('SELECT * FROM Restaurant');
    $stmt->execute();
    
    return $stmt->fetchAll();
}

function getRestaurantById($idRestaurant) {
    global $db;

    $stmt = $db->prepare('SELECT * FROM Restaurant WHERE idRestaurant = ?');
    $stmt->execute(array($_GET['idRestaurant']));
    return $stmt->fetch();
}

function registerRestaurant($name, $description, $idOwner, $idRestaurantInfo) {
    global $db;

    $stmt = $db->prepare('INSERT INTO Restaurant VALUES (?, ?, ?, ?, ?)');
    $stmt->execute(array(null, $name, $description, $idOwner, $idRestaurantInfo));
}

?>