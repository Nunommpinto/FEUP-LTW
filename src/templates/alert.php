<?php
    /* 
     * Tag to include this file:
        <?php include_once('../templates/alert.php'); ?> 
     * 
     * addWarn($message, [$title = ""]);
     * addError($message, [$title = ""]);
     * addInfo($message, [$title = ""]);
     * addSuccess($message, [$title = ""]);
     */

     if (session_status() == PHP_SESSION_NONE) 
        session_start();

    /*
        global $alertMessage, $alertTitle;
    */
    $alertMessage = "alert message";
    $alertTitle = "alert title";
    $alertType = "alert type";
    
    function addWarn($message, $title = "") {
         global $alertType, $alertMessage, $alertTitle;
         $_SESSION[$alertType] = "warn";
         $_SESSION[$alertMessage] = $message;
         $_SESSION[$alertTitle] = $title;
    }

    function addError($message, $title = "") {
         global $alertType, $alertMessage, $alertTitle;
         $_SESSION[$alertType] = "danger";
         $_SESSION[$alertMessage] = $message;
         $_SESSION[$alertTitle] = $title;
    }

    function addInfo($message, $title = "") {
         global $alertType, $alertMessage, $alertTitle;
         $_SESSION[$alertType] = "info";
         $_SESSION[$alertMessage] = $message;
         $_SESSION[$alertTitle] = $title;
    }

    function addSuccess($message, $title = "") {
         global $alertType, $alertMessage, $alertTitle;
         $_SESSION[$alertType] = "success";
         $_SESSION[$alertMessage] = $message;
         $_SESSION[$alertTitle] = $title;
    }

     function getAlert() {
         global $alertType, $alertMessage, $alertTitle;
         if(isset($_SESSION[$alertType]) && $_SESSION[$alertType] != "") {
            if ($_SESSION[$alertType] == "warn")
                $alert = '<div class="alert warning">';
            else if ($_SESSION[$alertType] == "danger")
                $alert = '<div class="alert">';
            else if ($_SESSION[$alertType] == "info")
                $alert = '<div class="alert info">';
            else if ($_SESSION[$alertType] == "success")
                $alert = '<div class="alert success">';
            
             
             $alert = $alert . '<span class="alert-closebtn">&times;</span>' .
                        '<strong>'. $_SESSION[$alertTitle] . '</strong> ' . 
                        $_SESSION[$alertMessage] . '</div>';
             
             $_SESSION[$alertType] = '';
             $_SESSION[$alertTitle] = '';
             $_SESSION[$alertMessage] = '';
            return $alert;
        }
        return '';
     }
?>