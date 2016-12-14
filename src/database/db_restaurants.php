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

        $stmt = $db->prepare('INSERT INTO Restaurant VALUES (null, :name, :description, null, :idOwner, :idRestaurantInfo)');
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

    function getRestaurantsByIdRestaurantInfo($idRestaurantInfo) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Restaurant WHERE idRestaurantInfo = :idRestaurantInfo');
        $stmt->bindParam(':idRestaurantInfo', $idRestaurantInfo);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //Searches all the restaurants that match user's specifications
    function advancedSearch($name, $minScore, $maxScore, $price, $country, $city) {
        global $db;
        include_once('db_restaurants_info.php');

        $restaurantQuery = 'SELECT * FROM Restaurant WHERE';
        $operator = ' ';
        if(isset($name) && trim($name) != '') {
            $restaurantQuery .= ' name LIKE \'%' . $name . '%\'';
            $operator = ' AND ';
        }
        if(isset($minScore) && trim($minScore) != '') {
            $restaurantQuery .= $operator . 'score >= ' . $minScore;
            $operator = ' AND ';
        }
        if(isset($maxScore) && trim($maxScore) != '')
            if((isset($minScore) && $maxScore >= $minScore) || !isset($minScore))
                    $restaurantQuery .= $operator . 'score <= ' . $maxScore;
        $restaurants;
        if($operator != ' ') {
            $stmt = $db->prepare($restaurantQuery);
            $stmt->execute();
            $restaurants = $stmt->fetchAll();
        }
        

        $infoQuery = 'SELECT * FROM RestaurantInfo WHERE';
        $operator = ' ';
        if(isset($price) && trim($price) != '') {
            $infoQuery .= $operator . 'price = ' . $price;
            $operator = ' AND ';
        }
        $restaurantsInfo;
        if($operator != ' ') {
            $stmt = $db->prepare($infoQuery);
            $stmt->execute();
            $restaurantsInfo = $stmt->fetchAll();
        }


        $localizationQuery = 'SELECT * FROM Localization WHERE';
        $operator = ' ';
        if(isset($country) && trim($country) != '') {
            $infoQuery .= $operator . 'country LIKE \'%' . $country . '%\'';
            $operator = ' AND ';
        }
        if(isset($city) && trim($city) != '') {
            $infoQuery .= $operator . 'city LIKE \'%' . $city . '%\'';
            $operator = ' AND ';
        }
        $localization;
        if($operator != ' ') {
            $stmt = $db->prepare($localization);
            $stmt->execute();
            $localization = $stmt->fetchAll();
        }

        $results = array();
        if(isset($restaurants)) {
            foreach($restaurants as $restaurant) {
                if(isset($restaurantsInfo)) {
                    $restInfo = getInfoById($restaurant['idRestaurantInfo']);
                    foreach($restaurantsInfo as $restaurantInfo) {
                        if($restInfo['idRestaurantInfo'] == $restaurantInfo['idRestaurantInfo']) {
                            array_push($results, $restaurant);
                            break;
                        }
                    }
                } else
                    array_push($results, $restaurant);
            }
        } else if(isset($restaurantsInfo)) {
            foreach($restaurantsInfo as $restaurantInfo) {
                $restaurant = getRestaurantsByIdRestaurantInfo($restaurantInfo['idRestaurantInfo']);
                array_push($results, $restaurant);
            }
        }

        //var_dump($results);
        return $results;
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