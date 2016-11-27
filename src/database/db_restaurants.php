<!-- Functions to handle restaurants in the database -->

<?php

//Returns all restaurants
function getAllRestaurants() {
    global $db;

    $stmt = $db->prepare('SELECT * FROM Restaurant');
    $stmt->execute();
    
    return $stmt->fetchAll();
}

//Returns the restaurant with id 'idRestaurant' ($_GET method)
function getRestaurantById() {
    global $db;

    $stmt = $db->prepare('SELECT * FROM Restaurant WHERE idRestaurant = ?');
    $stmt->execute(array($_GET['idRestaurant']));
    return $stmt->fetch();
}

//Returns 'idRestaurantInfo' of the restaurant with idRestaurant = $idRestaurant
function getLocalizationId($idRestaurant) {
    global $db;

    $stmt = $db->prepare('SELECT idRestaurantInfo FROM Restaurant WHERE idRestaurant = :id');
    $stmt->bindParam(':id', $idRestaurant);
    $stmt->execute();
    return $stmt->fetch();
}

//Inserts a new restaurant in the database ($_POST method)
function registerRestaurant($name, $description, $idOwner, $idRestaurantInfo) {
    global $db;

    $stmt = $db->prepare('INSERT INTO Restaurant VALUES (null, :name, :description, :idOwner, :idRestaurantInfo)');
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':idOwner', $idOwner);
    $stmt->bindParam(':idRestaurantInfo', $idRestaurantInfo);
    $stmt->execute();
}

function searchRestaurant($name) {
    global $db;

    $stmt = $db->prepare('SELECT * FROM Restaurant WHERE name = ?');
    $stmt->execute(array($name));
    return $stmt->fetch();
}

?>