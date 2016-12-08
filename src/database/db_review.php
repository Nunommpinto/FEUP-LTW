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

    function updateReview($id, $updatedScore, $updatedComment) {
        global $db;

        $stmt = $db->prepare('UPDATE Review SET score = :updatedScore, comment = :updatedComment WHERE idReview = :id');
        $stmt->bindParam(':updatedScore', $updatedScore);
        $stmt->bindParam(':updatedComment', $updatedComment);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    //Returns the id of the user who wrote the review
    function getUserId($idReview) {
        global $db;

        $stmt = $db->prepare('SELECT idUser FROM Review WHERE idReview = :idReview');
        $stmt->bindParam('idReview', $idReview);
        $stmt->execute();
        return $stmt->fetch();
    }
	
	function deleteReview($id) {
    global $db;

    $stmt = $db->prepare('DELETE FROM Review WHERE idReview = :id');
    $stmt->bindParam('id', $id);
	$stmt->execute();
	
	$stmt = $db->prepare('DELETE FROM Reply WHERE idReview = :id');
    $stmt->bindParam('id', $id);
	$stmt->execute();

    return true;
	}
?>