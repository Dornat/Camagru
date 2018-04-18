<?php

require_once("database.php");

function __autoload($className) {
	require_once("classes/{$className}.class.php");
}

$pdoInit = new PdoInitialiser($DB_HOST, $DB_NAME, $DB_USER, $DB_PASSWORD);
$pdo = $pdoInit->pdoInit();

?>
