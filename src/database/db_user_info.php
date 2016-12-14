<?php
	include_once('connection.php');
    include_once('db_user.php');

    function getUserinfo($username) {
        global $db;
        $user = getUser($username);
        $stmt = $db->prepare('SELECT * FROM UserINfo WHERE idUser=:idUser');
		$stmt->bindParam(':idUser', $user['idUser']);
		$stmt->execute();
		return $stmt->fetch();
    }

    function getUserinfoName($username) {
        return getUserinfo($username)['name'];
    }

    function getUserinfoBio($username) {
        return getUserinfo($username)['biography'];
    }

    function updateUserinfoBio($username, $name, $bio) {
        global $db;
        $user = getUser($username);
        var_dump($user);
		$stmt = $db->prepare('UPDATE UserInfo SET name=:name, biography=:bio WHERE idUser=:idUser');
		$stmt->bindParam(':idUser', $user['idUser']);
		$stmt->bindParam(':name', $name);
        $stmt->bindParam(':bio', $bio);
		$stmt->execute();
    }
?>