<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../javascript/add_restaurant.js"></script>
<script type="text/javascript" src="../javascript/upload_image.js"></script>

<form id="form-component" action="../database/action_add_restaurant.php" method="post" enctype="multipart/form-data">
    <label>Name: </label> <input type="text" name="name" required="required"> *
    <label>Description: </label><textarea name="description" required="required" rows="4" cols="40"></textarea> *
	
	<br><br>
    <label>Average Price (per person): </label> <input type="number" name="price" min="0">
	
	<br><br>
    <label>Categories: </label>
	<br>
    <input type="checkbox" name="categories[]" value="Gourmet">Gourmet
    <input type="checkbox" name="categories[]" value="FastFood">Fast Food
    <input type="checkbox" name="categories[]" value="Vegetarian">Vegetarian
	<input type="checkbox" name="categories[]" value="Snackbar">Snackbar
	
	<br><br>
    <label>Are dogs allowed? </label><input type="checkbox" name="dogAllowed" value="true">
	
	<br><br>
    <label>Open hours: </label><input type="time" name="openHours">
    <label>Close hours: </label><input type="time" name="closeHours">
	
	<br><br>
    <label>Country: </label> <input type="text" name="country">
    <label>City: </label> <input type="text" name="city">
    <label>Road: </label> <input type="text" name="road">
    <label>Postal Code: </label> <input type="text" name="postalCode">
	
	<br><br>
    <label>Upload Image</label>
    <div class="file_div1">
        <input type="text" name="title1">
        <input type="file" class="image1" name="image[]">
    </div>

    <input type="button" id="btn_add_more" value="Add more photos" />
	
	<br><br>
    <input type="submit" value="Register">
</form>