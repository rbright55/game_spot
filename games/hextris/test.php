<?php

session_start();
$userId = $_SESSION['user_id'];
$locationId = $_SESSION['location'];
$theGame = "Hextris";

?>
asdflkj
<?php
function deleteNotTop($deleteID){
	require_once "../../pdo.php";
	global $pdo;
	$sql = "DELETE FROM `scores` WHERE `score_id`=".$deleteID.";";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
}	

function getNotTop(){
	require_once "../../pdo.php";
	global $pdo;	
	$sql = "SELECT * FROM `scores` WHERE `user_id` = ".$userId." AND `game` LIKE '".$theGame."' ORDER BY `score` DESC LIMIT 10,100;";
	$stmt = $pdo->query($sql);
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$id = $row['score_id'];
		deleteNotTop($id);
		
}
}
getNotTop();
?>