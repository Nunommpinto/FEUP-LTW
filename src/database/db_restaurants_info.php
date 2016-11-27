<?php
    function getInfoById($idRestaurantInfo) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM RestaurantInfo WHERE idRestaurantInfo = :id');
        $stmt->bindParam(':id', $idRestaurantInfo);
        $stmt->execute();
        return $stmt->fetch();
    }

    function registerRestaurantInfo($price, $category, $openHours, $closeHours, $idLocalization) {
        global $db;

        $stmt = $db->prepare('INSERT INTO RestaurantInfo VALUES (null, :price, :category, :openHours, :closeHours, :idLocalization)');
        if($price != null)
            $stmt->bindParam(':price', $price);
        if($category != null)
            $stmt->bindParam(':category', $category);
        if($openHours != null)
            $stmt->bindParam(':openHours', $openHours);
        if($closeHours != null)
            $stmt->bindParam(':closeHours', $closeHours);
        if($idLocalization != null)
            $stmt->bindParam(':idLocalization', $idLocalization);
        $stmt->execute();

        return $db->lastInsertId();
    }
?>