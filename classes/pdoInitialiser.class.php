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
			$this->createDbIfNotExists($pdo);
			$this->useDb($pdo);
			$this->createUserTableIfNotExists($pdo);
			$this->createCollageImagesTableIfNotExists($pdo);
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
			`login` varchar(32) NOT NULL,
			`email` varchar(255) NOT NULL,
			`password` varchar(255) NOT NULL,
			`is_verified` ENUM(\"false\", \"true\") DEFAULT \"false\" NOT NULL,
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
}

?>
