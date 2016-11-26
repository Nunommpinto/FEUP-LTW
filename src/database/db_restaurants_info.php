<?php
    function registerRestaurantInfo($price, $category, $openHours, $closeHours) {
        global $db;

        $stmt = $db->prepare('INSERT INTO RestaurantInfo VALUES (null, :price, :category, :openHours, :closeHours, 1)');
        if($price != null)
            $stmt->bindParam(':price', $price);
        if($category != null)
            $stmt->bindParam(':category', $category);
        if($openHours != null)
            $stmt->bindParam(':openHours', $openHours);
        if($closeHours != null)
            $stmt->bindParam(':closeHours', $closeHours);
        $stmt->execute();
    }
?>