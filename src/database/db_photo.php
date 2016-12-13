<?php
    //Register a photo
    function registerPhoto($fileName, $idRestaurantInfo) {
        global $db;

        $stmt = $db->prepare('INSERT INTO PhotoRestaurant VALUES (null, :title, :idRestaurantInfo)');
        $stmt->bindParam(':title', $fileName);
        $stmt->bindParam(':idRestaurantInfo', $idRestaurantInfo);
        $stmt->execute();

        $id = $db->lastInsertId();
        return "../images/originals/$id.";
    }

    //Returns all photos given it's restaurant info id
    function getAllPhotosFromRestaurant($idRestaurantInfo) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM PhotoRestaurant WHERE idRestaurantInfo = :idRestaurantInfo');
        $stmt->bindParam(':idRestaurantInfo', $idRestaurantInfo);
        $stmt->execute();
        return $stmt->fetchAll();
    }
?>