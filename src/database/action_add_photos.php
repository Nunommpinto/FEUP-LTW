<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    include_once('connection.php');
    include_once('db_photo.php');

    //Photo handling
    for($i = 0; $i < count($_FILES['image']['tmp_name']); $i++) {
        $validExtensions = array('jpg', 'png', 'jpeg');
        $ext = explode('.', basename($_FILES['image']['name'][$i]));
        $fileExtension = end($ext);
        if(in_array($fileExtension, $validExtensions)) {
            $path = registerPhoto($_POST['idRestaurantInfo'], $fileExtension, $_POST['title' . ($i + 1)]);
            move_uploaded_file($_FILES['image']['tmp_name'][$i], $path);
        }
    }

    header('Location: ../templates/restaurant.php?idRestaurant=' .  $_POST['idRestaurant']);
?>