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
	
	function usernameExists($username) {
		return getUser($username) !== false;
	}

	function emailExists($email) {
		global $db;
		$stmt = $db->prepare('SELECT * FROM User WHERE email=:email');
		$stmt->bindParam(':email', $email);
		$user = $stmt->execute();
		return $stmt->fetch() !== false;
	}

	function isRegistered($username, $email) {
		return usernameExists($username) || emailExists($email);
	}

	function getAllUsers() {
		global $db;

		$stmt = $db->prepare('SELECT username FROM User');
		$stmt->execute();

		return $stmt->fetchAll();
	}

	function checkCredentials($username, $password) {
		global $db;
		
		$stmt = $db->prepare('SELECT password FROM User WHERE username=:username');
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		$user = $stmt->fetch();
		return ($user !== false && password_verify($password, $user['password']));
	}

	//Returns the user id given his username
	function getUserIdFromUser($username) {
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
		
		if (isRegistered($username, $email)) 
			return false;
		
		$options = ['cost' => 12];
    	$hash = password_hash($password, PASSWORD_DEFAULT, $options);
		
		$stmt = $db->prepare('INSERT INTO User (email, username, password, owner) VALUES (:email, :username, :password, :owner)');
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $hash);
		$stmt->bindParam(':owner', $owner);
		$stmt->execute();
		return true;
	}

?>