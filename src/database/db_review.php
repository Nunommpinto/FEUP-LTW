<?php
    function registerReview($score, $comment, $idRestaurant, $idReviewer) {
        global $db;

        $stmt = $db->prepare('INSERT INTO Review VALUES (null, :score, :comment, :idRestaurant, :idReviewer)');
        $stmt->bindParam(':score', $score);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':idRestaurant', $idRestaurant);
        $stmt->bindParam(':idReviewer', $idReviewer);
        $stmt->execute();
    }

    function getAllReviews($id) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Review WHERE idRestaurant = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
?>