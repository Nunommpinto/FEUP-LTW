<form action="action_add_restaurant.php" method="post">
    <input type="hidden" name="idOwner" value="1">
    <input type="hidden" name="idRestaurantInfo" value="1">

    <label>Name: </label> <input type="text" name="name" required="required"> *
    <label>Description: </label><textarea name="description" required="required" rows="4" cols="40"></textarea> *

    <label>Average Price: </label> <input type="number" name="price" min="0">
    <label>Categories: </label>
    <input type="checkbox" name="categories" value="Gourmet">Gourmet
    <input type="checkbox" name="categories" value="FastFood">Fast Food
    <input type="checkbox" name="categories" value="Vegetarian">Vegetarian

    <label>Are dogs allowed? </label><input type="checkbox" name="dogAllowed" value="true">
    <label>Open hours: </label><input type="time" name="openHours">
    <label>Close hours: </label><input type="time" name="closeHours">

    <label>Country: </label> <input type="text" name="country">
    <label>City: </label> <input type="text" name="city">
    <label>Road: </label> <input type="text" name="road">
    <label>Postal Code: </label> <input type="text" name="postalCode">

    <input type="submit" value="send">
    <!-- Do integration with google maps -->
</form>