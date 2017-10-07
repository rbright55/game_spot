<?php
session_start();
$userId = $_SESSION['user_id'];
$score = $_GET['score'];
$gamename2 = '2048';

function deleteNotTop($deleteID){
	require_once "../../pdo.php";
	global $pdo;
	$sql = "DELETE FROM `scores` WHERE `score_id`=".$deleteID.";";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
}	



if($userId!=0){
    //DB connection data.
    //Probably leave $host alone.
    $host = 'localhost';
    //Set $db to the name of your database.
    $db = 'faalbane_mis426project';
    //Set user_name to the name of the MySQL user you made.
    $user_name = 'faalbane_lauren';
    //Set $password to the user's password.
    $password = 'mis426';

    //Connect to the MySQL server.
    $db = new mysqli($host, $user_name, $password, $db);
    //Did it work?

    $query = "insert into scores (user_id, score, game ) values ('$userId', '$score', '$gamename2')";
    
    $db->query($query);
    
    
    
    
    	require_once "../../pdo.php";
	$fresh_sql = "SELECT `score_id` FROM `scores` WHERE `user_id` = '{$userId}' AND `game` LIKE '{$gamename2}' ORDER BY `score` DESC LIMIT 10,100;";
	$fresh_stmt = $pdo->query($fresh_sql);
	while ($deletes = $fresh_stmt->fetch(PDO::FETCH_ASSOC)){
		$dID = $deletes['score_id'];
		deleteNotTop($dID);
	}
}