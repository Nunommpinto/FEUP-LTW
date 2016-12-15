<?php
    function getInfoById($idRestaurantInfo) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM RestaurantInfo WHERE idRestaurantInfo = :id');
        $stmt->bindParam(':id', $idRestaurantInfo);
        $stmt->execute();
        return $stmt->fetch();
    }

    function registerRestaurantInfo($price, $categories, $openHours, $closeHours, $idLocalization) {
        global $db;
        
        $stmt = $db->prepare('INSERT INTO RestaurantInfo (price, category, openHours, closeHours, idLocalization) VALUES (:price, :categories, :openHours, :closeHours, :idLocalization)');
        if($price != null)
            $stmt->bindParam(':price', $price);
        if($openHours != null)
            $stmt->bindParam(':openHours', $openHours);
        if($closeHours != null)
            $stmt->bindParam(':closeHours', $closeHours);
        if($idLocalization != null)
            $stmt->bindParam(':idLocalization', $idLocalization);
        if($categories != null) {
            $strCategories = implode(";", $categories); // $arr=explode(";",$str)
            $stmt->bindParam(':categories', $strCategories);
        }
            
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

    function getInfoByIdLocalization($idLocalization) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM RestaurantInfo WHERE idLocalization = :idLocalization');
        $stmt->bindParam(':idLocalization', $idLocalization);
        $stmt->execute();
        return $stmt->fetch();
    }
?>