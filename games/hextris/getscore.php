<?php
session_start();
$userId = $_SESSION['user_id'];
$locationId = $_SESSION['location'];
$theGame = "Hextris";

function deleteNotTop($deleteID){
	require_once "../../pdo.php";
	global $pdo;
	$sql = "DELETE FROM `scores` WHERE `score_id`=".$deleteID.";";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
}	









if (isset($_POST['userScore']) && $_POST['userScore']>0 && $userId != 0){
	require_once "../../pdo.php";
	$userscore = $_POST['userScore'];
	$sql = "INSERT INTO `scores` (`score_id`, `user_id`, `score`, `date`, `location`, `game`) VALUES (NULL, '{$userId}', '{$userscore}', CURRENT_TIMESTAMP, '', '{$theGame}')";
	$score_stmt = $pdo->prepare($sql);
	$score_stmt->execute();
	
	require_once "../../pdo.php";
	$fresh_sql = "SELECT `score_id` FROM `scores` WHERE `user_id` = '{$userId}' AND `game` LIKE '{$theGame}' ORDER BY `score` DESC LIMIT 10,100;";
	$fresh_stmt = $pdo->query($fresh_sql);
	while ($deletes = $fresh_stmt->fetch(PDO::FETCH_ASSOC)){
		$dID = $deletes['score_id'];
		deleteNotTop($dID);
	}

}