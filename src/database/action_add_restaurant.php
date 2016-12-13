<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    if(!isset($_POST['name'])
        || trim($_POST['name']) == ''
        || !isset($_POST['description'])
        || trim($_POST['description']) == '')
        die('The user did not follow the protocol');

    include_once('connection.php');
    include_once('db_localization.php');
    include_once('db_restaurants_info.php');
    include_once('db_photo.php');
    include_once('db_restaurants.php');

    $idLocalization = registerLocalization($_POST['country'], $_POST['city'], $_POST['road'], $_POST['postalCode']);
    $idRestaurantInfo = registerRestaurantInfo($_POST['price'], $_POST['category'], $_POST['openHours'], $_POST['closeHours'], $idLocalization);
    $idRestaurant = registerRestaurant($_POST['name'], $_POST['description'], intval($_SESSION['idUser'][0]), $idRestaurantInfo);

    //Photo handling
    for($i = 0; $i < count($_FILES['image']['tmp_name']); $i++) {
        $validExtensions = array('jpg', 'png', 'jpeg');
        $ext = explode('.', basename($_FILES['image']['name'][$i]));
        $fileExtension = end($ext);
        if(in_array($fileExtension, $validExtensions)) {
            $path = registerPhoto($_POST['title' . ($i + 1)], $idRestaurantInfo['idRestaurantInfo']);
            move_uploaded_file($_FILES['image']['tmp_name'][$i], $path . $fileExtension);
        }
    }

    header('Location: ../templates/restaurant.php?idRestaurant=' .  $idRestaurant);
?>