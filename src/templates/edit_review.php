<?php
    if(!isset($_GET['idReview']))
        die('Review id not set!');

    include_once('../database/connection.php');
    include_once('../database/db_review.php');

    $review = getReviewById($_GET['idReview']);
?>

<form id='form-component' action='../database/action_edit_review.php' method='post'>
    <input type="hidden" name="idReview" value="<?=$_GET['idReview']?>">

    <label>Comment: </label> <textarea name="comment" rows="6" cols="80"><?=$review['comment']?></textarea>
    <label>Score: </label>  <input type="number" name="score" value="<?=$review['score']?>">
    <input type="submit" value="Save">
</form>