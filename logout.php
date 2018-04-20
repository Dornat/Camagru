<?php
session_start();
$_SESSION['userName'] = "";
header("Location: index.php");
?>
