<!-- Functions to handle restaurants in the database -->

<?php

    //Returns all restaurants
    function getNewestRestaurants() {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Restaurant ORDER BY idRestaurant DESC LIMIT 10');
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    //Returns the restaurant with id 'idRestaurant' ($_GET method)
    function getRestaurantById($idRestaurant) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Restaurant WHERE idRestaurant = :id');
        if($stmt == false)
            echo 'FALSE';
        $stmt->bindParam(':id', $idRestaurant);
        $stmt->execute();
        return $stmt->fetch();
    }

    //Returns 'idRestaurantInfo' of the restaurant with idRestaurant = $idRestaurant
    function getLocalizationId($idRestaurant) {
        global $db;

        $stmt = $db->prepare('SELECT idRestaurantInfo FROM Restaurant WHERE idRestaurant = :id');
        $stmt->bindParam(':id', $idRestaurant);
        $stmt->execute();
        return $stmt->fetch();
    }

    //Inserts a new restaurant in the database ($_POST method)
    function registerRestaurant($name, $description, $idOwner, $idRestaurantInfo) {
        global $db;

        $stmt = $db->prepare('INSERT INTO Restaurant VALUES (null, :name, :description, 0, :idOwner, :idRestaurantInfo)');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':idOwner', $idOwner);
        $stmt->bindParam(':idRestaurantInfo', $idRestaurantInfo);
        $stmt->execute();

        return $db->lastInsertId();
    }

    //Updates the review score when a new review is registered
    function updateScore($idRestaurant) {
        global $db;

        //Gets an array of all the scores already given to a restaurant
        $stmt = $db->prepare('SELECT score FROM Review WHERE idRestaurant = :id');
        $stmt->bindParam(':id', $idRestaurant);
        $stmt->execute();
        $reviewsScore = $stmt->fetchAll();

        //Gets the number of reviews given to a restaurant
        $stmt = $db->prepare('SELECT count(*) FROM Review WHERE idRestaurant = :id');
        $stmt->bindParam(':id', $idRestaurant);
        $stmt->execute();
        $numReviews = $stmt->fetch();

        $totalScore = 0;
        foreach($reviewsScore as $score)
            $totalScore += $score['score'];

        $updatedScore = $totalScore / $numReviews['count(*)'];

        $stmt = $db->prepare('UPDATE Restaurant SET score = :updatedScore WHERE idRestaurant = :id');
        $stmt->bindParam(':updatedScore', $updatedScore);
        $stmt->bindParam(':id', $idRestaurant);
        $stmt->execute();
    }

    //Searches a restaurant with a given name
    function searchRestaurant($name) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Restaurant WHERE name = :name');
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->fetch();
    }

    //Searches the best 10 restaurants based on average score
    function searchTopRestaurants() {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Restaurant ORDER BY score DESC LIMIT 10');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //Searches all the restaurants that match user's specifications
    function advancedSearch($name, $minScore, $maxScore) {
        global $db;

        $query = 'SELECT * FROM Restaurant WHERE';
        $operator = ' ';

        if(isset($name) && trim($name) != '') {
            $query .= ' name = ' . '\'' . $name . '\'';
            $operator = ' AND ';
        }
        if(isset($minScore) && trim($minScore) != '') {
            $query .= $operator . 'score >= ' . $minScore;
            $operator = ' AND ';
        }
        if(isset($maxScore) && trim($maxScore) != '') {
            if((isset($minScore) && $maxScore >= $minScore) || !isset($minScore)) {
                    $query .= $operator . 'score <= ' . $maxScore;
                    $operator = ' AND ';
            }
        }
        
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //Returns all restaurants that user with id 'idOwner' has
    function getAllOwnedRestaurants($idOwner) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Restaurant WHERE idOwner = :idOwner');
        $stmt->bindParam('idOwner', $idOwner);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function updateRestaurant($idRestaurant, $newName, $newDescription) {
        global $db;

        $stmt = $db->prepare('UPDATE Restaurant SET name = :newName, description = :newDescription WHERE idRestaurant = :idRestaurant');
        $stmt->bindParam('newName', $newName);
        $stmt->bindParam('newDescription', $newDescription);
        $stmt->bindParam('idRestaurant', $idRestaurant);
        $stmt->execute();
        
        return true;
    }
?>