<?php
    include_once('../templates/header.php');
?>

<form action="../database/action_search_restaurant.php" method="get">
    <br>
	<label>Name: </label> <input type="text" name="name">
    <label>Min score: </label> <input type="number" name="min-score" min="0" max="5">
    <label>Max score: </label> <input type="number" name="max-score" min="0" max="5">
    <label>Average Price: </label> <input type="number" name="price">
    <label>Country: </label> <input type="text" name="country">
    <label>City: </label> <input type="text" name="city">
    <input type="submit" value="Search">
</form>