<?php

class PdoInitialiser {
	private $dbHost;
	private $dbName;
	private $user;
	private $password;
	private $dsn;

	public function __construct($dbHost, $dbName, $user, $password) {
		$this->dbHost = $dbHost;
		$this->dbName = $dbName;
		$this->user = $user;
		$this->password = $password;
		$this->assambleDsn();
	}

	private function assambleDsn() {
		$this->dsn = "mysql:host=" . $this->dbHost . ";";
	}

	public function pdoInit() {
		try {
			$pdo = new PDO($this->dsn, $this->user, $this->password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->createDbIfNotExists($pdo);
			$this->useDb($pdo);
			$this->createUserTableIfNotExists($pdo);
			$this->createCollageImagesTableIfNotExists($pdo);
			$this->createLikesTableIfNotExists($pdo);
			$this->createCommentsTableIfNotExists($pdo);
			return $pdo;
		} catch (PDOException $e) {
			printf("Connection to database wasn't established: %s", $e->getMessage());
		}
	}

	private function createDbIfNotExists($pdo) {
		$queryStatement = "CREATE DATABASE IF NOT EXISTS `" . $this->dbName . "`";
		$pdo->query($queryStatement);
	}

	private function useDb($pdo) {
		$queryStatement = "USE `" . $this->dbName . "`";
		$pdo->query($queryStatement);
	}

	private function createUserTableIfNotExists($pdo) {
		$queryStatement = "CREATE TABLE IF NOT EXISTS `users` (
			`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			`login` varchar(32) NOT NULL UNIQUE,
			`email` varchar(255) NOT NULL UNIQUE,
			`password` varchar(255) NOT NULL,
			`is_verified` ENUM(\"false\", \"true\") DEFAULT \"false\" NOT NULL,
			`email_on_img_comment` ENUM(\"false\", \"true\") DEFAULT \"true\" NOT NULL,
			`verif_code` varchar(255) NOT NULL)";
		$pdo->query($queryStatement);
	}

	private function createCollageImagesTableIfNotExists($pdo) {
		$queryStatement = "CREATE TABLE IF NOT EXISTS `collage_images` (
			`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			`user_id` INT NOT NULL,
			`img_path` varchar(255) NOT NULL
		)";
		$pdo->query($queryStatement);
	}

	private function createLikesTableIfNotExists($pdo) {
		$queryStatement = "CREATE TABLE IF NOT EXISTS `likes` (
			`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			`user_id` INT NOT NULL,
			`img_id` INT NOT NULL
		)";
		$pdo->query($queryStatement);
	}

	private function createCommentsTableIfNotExists($pdo) {
		$queryStatement = "CREATE TABLE IF NOT EXISTS `comments` (
			`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			`user_id` INT NOT NULL,
			`img_id` INT NOT NULL,
			`comment` text NOT NULL,
			`datetime` datetime DEFAULT CURRENT_TIMESTAMP
		)";
		$pdo->query($queryStatement);
	}

	public function getCommentsForImage($pdo, $imageId) {
		$statement = "SELECT * FROM `comments` WHERE `img_id`=? ORDER BY `datetime` DESC";
		$preparedStatement = $pdo->prepare($statement);
		$preparedStatement->execute([$imageId]);
		$commentsArray = $preparedStatement->fetchAll();
		return $commentsArray;
	}

	public function getLoginById($pdo, $loginId) {
		$statement = "SELECT `login` FROM `users` WHERE `id`=?";
		$preparedStatement = $pdo->prepare($statement);
		$preparedStatement->execute([$loginId]);
		$login = $preparedStatement->fetchAll();
		if (!isset($login[0]['login'])) {
			return 'Undefined_Blob';
		}
		return $login[0]['login'];
	}

	public function getUserIdFromDbByLogin($pdo, $login) {
		$statement = "SELECT `id` FROM `users` WHERE `login`=?;";
		$preparedStatement = $pdo->prepare($statement);
		$preparedStatement->execute([$login]);
		$id = $preparedStatement->fetchAll();
		return $id[0][0];
	}

	public function getImagePathByImageId($pdo, $imageId) {
		$statement = "SELECT `img_path` FROM `collage_images` WHERE `id`=?;";
		$preparedStatement = $pdo->prepare($statement);
		$preparedStatement->execute([$imageId]);
		$imagePath = $preparedStatement->fetchAll();
		return $imagePath[0][0];
	}

	public function isUserLikedImage($pdo, $imageId, $userId) {
		$statement = "SELECT * FROM `likes` WHERE `img_id`=? AND `user_id`=?";
		$preparedStatement = $pdo->prepare($statement);
		$preparedStatement->execute([$imageId, $userId]);
		$imagePath = $preparedStatement->fetchAll();
		if (isset($imagePath[0][0])) {
			return true;
		} else {
			return false;
		}
	}

	public function countLikesForImage($pdo, $imageId) {
		$statement = "SELECT COUNT(`img_id`) FROM `likes` WHERE `img_id`=?";
		$preparedStatement = $pdo->prepare($statement);
		$preparedStatement->execute([$imageId]);
		$likesCount = $preparedStatement->fetchAll();
		return $likesCount[0][0];
	}

	public function addCommentToDb($pdo, $img_id, $user_id, $comment) {
		$statement = "INSERT INTO `comments` (`img_id`, `user_id`, `comment`)
			VALUES (?, ?, ?);";
		$preparedStatement = $pdo->prepare($statement);
		$preparedStatement->execute([$img_id, $user_id, htmlspecialchars($comment)]);
	}

	public function getUserLoginByImageId($pdo, $imageId) {
		$statement = "SELECT `login` FROM `users` INNER JOIN `collage_images`
			ON `users`.`id` = `collage_images`.`user_id` WHERE `collage_images`.`id`=?";
		$preparedStatement = $pdo->prepare($statement);
		$preparedStatement->execute([$imageId]);
		$login = $preparedStatement->fetchAll();
		if (!isset($login[0][0])) {
			return 'Undefined_Blob';
		}
		return $login[0][0];
	}

	public function getEmailNotificationStatusByLogin($pdo, $login) {
		$statement = "SELECT `email_on_img_comment` FROM `users` WHERE `login`=?";
		$preparedStatement = $pdo->prepare($statement);
		$preparedStatement->execute([$login]);
		$status = $preparedStatement->fetchAll();
		return $status[0][0];
	}
}

?>
