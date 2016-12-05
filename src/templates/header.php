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
		<link rel="stylesheet" href="./header.css">
    </head>

    <body>
        <div id="header">
            <h1>FEUPrant</h1>
            <h2>The definitive restaurant reviews website!</h2>
        </div>
        <div id="nav-btns">
            <ul>
                <li><a href="homepage.php">Homepage</a></li>
                <li><a href="#">Top Restaurants</a></li>
                <li><a href="#">Write a Review</a></li>
                <li><a href="myprofile.php">Profile</a></li>
                <li><a href="search_restaurant.php">Search a restaurant</a></li>
                <li><a href="add_restaurant.php">Add a new restaurant</a></li>
                <div id="user-info"><a href="#"><?php echo(isset($username) ? $username : 'Login/Register') ?></a></div>  
            </ul>
        </div>
        <div id="user-info-content"><?php include_once('login_box.php'); ?></div>
        <script type="text/javascript" src="templates/header.js"></script>