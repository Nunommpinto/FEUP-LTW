<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    include_once('connection.php');
    include_once('db_user.php');
    include_once('db_user_info.php');
    include_once('../templates/constants.php');

    global $PASSWORD_MIN_CHAR;
    global $PASSWORD_MAX_CHAR;

    if (!isset($_SESSION['username']) || !(isset($_POST['updating']) || isset($_FILES)))
        header('Location: ../pages/index.php');
    else if (isset($_POST['updating'])) {
        // Update email
        if ($_POST['updating'] == "email" && isset($_POST['data'])) {
            if (!filter_var($_POST['data'], FILTER_VALIDATE_EMAIL))
                echo "Email not valid!";
            else {
            updateEmail($_SESSION['username'], $_POST['data']);
            echo 'Email updated successfully!';
            }
        // Update password
        } else if ($_POST['updating'] == "pw" && isset($_POST['data']) && isset($_POST['confirm'])) {
            if ($_POST['data'] != $_POST['confirm'])
                echo "Passwords don't match!";
            else if (!preg_match("/^[A-Za-z0-9_\-.,@!#]{" . $PASSWORD_MIN_CHAR . "," . $PASSWORD_MAX_CHAR . "}$/", $_POST['data']))
                echo "Passwords must:<br>
                    Start with a letter/number<br>
                    Have $PASSWORD_MIN_CHAR-$PASSWORD_MAX_CHAR characters<br>
                    Have etters, numbers _ - . , @ ! # only";
            else if (checkCredentials($_SESSION['username'], $_POST['data']))
                echo "Password cannot be the same as previous!";
            else {
                updatePassword($_SESSION['username'], $_POST['data']);
                echo 'Password updated successfully!';
            }
        // Update name
        } else if ($_POST['updating'] == "name") {
            if (!preg_match("/^[A-Za-z ]{0,50}$/", $_POST['data'])) 
                echo "Name can only contain letters and must not be longer than 50 characters";
            else {
                updateUserinfoName($_SESSION['username'], $_POST['data']);
                echo 'Name updated successfully!';
            }
        // Update biography
        } else if ($_POST['updating'] == "bio") {
            if (!preg_match("/^[A-Za-z0-9_\-.,@!#() ]{0,500}$/", $_POST['data'])) 
                echo "Biography must:<br>
                    Start with a letter/number<br>
                    Have a maximum of 500 characters<br>
                    Have only letters, numbers _ - . , @ ! and #";
            else {
                updateUserinfoBio($_SESSION['username'], $_POST['data']);
                echo 'Name updated successfully!';
            }
        // Removes avatar to default one
        } else if ($_POST['updating'] == "removeAvatar") {
            global $AVATAR_DIR;
            $path = '../' . $AVATAR_DIR;
            $file = $path . getAvatar($_SESSION['username']);
            if (unlink ($file)) {
                removeAvatar($_SESSION['username']);
                echo 'file=' . $path . 'man.png';
            }
            else
                echo 'Error while removing avatar';
        } else 
            sendErrorWarn();
    // Update picture
    } else if (isset($_FILES)) {
        if (count($_FILES) > 0) {
            $file = $_FILES['file'];
            $validExtensions = array('jpg', 'png', 'jpeg');
            $ext = explode('/', $file['type'])[1];
            if(in_array($ext, $validExtensions)) {
                global $AVATAR_DIR;
                $path = '../' . $AVATAR_DIR;
                $name = getIdUser($_SESSION['username']) . '.' . $ext;
                if(move_uploaded_file($file['tmp_name'], $path . $name)) {
                    registerAvatar($_SESSION['username'], $name);
                    echo 'file=' . $path . $name;
                }
                else 
                    echo 'Could not move uploaded file!';
            } else {
                echo "Wrong file format: only .jpg, .jpeg and .png are accepted.";
            }
        } else {
            echo "No file was received.";
        }
    } else 
        sendErrorWarn();
    function sendErrorWarn() {
        echo 'An error occurred while updating profile!';
    }
?>