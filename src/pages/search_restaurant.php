<html>
<head>
<link rel="stylesheet" href="../css/search_restaurant.css">
</head>
</html>

<?php
    include_once('../templates/header.php');
?>

<form id="search" action="../database/action_search_restaurant.php" method="get">
    <h3> Insert the information above </h3>
	<label>Name: </label> <input type="text" name="name">
	
	<br><br>
    <label>Min score: </label> <input type="number" name="min-score" min="0" max="5">
	<div id="max">
	<label>Max score: </label> <input type="number" name="max-score" min="0" max="5">
	</div>
	
	<br><br><br>
    <label>Average Price: </label> <input type="number" name="price">
	<br><br>
	
	<div id="labels">
    <label>Country: </label> <input type="text" name="country">
    <label>City: </label> <input type="text" name="city">
	</div>
    <input type="submit" value="Search">
</form>