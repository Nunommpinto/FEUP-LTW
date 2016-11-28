<?php
include_once("templates/header.php");
?>

<title>My Profile</title>

<aside id="panel">
	<br>
        <form action="login.php" method="get">
            <input type="submit" value="Login" class="button" onclick="setRedirect();">
        </form>
        <form action="registration.php" method="get">
            <input type="submit" value="Register" class="button" onclick="setRedirect();">
        </form>
</aside>
