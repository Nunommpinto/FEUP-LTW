<?php

	
    //Register a review
    function registerReview($rating, $comment, $idRestaurant, $idUser) {
        global $db;

        $stmt = $db->prepare('INSERT INTO Review VALUES (null, :score, :comment, :idRestaurant, :idUser)');
        $stmt->bindParam(':score', $rating);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':idRestaurant', $idRestaurant);
        $stmt->bindParam(':idUser', $idUser);
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

    //Returns a review given it's id
    function getReviewById($id) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Review WHERE idReview = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    //Updates a review
    function updateReview($id, $updatedScore, $updatedComment) {
        global $db;

        $stmt = $db->prepare('UPDATE Review SET score = :updatedScore, comment = :updatedComment WHERE idReview = :id');
        $stmt->bindParam(':updatedScore', $updatedScore);
        $stmt->bindParam(':updatedComment', $updatedComment);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    //Returns the id of the user who wrote the review
    function getUserIdFromReview($idReview) {
        global $db;

        $stmt = $db->prepare('SELECT idUser FROM Review WHERE idReview = :idReview');
        $stmt->bindParam(':idReview', $idReview);
        $stmt->execute();
        return $stmt->fetch();
    }
	
    //Deletes a review
	function deleteReview($idReview) {
        global $db;

        $stmt = $db->prepare('DELETE FROM Review WHERE idReview = :idReview');
        $stmt->bindParam('idReview', $idReview);
        $stmt->execute();
        
        $stmt = $db->prepare('DELETE FROM Reply WHERE idReview = :idReview');
        $stmt->bindParam('idReview', $idReview);
        $stmt->execute();

        return true;
	}
	
    //Registers a reply
	function registerReply($reply, $idReview, $idReplier) {
        global $db;

        $stmt = $db->prepare('INSERT INTO Reply VALUES (null, :comment, :idReview, :idReplier)');
        $stmt->bindParam(':comment', $reply);
        $stmt->bindParam(':idReview', $idReview);
		$stmt->bindParam(':idReplier', $idReplier);
        $stmt->execute();
		
		return true;
    }

    //Returns all the replies from the given review
    function getRepliesFromReview($idReview) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Reply WHERE idReview = :idReview');
        $stmt->bindParam(':idReview', $idReview);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function checkUserAlreadyReviewedRest($idRestaurant, $idUser) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Review WHERE idRestaurant = :idRestaurant AND idUser = :idUser');
        $stmt->bindParam(':idRestaurant', $idRestaurant);
        $stmt->bindParam(':idUser', $idUser);
        $stmt->execute();
        
        $result = $stmt->fetch();
        if($result)
            return true;
        else
            return false;
    }
?>