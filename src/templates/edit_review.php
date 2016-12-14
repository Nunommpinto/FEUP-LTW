<?php
	include_once('../templates/header.php');
	
    if (session_status() == PHP_SESSION_NONE) 
        session_start();

    if(!isset($_GET['idReview']))
        die('Review id not set!');

    include_once('../database/connection.php');
    include_once('../database/db_review.php');

    $idUserReview = getUserIdFromReview($_GET['idReview']);
    $idUserReview = intval($idUserReview[0]);
	$idUserSESSION = intval($_SESSION['idUser'][0]);

    if(!isset($_SESSION['idUser']) || $idUserReview != $idUserSESSION)
        die(header('Location: ../pages/index.php'));

    $review = getReviewById($_GET['idReview']);
?>

<form id='form-component' action='../database/action_edit_review.php' method='post'>
    <input type="hidden" name="idReview" value="<?=$_GET['idReview']?>">
	<br>
    <label>Comment: </label> <textarea name="comment" rows="6" cols="80"><?=$review['comment']?></textarea>
	<br>
    <label>Score: </label>  <input type="number" name="score" value="<?=$review['score']?>" min="0" max="5">
    <input type="submit" value="Save">
</form>