<?php
    include_once('../templates/header.php');
    include_once('../database/db_user.php');

    $isOwner = getIsOwnerById(intval($_SESSION['idUser'][0]));
    $isOwner = intval($isOwner[0]);

    if($isOwner != 0)
        include_once('../templates/add_restaurant.php');
    else
        echo 'can\'t add';
?>