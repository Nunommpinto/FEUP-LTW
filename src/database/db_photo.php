<?php
    function registerPhoto($fileName, $idRestaurantInfo) {
        global $db;

        $stmt = $db->prepare('INSERT INTO PhotoRestaurant VALUES (null, :title, :idRestaurantInfo)');
        $stmt->bindParam(':title', $fileName);
        $stmt->bindParam(':idRestaurantInfo', $idRestaurantInfo);
        $stmt->execute();

        $id = $db->lastInsertId();
        $originalFileName = "images/originals/$id.jpg";

        move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);
        $original = imagecreatefromjpeg($originalFileName);
    }

    function getPhotoById($idRestaurantInfo) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM PhotoRestaurant WHERE idRestaurantInfo = :id');
        $stmt->bindParam(':id', $idRestaurantInfo);
        $stmt->execute();

        return $stmt->fetch();
    }
?>