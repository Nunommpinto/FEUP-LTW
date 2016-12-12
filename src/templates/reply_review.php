<?php
    if (session_status() == PHP_SESSION_NONE) 
        session_start();
	
	include_once('header.php');
?>

<form id='form-component' action='../database/action_reply_review.php' method='post'>
    <input type="hidden" name="idReview" value="<?=$_GET['idReview']?>">
	<br>
	<label>Reply Comment: </label><textarea name="comment" required="required" rows="6" cols="80" placeholder='Reply to the review...'></textarea>
	
    <input type="submit" value="Reply">
</form>