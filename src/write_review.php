<?php
    include_once('templates/header.php');
?>

<form action="action_write_review.php" method="post">
    <input type="hidden" name="idRestaurant" value="<?$_GET['idRestaurant']?>">
    <textarea name="review" required="required" rows="6" cols="80"></textarea>
    <input type="submit" value="Send">
</form>