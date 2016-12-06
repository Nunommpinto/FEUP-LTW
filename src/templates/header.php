<!DOCTYPE html>
<html>
    <head>
        <title>FEUPrant</title>
        <meta charset="UTF-8">
		<script 
                src="https://code.jquery.com/jquery-3.1.1.min.js"
                integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
                crossorigin="anonymous">
        </script>
        <script type="text/javascript" src="../javascript/header.js"></script>
        <script type="text/javascript" src="../javascript/login_dropdown.js"></script>
		<link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href="../css/login_dropdown.css">
    </head>

    <body>
        <div id="header">
            <h1>FEUPrant</h1>
            <h2>The definitive restaurant reviews website!</h2>
        </div>
        <div id="nav-btns" class="nav-btns">
            <ul>
                <li><a href="../pages/index.php">Home</a></li>
                <li><a href="../pages/top_restaurants.php">Top Restaurants</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="../pages/search_restaurant.php">Search a restaurant</a></li>
                <li><a href="../pages/add_restaurant.php">Add a new restaurant</a></li>
                <div id="user-info">
                    <?php
                        if (isset($username)) {
                            echo $username;
                        } else { 
                            include_once("../templates/login_dropdown.php");
                        }
                    ?>
                </div>  
            </ul>
        </div>