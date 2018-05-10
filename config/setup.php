<?php

require_once(__DIR__ . "/database.php");

require_once(__DIR__ . "/../classes/pdoInitialiser.class.php");

$pdoInit = new PdoInitialiser($DB_HOST, $DB_NAME, $DB_USER, $DB_PASSWORD);
$pdo = $pdoInit->pdoInit();


?>
