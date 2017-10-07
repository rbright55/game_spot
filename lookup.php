<?php
//username information
session_start();
require_once "pdo.php";
if (isset($_POST['searchVal']) && $_POST['searchVal'] != ''){
	$username =  htmlspecialchars($_POST['searchVal']);
	$sql= "UPDATE google_users SET `username` ='{$username}' WHERE `google_id` = {$_SESSION['google_id']}";
	$upd_st = $pdo->prepare($sql);
	$upd_st->execute();
}
if(isset($_POST['searchVal'])){
require_once "pdo.php";
$sql= "SELECT * FROM google_users WHERE `google_id` = {$_SESSION['google_id']}";
$stmt_search = $pdo->query($sql);
while ($userinfo= $stmt_search->fetch(PDO::FETCH_ASSOC)){
        $_SESSION['user_id']=$userinfo['user_id'];
	$_SESSION['email']=$userinfo['email'];
	$_SESSION['username']=$userinfo['username'];
}
$output = $_SESSION['username'];
echo $output;
}
if (isset($_POST['sqlOptions'])){
	$theOp = $_POST['sqlOptions'];
	require_once "pdo.php";
	$sql = "SELECT s.* , gu.`username` FROM scores AS s INNER JOIN google_users AS gu ON s.`user_id`=gu.`id` ORDER BY Score DESC LIMIT 100";
	if($_POST['sqlOptions']!= 'All Games' ){
		$sql = "SELECT s.* , gu.`username` FROM scores AS s INNER JOIN google_users AS gu ON s.`user_id`=gu.`user_id` WHERE s.`game`='{$theOp}' ORDER BY Score DESC LIMIT 100";
	} else if($_POST['sqlOptions']== 'All Games' ) {
		$sql = "SELECT s.* , gu.`username` FROM scores AS s INNER JOIN google_users AS gu ON s.`user_id`=gu.`user_id` ORDER BY Score DESC LIMIT 100";
	}
	$output=NULL;
	$count=1;
	$stmt = $pdo->query($sql);
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$output.= '<tr><td style="width:2%;">'.$count.'.</td><td style="width:42%;">'.$row['username'].'</td><td style="width:20%;">'.$row['score'].'</td><td>'.$row['game'].'</td></tr>';
		$count++;
	}
	echo $output;
}