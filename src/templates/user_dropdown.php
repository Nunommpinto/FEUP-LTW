<?php
    include_once('../database/connection.php');
    include_once('../database/db_user.php');
    
    $isOwner = getIsOwnerById(intval($_SESSION['idUser'][0]));
    $isOwner = intval($isOwner[0]);?>

<div class="user-dropdown">
    <a id="user-dropdown-username" href="#"><?php echo $_SESSION['username']; ?></a>
    <div id="user-dropdown-content" class="user-dropdown-content">
        <a id="user-dropdown-a-profile" href="#">Profile</a>
        <?php if($isOwner != 0) { ?>
            <a href="../pages/owner_restaurants.php">My Restaurants</a>
        <?php } ?>
        <a href="#">Something Else</a>
        <div class="separator"> </div>
        <a href="#">Settings</a>
        <a href="../database/action_logout.php">Logout</a>
    </div>
</div>