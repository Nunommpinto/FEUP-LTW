<?php
include_once('connection.php');

// Database
function getUser($username) {
    global $db;

    $a = $db->prepare('SELECT * FROM users WHERE username = ?');
    $a->execute(array($username));

    return $a->fetch();
}

function getAllUsers() {
    global $db;

    $a = $db->prepare('SELECT username FROM users');
    $a->execute();

    return $a->fetchAll();
}

function isRegistered($username) {
    return getUser($username) !== false;
}

function checkCredentials($username, $password) {
    global $db;

    $a = $db->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
    $a->execute(array($username, sha1($password)));

    return $a->fetch() !== false;
}

// User actions
function registerUser($email, $username, $password, $privileges) {
    global $db;

    if (isRegistered($username)) return false;

    $a = $db->prepare('INSERT INTO users VALUES (?, ?, ?, ?)');
    $a->execute(array($email, $username, sha1($password), $privileges));

    return true;
}

?>