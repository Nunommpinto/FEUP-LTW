<?php
	include_once('connection.php');

	// Database
	function getUser($username) {
		global $db;
		$stmt = $db->prepare('SELECT * FROM User WHERE username=:username');
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		return $stmt->fetch();
	}

	function getAllUsers() {
		global $db;

		$stmt = $db->prepare('SELECT username FROM User');
		$stmt->execute();

		return $stmt->fetchAll();
	}

	function isRegistered($username) {
		return getUser($username) !== false;
	}

	function checkCredentials($username, $password) {
		global $db;
		$shaPassword = sha1($password);
		
		$stmt = $db->prepare('SELECT * FROM User WHERE username=:username AND password=:password');
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $shaPassword);
		$stmt->execute();

		return $stmt->fetch() !== false;
	}

	//Returns the user id given his username
	function getUserId($username) {
		global $db;

		$stmt = $db->prepare('SELECT idUser FROM User WHERE username = :username');
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		return $stmt->fetch();
	}

	//Returns the owner property given his user id
	function getIsOwnerById($idUser) {
		global $db;

		$stmt = $db->prepare('SELECT owner FROM User WHERE idUser = :idUser');
		$stmt->bindParam(':idUser', $idUser);
		$stmt->execute();
		return $stmt->fetch();
	}

	// User actions
	function registerUser($email, $username, $password, $owner) {
		global $db;
		
		if (isRegistered($username)) 
			return false;
		$shaPassword = sha1($password);
		
		$stmt = $db->prepare('INSERT INTO User (email, username, password, owner) VALUES (:email, :username, :password, :owner)');
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $shaPassword);
		$stmt->bindParam(':owner', $owner);
		$stmt->execute();
		return true;
	}

?>