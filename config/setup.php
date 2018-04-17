<?php

require_once("database.php");

try {
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
} catch (PDOException $e) {
	printf("Connection to database wasn't established: %s", $e->getMessage());
}

?>
