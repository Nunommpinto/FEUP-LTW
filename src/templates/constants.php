<?php
    /* 
     * Tag to include this file:
     * <?php include_once('../templates/constants.php'); ?> 
     */

    /* 
     * Login cookie status messages 
     * if(isset($_SESSION[$LOGIN_KEY]))
     */
    $LOGIN_KEY = 'loginStatus';
    $LOGIN_SUCCESSFUL = 'login successful';
    $LOGIN_WRONG_USER = 'login wrong user';

    $PASSWORD_MIN_CHAR = 5;
    $PASSWORD_MAX_CHAR = 32;
    $PASSWORD_HASH_COST = 12;

    $AVATAR_DIR = 'images/avatar/';
    $ACCEPTABLE_PRICE_RANGE = 7;
?>