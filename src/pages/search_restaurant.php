<?php
    include_once('../templates/header.php');
?>

<script type="text/javascript" src="../javascript/search_restaurant.js"></script>

<form class="form-search" action="javascript:void(0);">
    <h3> Insert the necessary information </h3>
	<label>Name: </label>
	<input id="search-input-name" class="search" type="text" name="name" value="Jose">
	
	<br><br>
    <label><b>Min score: </b></label> 
	<input id="search-input-min" class="search" type="number" name="min-score" min="0" max="5">

	<div id="max">
	<label>Max score: </label>
	<input id="search-input-max" class="search" type="number" name="max-score" min="0" max="5">
	</div>
	
	<br><br><br>
    <label>Average Price: </label>
	<input id="search-input-price" class="search" type="number" name="price">
	<br><br>
	
	<div id="labels">
		<label>Country: </label>
		<input id="search-input-country" class="search" type="text" name="country">

		<label>City: </label>
		<input id="search-input-city" class="search" type="text" name="city">
	</div>

	<div id="search-output-restaurant" class="search"></div>
</form>