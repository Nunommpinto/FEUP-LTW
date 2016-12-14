<?php
    if (session_status() == PHP_SESSION_NONE) 
       session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: ../index.php');
        exit();
    }
        
    include_once('../database/connection.php');
    include_once('../database/db_user.php');
    include_once('../database/db_user_info.php');
    include_once('../templates/header.php');
?>

<h1>Profile</h1>

<h2>Account Info</h2>
<div class="container">
    <label>Username:</label>
    <label><?php echo $_SESSION['username']; ?></label>
</div>
<div class="container">
    <label>Type:</label>
    <label><?php echo (isOwner($_SESSION['username']) ? "Owner" : "Reviewer"); ?></label>
</div>

<form action="../database/action_update_profile.php" method="post">
    <input type="hidden" name="updating" value="email">
    <div class="container">
        <label>Email:</label>
        <input type="text" name="email" value="<?php echo getEmail($_SESSION['username']); ?>">
        <input type="submit" value="Update Email">
    </div>
</form>

<form action="../database/action_update_profile.php" method="post">
    <input type="hidden" name="updating" value="pw">
    <div class="container">
        <label>Change Password:</label>
        <input type="password" name="password">
        <input type="password" name="confirm">
        <input type="submit" value="Update Password">
    </div>
</form>

<br>
<h2>User Biography</h2>
<form id="formBio" action="../database/action_update_profile.php" method="post">
    <input type="hidden" name="updating" value="bio">
    <div class="container">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo getUserinfoName($_SESSION['username']); ?>">
    </div>
    <div class="container">
        <label>Biography:</label>
        <textarea rows="4" cols="50" name="biography" form="formBio"><?php echo getUserinfoBio($_SESSION['username']); ?></textarea>
        <input type="submit" value="Update biography"/>        
    </div>
</form>
