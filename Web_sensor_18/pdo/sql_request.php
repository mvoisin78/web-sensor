<?php
header("content-type:application/json; charset=utf-8");

if ($_GET['action'] != NULL){
	$action = $_GET['action'];
}
$date_from = "11-02-2020";
if(isset($_GET['date_from'])) {
	if($_GET['date_from'] != NULL){
		$date_from = $_GET['date_from'];
	}
}
$date_from = date("Y-m-d", strtotime($date_from));

$date_to = "31-05-2020";
if(isset($_GET['date_to'])){
	if($_GET['date_to'] != NULL){
		$date_to = $_GET['date_to'];
	}
}
$date_to = date("Y-m-d", strtotime($date_to));

$event_id = "";
if(isset($_GET['event_id'])){
	if($_GET['event_id'] != NULL){
		$event_id = $_GET['event_id'];
	}
}

$actual_date = "25-02-2020";
if(isset($_GET['actual_date'])){
	if($_GET['actual_date'] != NULL){
		$actual_date = $_GET['actual_date'];
	}
}
$actual_date = date("Y-m-d", strtotime($actual_date));

if($action == "getDataPie"){
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=websensor17', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$statement = $pdo->prepare("SELECT * FROM event,popularity WHERE event.name != '' AND popularity.popularity_date = \"".$actual_date."\" AND event.event_id = popularity.event_id ORDER BY popularity.number desc LIMIT 10");
		$statement->execute();
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);
		echo(json_encode($results));
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
}
elseif($action == "getDataLine"){
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=websensor17', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		if($event_id != null && $event_id != ""){
			$statement = $pdo->prepare("SELECT * FROM popularity,event,tweet WHERE popularity.event_id = event.event_id AND event.event_id=\"".$event_id."\" AND tweet.tweet_id=popularity.tweet_id AND popularity.popularity_date between \"" . $date_from . "\" AND \"" . $date_to ."\" AND event.name != '' ORDER BY popularity.popularity_date asc, event.total_popularity desc" );
		}
		else{
			$statement = $pdo->prepare("SELECT * FROM popularity,event,tweet WHERE popularity.event_id = event.event_id AND tweet.tweet_id=popularity.tweet_id AND popularity.popularity_date between \"" . $date_from . "\" AND \"" . $date_to ."\" AND event.name != '' ORDER BY popularity.popularity_date asc, event.total_popularity desc" );
		}
		$statement->execute();
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);
		echo(json_encode($results));
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
}
?>

	