<?php
    include_once('connection.php');
    include_once('db_user.php');
    include_once('../templates/constants.php');

    if (session_status() == PHP_SESSION_NONE) 
        session_start();

    if (isset($_POST['owner'])) $owner = intval($_POST['owner']);
    else $owner = 0;

    global $PASSWORD_MIN_CHAR;
    global $PASSWORD_MAX_CHAR;

    if (!isset($_POST['email']) || strlen($_POST['email']) == 0)
        echo "Email field required!";
    else if (!isset($_POST['username']) || strlen($_POST['username']) == 0)
        echo "Username field required!";
    else if (!isset($_POST['password']) || strlen($_POST['password']) == 0)
        echo "Password field required!";
    else if (!isset($_POST['confirm']) || strlen($_POST['confirm']) == 0)
        echo "Confirm Password field required!";
    else if ($_POST['password'] !== $_POST['confirm'])
        echo "The passwords don't match";
    else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        echo "Email not valid!";
    else if (!preg_match('/^[A-Za-z]{1}[A-Za-z0-9_]{3,15}$/', $_POST['username']))
        echo "Username must:<br>
            Start with a letter/number<br>
            Have 4-16 characters<br>
            Have letters, numbers and _ only";
    else if (!preg_match("/^[A-Za-z0-9_\-.,@!#]{" . $PASSWORD_MIN_CHAR . "," . $PASSWORD_MAX_CHAR . "}$/", $_POST['password']))
        echo "Passwords must:<br>
            Start with a letter/number<br>
            Have $PASSWORD_MIN_CHAR-$PASSWORD_MAX_CHAR characters<br>
            Have etters, numbers _ - . , @ ! # only";
    else if (usernameExists($_POST['username']))
        echo "Username already exists, please try another username";
    else if (emailExists($_POST['email']))
        echo "Email already registered, please use another email";
    else {
        if (registerUser($_POST['email'], $_POST['username'], $_POST['password'], $owner)) {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['idUser'] = getUserIdFromUser($_POST['username']);
            echo "Register successful.";
        }
        else
            echo "An error occured while creating your account, please try again later.";
    } 


    //pattern="[0-9a-zA-Z]{6,}" 
    /*
    if (!registerUser($_POST['email'], $_POST['username'], $_POST['password'], $owner)) {
        if (usernameExists($_POST['username']))
            addWarn("Please try again with a different username.", 'Username already exists!');
        else if (emailExists($_POST['email']))
            addWarn("Please try again with a different email address.", 'Email already exists!');
        else 
            addWarn("Please try again later.", 'An error occurred!');
    } else
        addSuccess("Login with your new account.", 'Registration successful!');
    */
?>