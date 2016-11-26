<!-- Functions to handle restaurants in the database -->

<?php

function getRestaurant($idRestaurant) {
    global $db;

    //$stmt = $db->prepare('SELECT * FROM Restaurant where idRestaurant = ?');
    $stmt = $db->prepare('SELECT * FROM post where title = ?');
    $stmt->execute(array($idRestaurant));

    return $stmt->fetch();
}

function getAllRestaurants() {
    global $db;

    //$stmt = $db->prepare('SELECT * FROM Restaurant');
    $stmt = $db->prepare('SELECT * FROM post');
    $stmt->execute();
    
    return $stmt->fetchAll();
}

function getRestaurantById($idRestaurant) {
    global $db;

    /*$stmt = $db->prepare('SELECT * from Restaurant WHERE idRestaurant = ?');
    $stmt->execute(array($_GET['idRestaurant']));
    return $stmt->fetch();*/

    $stmt = $db->prepare('SELECT * from post WHERE id = ?');
    $stmt->execute(array($_GET['id']));
    return $stmt->fetch();
}

function registerRestaurant($name, $description) {
    global $db;

    $stmt = $db->prepare('INSERT INTO Restaurant VALUES (?, ?)');
    $stmt->prerare(array($name, $description));
    $stmt->execute();
}

?>