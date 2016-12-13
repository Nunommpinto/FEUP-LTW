<?php
    //Register a photo
    function registerPhoto($idRestaurantInfo, $type, $fileName) {
        global $db;

        $stmt = $db->prepare('INSERT INTO PhotoRestaurant VALUES (null, :type, :title, :idRestaurantInfo)');
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':title', $fileName);
        $stmt->bindParam(':idRestaurantInfo', $idRestaurantInfo);
        $stmt->execute();

        $id = $db->lastInsertId();
        return "../images/originals/" . $id . '.' . $type;
    }

    //Retuns a photo given it's restaurant info id
    function getPhotoById($idRestaurantInfo) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM PhotoRestaurant WHERE idRestaurantInfo = :id');
        $stmt->bindParam(':id', $idRestaurantInfo);
        $stmt->execute();
        return $stmt->fetch();
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