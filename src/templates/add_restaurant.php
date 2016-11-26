<form action="save_restaurant.php" method="post">
    <input type="hidden" name="idOwner" value="1">
    <input type="hidden" name="idRestaurantInfo" value="1">

    <label>Name: </label> <input type="text" name="name" required="required">
    <label>Description: </label> <input type="text" name="description" required="required">
    <input type="submit" value="send">
</form>