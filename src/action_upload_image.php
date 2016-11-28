<?php
    include_once('database/connection.php');
    include_once('database/db_photo.php');

    registerPhoto($_POST['title'], 3);

    header('Location: homepage.php');
?>