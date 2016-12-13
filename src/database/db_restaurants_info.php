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

        //Returns the id so that we can reference it on the restaurant
        return $db->lastInsertId();
    }

    function updateRestaurantInfo($idRestaurantInfo, $newPrice, $newOpenHours, $newCloseHours) {
        global $db;

        $stmt = $db->prepare('UPDATE RestaurantInfo SET price = :newPrice, openHours = :newOpenHours, closeHours = :newCloseHours WHERE idRestaurantInfo = :idRestaurantInfo');
        $stmt->bindParam(':newPrice', $newPrice);
        $stmt->bindParam(':newOpenHours', $newOpenHours);
        $stmt->bindParam(':newCloseHours', $newCloseHours);
        $stmt->bindParam(':idRestaurantInfo', $idRestaurantInfo);
        $stmt->execute();

        return true;
    }
?>