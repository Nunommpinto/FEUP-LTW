<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    include_once('../database/connection.php');
    include_once('../database/db_restaurants.php');
    include_once('../database/db_restaurants_info.php');
    include_once('../database/db_localization.php');
    include_once('../database/db_photo.php');

    $restaurants = getAllOwnedRestaurants(intval($_SESSION['idUser'][0]));
    foreach($restaurants as $restaurant) {
        $info = getInfoById($restaurant['idRestaurantInfo']);
        $localization = getLocalizationById($info['idLocalization']);
        $photo = getPhotoById($info['idRestaurantInfo']);
?>

<a href="../pages/edit_restaurant.php?idRestaurant=<?=$restaurant['idRestaurant']?>">
    <img src="../images/originals/<?=$photo['idPhoto']?>.<?=$photo['type']?>" alt="<?=$photo['title']?>" width="300" height="200"> <br>
</a> <br>
<a href="../pages/edit_restaurant.php?idRestaurant=<?=$restaurant['idRestaurant']?>"><?=$restaurant['name']?></a> <br>
<?=$localization['city']?> <br>
<?=$localization['road']?> <br>
<?=$localization['postalCode']?>
<br> <br>
<?php } ?>