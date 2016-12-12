<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();
    
    $info = getInfoById($restaurant['idRestaurantInfo']);
    $localization = getLocalizationById($info['idLocalization']);
    $photo = getPhotoById($info['idRestaurantInfo']);
?>

<form id="form-component" action="../database/action_edit_restaurant.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="idRestaurant" value=<?=$restaurant['idRestaurant']?>>
    
    <label>Name: </label> <input type="text" name="name" required="required" value=<?=$restaurant['name']?>> *
    <label>Description: </label><textarea name="description" required="required" rows="4" cols="40"><?=$restaurant['description']?></textarea> *
	
	<br><br>
    <label>Average Price (per person): </label> <input type="number" name="price" min="0" value=<?=$info['price']?>>
	
	<br><br>
    <label>Categories: </label>
	<br>
    <input type="checkbox" name="categories" value="Gourmet">Gourmet
    <input type="checkbox" name="categories" value="FastFood">Fast Food
    <input type="checkbox" name="categories" value="Vegetarian">Vegetarian
	<input type="checkbox" name="categories" value="Snackbar">Snackbar
	
	<br><br>
    <label>Are dogs allowed? </label><input type="checkbox" name="dogAllowed" value="true">
	
	<br><br>
    <label>Open hours: </label><input type="time" name="openHours" value=<?=$info['openHours']?>>
    <label>Close hours: </label><input type="time" name="closeHours" value=<?=$info['closeHours']?>>
	
	<br><br>
    <label>Country: </label> <input type="text" name="country" value=<?=$localization['country']?>>
    <label>City: </label> <input type="text" name="city" value=<?=$localization['city']?>>
    <label>Road: </label> <input type="text" name="road" value=<?=$localization['road']?>>
    <label>Postal Code: </label> <input type="text" name="postalCode" value=<?=$localization['postalCode']?>>

    <label>Title: </label> <input type="text" name="title">
	
	<br><br>
    <label>Upload Image: </label> <input type="file" name="image">
	
	<br><br>
    <input type="submit" value="Register">
    <!-- Do integration with google maps -->
</form>