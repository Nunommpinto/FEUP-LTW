<?php
    //Returns a localization given it's id
    function getLocalizationById($idLocalization) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Localization WHERE idLocalization = :id');
        $stmt->bindParam(':id', $idLocalization);
        $stmt->execute();
        return $stmt->fetch();
    }

    //Registers a localization
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

    //Updates localization
    function updateLocalization($idLocalization, $newCountry, $newCity, $newRoad, $newPostalCode) {
        global $db;

        $stmt = $db->prepare('UPDATE Localization SET country = :newCountry, city = :newCity, road = :newRoad, postalCode = :newPostalCode WHERE idLocalization = :idLocalization');
        $stmt->bindParam(':newCountry', $newCountry);
        $stmt->bindParam(':newCity', $newCity);
        $stmt->bindParam(':newRoad', $newRoad);
        $stmt->bindParam(':newPostalCode', $newPostalCode);
        $stmt->bindParam(':idLocalization', $idLocalization);
        $stmt->execute();

        return true;
    }
?>