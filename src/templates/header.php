<?php include_once('../templates/alert.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>LTW Advisor</title>
        <meta charset="UTF-8">
		<script 
                src="https://code.jquery.com/jquery-3.1.1.min.js"
                integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
                crossorigin="anonymous">
        </script>
        <script type="text/javascript" src="../javascript/header.js"></script>
        <script type="text/javascript" src="../javascript/alert.js"></script>
        <script type="text/javascript" src="../javascript/login_dropdown.js"></script>
        <script type="text/javascript" src="../javascript/user_dropdown.js"></script>
		<link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/alert.css">
        <link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href="../css/login_dropdown.css">
        <link rel="stylesheet" href="../css/user_dropdown.css">
        <link rel="stylesheet" href="../css/profile.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
		<link rel="stylesheet" href="../css/search_restaurant.css">        
    </head>

    <body>
        <?php echo getAlert(); ?>
        <div id="header">
            <h1>LTW Advisor</h1>
            <h2>The definitive restaurant reviews website!</h2>
        </div>
        <div id="nav-btns" class="nav-btns">
            <ul>
                <li><a href="../pages/index.php">Home</a></li>
                <li><a href="../pages/top_restaurants.php">Top Restaurants</a></li>
                <li><a href="../pages/search_restaurant.php">Search a restaurant</a></li>
                <li><a href="../pages/add_restaurant.php">Add a new restaurant</a></li>
                <div id="user-info">
                    <?php
                        if (isset($_SESSION['username'])) {
                            include_once("../templates/user_dropdown.php");
                            include_once("../templates/profile.php");
                        } else { 
                            include_once("../templates/login_dropdown.php");
                        }
                    ?>
                </div>  
            </ul>
        </div>