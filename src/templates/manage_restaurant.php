<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    include_once('../database/connection.php');
    include_once('../database/db_restaurants.php');
    include_once('../database/db_restaurants_info.php');
    include_once('../database/db_localization.php');
    include_once('../database/db_photo.php');

    /*$info = getInfoById($restaurant['idRestaurantInfo']);
    $localization = getLocalizationById($info['idLocalization']);
    $photo = getPhotoById($info['idRestaurantInfo']);*/

    $restaurants = getAllOwnedRestaurants(intval($_SESSION['idUser'][0]));
    var_dump($restaurants);
?>