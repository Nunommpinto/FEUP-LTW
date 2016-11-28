<?php
include_once("templates/header.php");
?>

<h1>Login</h1>
<h3>Please enter you credentials.</h3>

<form action="action_login.php" method="post">
    <br>
	Username: <input type="text" name="username" placeholder="username">
    <br>
	<br>
    Password: <input type="password" name="password" placeholder="password">
    <br>
	<br>
    <input type="submit" name="login_btn" value="Login">
    <input type="submit" name="cancel_btn" value="Cancel">
</form>