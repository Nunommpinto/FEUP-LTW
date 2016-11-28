<?php
include_once('connection.php');

// Database
function getUser($username) {
    global $db;

    $stmt = $db->prepare('SELECT * FROM Owner, Reviewer WHERE username = ?');
    $stmt->execute(array($username));
    return $stmt->fetch();
	
}

function getAllUsers() {
    global $db;

    $stmt = $db->prepare('SELECT username FROM Owner, Reviewer');
    $stmt->execute();

    return $stmt->fetchAll();
}

function isRegistered($username) {
    return getUser($username) !== false;
}

function checkCredentials($username, $password) {
    global $db;

    $stmt = $db->prepare('SELECT * FROM Owner,Reviewer WHERE username = :username AND password = :password');
	$stmt->bindParam(':username', $username);
	$stmt->bindParam(':password', $password);
	$stmt->execute();

    return $stmt->fetch() !== false;
}

// User actions
function registerUser($email, $username, $password, $privileges) {
    global $db;
	
	if($privileges == "owner") {
		$stmt = $db->prepare('INSERT INTO Owner VALUES (null, :email, :username, :password, null, null)');
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->execute();
		return true;
	}
	
	elseif($privileges == "reviewer") {
		$stmt = $db->prepare('INSERT INTO Reviewer VALUES (null, :email, :username, :password, null, null)');
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->execute();
		return true;
	}

    else
		return false;
}

?>