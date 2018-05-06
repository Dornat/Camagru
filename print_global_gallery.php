<?php
require_once 'config/setup.php';

$globalGallery = getGlobalGallery($pdo);
$globalGalleryArr = array();

if(!empty($globalGallery[0][0])) {
	foreach ($globalGallery as $img) {
		$globalGalleryArr[] = $img[0];
	}
}

echo json_encode($globalGalleryArr);

function getGlobalGallery($pdo) {
	$statement = "SELECT `img_path` FROM `collage_images` ORDER BY `id` DESC";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute();
	$globalGallery = $preparedStatement->fetchAll();
	return $globalGallery;
}

?>
