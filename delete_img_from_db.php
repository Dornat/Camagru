<?php
require_once 'config/setup.php';
session_start();

deleteImgFromDb($pdo);

function deleteImgFromDb($pdo) {
	$statement = "DELETE FROM `collage_images` WHERE `img_path`=?";
	$preparedStatement = $pdo->prepare($statement);
	$foo = $preparedStatement->execute([$_POST['img_src']]);
}

?>
