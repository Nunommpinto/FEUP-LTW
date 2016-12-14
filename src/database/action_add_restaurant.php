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
    include_once('../templates/alert.php');

    if (!isset($_SESSION['username'])) {
         header('Location: ../pages/index.php');
    } else if (!isset($_POST['name']) || !isset($_POST['description']) || !isset($_POST['categories']) || basename($_FILES['image']['name'][0]) == 0) {
        $msg = "Please fill the required fields:";
        if (!isset($_POST['name'])) $msg = $msg . " Name";
        if (!isset($_POST['description'])) $msg = $msg . " Description";
        if (!isset($_POST['categories'])) $msg = $msg . " Categories(at least one)";
        if (basename($_FILES['image']['name'][0]) == 0) $msg = $msg . " Images(at least one)";
        addWarn($msg, 'Missing information!');
        header('Location: ../pages/add_restaurant.php');
    
    // Validated
    } else {
        $idLocalization = registerLocalization($_POST['country'], $_POST['city'], $_POST['road'], $_POST['postalCode']);
        $idRestaurantInfo = registerRestaurantInfo($_POST['price'], $_POST['categories'], $_POST['openHours'], $_POST['closeHours'], $idLocalization);
        $idRestaurant = registerRestaurant($_POST['name'], $_POST['description'], intval($_SESSION['idUser'][0]), $idRestaurantInfo);

        //Photo handling
        for($i = 0; $i < count($_FILES['image']['tmp_name']); $i++) {
            $validExtensions = array('jpg', 'png', 'jpeg');
            $ext = explode('.', basename($_FILES['image']['name'][$i]));
            $fileExtension = end($ext);
            if(in_array($fileExtension, $validExtensions)) {
                $path = registerPhoto($idRestaurantInfo['idRestaurantInfo'], $fileExtension, $_POST['title' . ($i + 1)]);
                move_uploaded_file($_FILES['image']['tmp_name'][$i], $path);
            }
        }

        header('Location: ../templates/restaurant.php?idRestaurant=' .  $idRestaurant);
    }
?>