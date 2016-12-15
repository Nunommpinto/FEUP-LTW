<div class="form-component">
    <form action="../database/action_write_review.php" method="post">
        <input type="hidden" name="idRestaurant" value="<?=$_GET['idRestaurant']?>">
		<br>
		
        <label>Review: </label><textarea name="review" required="required" rows="6" cols="80" placeholder='Express your opinion about the restaurant...'></textarea>
		
		<div id="score">
        Rating: <input type="number" name="rating" min="0" max="5">
		</div>
		
		<br>
        <input type="submit" value="Send">
    </form>
</div>