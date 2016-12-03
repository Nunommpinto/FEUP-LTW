<?php
    if(!isset($_POST['review']))
        die('The user did not follow the protocol');

    include_once('database/connection.php');
    include_once('database/db_review.php');

    registerReview(3, $_POST['review'], 1, 1);

    header('Location: homepage.php');
?>