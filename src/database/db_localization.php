<?php
    function registerLocalization($country, $city, $road, $postalCode) {
        global $db;

        $stmt = $db->prepare('INSERT INTO Localization VALUES (null, :country, :city, :road, :postalCode, 1)');
        if($country != null)
            $stmt->bindParam(':country', $country);
        if($city != null)
            $stmt->bindParam(':city', $city);
        if($road != null)
            $stmt->bindParam(':road', $road);
        if($postalCode != null)
            $stmt->bindParam(':postalCode', $postalCode);
        $stmt->execute();
    }
?>