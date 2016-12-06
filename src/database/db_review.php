<?php
    function registerReview($rating, $comment, $idRestaurant, $idReviewer) {
        global $db;

        $stmt = $db->prepare('INSERT INTO Review VALUES (null, :score, :comment, :idRestaurant, :idReviewer)');
        $stmt->bindParam(':score', $rating);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':idRestaurant', $idRestaurant);
        $stmt->bindParam(':idReviewer', $idReviewer);
        $stmt->execute();
    }

    //Returns all review for the same restaurant
    function getAllReviews($id) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Review WHERE idRestaurant = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getReviewById($id) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Review WHERE idReview = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    } 
?>