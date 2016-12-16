<?php
    include_once('../database/connection.php');
    include_once('../database/db_user.php');
    include_once('../database/db_user_info.php');
    include_once('../templates/constants.php');
    
    $isOwner = getIsOwnerById(intval($_SESSION['idUser'][0]));
    $isOwner = intval($isOwner[0]);
    global $AVATAR_DIR;    
?>
     
<div class="user-dropdown">
    <a id="user-dropdown-username" href="#">
        <img id="header-img-avatar" src="../<?php echo $AVATAR_DIR . getAvatar($_SESSION['username']); ?>" alt="Avatar" class="header avatar">
        <span id="header-span-username"><?php echo $_SESSION['username']; ?></span></a>
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