<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();
    
    include_once('connection.php');
    include_once('db_user.php');
    include_once('db_user_info.php');
    include_once('../templates/constants.php');

    if (!isset($_POST['username']) || strlen($_POST['username']) == 0)
        echo "Error: Couldn't get profile!";
    else if (!usernameExists($_POST['username'])) 
        echo "Username not found!";
    else {
        global $AVATAR_DIR;
        $res = array('username' => $_POST['username'],
                     'owner' => isOwner($_POST['username']) ? "Owner" : "Reviewer",
                     'email' => getEmail($_POST['username']),
                     'name'  => getUserinfoName($_POST['username']),
                     'bio'   => getUserinfoBio($_POST['username']),
                     'avatar'=> '../' . $AVATAR_DIR . getAvatar($_POST['username']));
        echo json_encode($res);
    }  
?>