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
    } else if (!isset($_POST['name']) || !isset($_POST['description']) || !isset($_POST['categories']) || !isset($_FILES['image']['name'][0])) {
        $msg = "Please fill the required fields:";
        if (!isset($_POST['name'])) $msg = $msg . " Name";
        if (!isset($_POST['description'])) $msg = $msg . " Description";
        if (!isset($_POST['categories'])) $msg = $msg . " Categories(at least one)";
        if (!isset($_FILES['image']['name'][0])) $msg = $msg . " Images(at least one)";
        addWarn($msg, 'Missing information!');
        die(header('Location: ../pages/add_restaurant.php'));
    // Validated
    } else {

        if(preg_match('/[0-9a-zA-Z]{2,}/', $_POST['name'], $matches) != 1)
            die(header('Location: ../pages/add_restaurant.php'));
        if(preg_match('/[0-9a-zA-Z]+/', $_POST['description'], $matches) != 1)
            die(header('Location: ../pages/add_restaurant.php'));
        if(preg_match('/[0-9]+/', $_POST['price'], $matches) != 1)
            die(header('Location: ../pages/add_restaurant.php'));
        /*if(preg_match('/[a-zA-Z]+/', $_POST['country'], $matches) != 1)
            die(header('Location: ../pages/add_restaurant.php'));
        if(preg_match('/[a-zA-Z]+/', $_POST['city'], $matches) != 1)
            die(header('Location: ../pages/add_restaurant.php'));
        if(preg_match('/[a-zA-Z]+/', $_POST['road'], $matches) != 1)
            die(header('Location: ../pages/add_restaurant.php'));*/

        $idLocalization = registerLocalization($_POST['country'], $_POST['city'], $_POST['road'], $_POST['postalCode']);
        $idRestaurantInfo = registerRestaurantInfo($_POST['price'], $_POST['categories'], $_POST['openHours'], $_POST['closeHours'], $idLocalization);
        $idRestaurant = registerRestaurant(trim(strip_tags($_POST['name'])), $_POST['description'], intval($_SESSION['idUser'][0]), $idRestaurantInfo);

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