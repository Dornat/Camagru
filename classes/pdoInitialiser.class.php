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
							`password` varchar(255) NOT NULL)";
		$pdo->query($queryStatement);
	}
}

?>
