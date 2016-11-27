<?php
    function getLocalizationById($idLocalization) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Localization WHERE idLocalization = :id');
        $stmt->bindParam(':id', $idLocalization);
        $stmt->execute();
        return $stmt->fetch();
    }

    function registerLocalization($country, $city, $road, $postalCode) {
        global $db;

        $stmt = $db->prepare('INSERT INTO Localization VALUES (null, :country, :city, :road, :postalCode)');
        if($country != null)
            $stmt->bindParam(':country', $country);
        if($city != null)
            $stmt->bindParam(':city', $city);
        if($road != null)
            $stmt->bindParam(':road', $road);
        if($postalCode != null)
            $stmt->bindParam(':postalCode', $postalCode);
        $stmt->execute();

        //Returns the id so that we can reference it on the restaurantInfo
        return $db->lastInsertId();
    }
?>