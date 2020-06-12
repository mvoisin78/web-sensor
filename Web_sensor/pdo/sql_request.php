<?php
header("content-type:application/json; charset=utf-8");

if ($_GET['action'] != NULL){
	$action = $_GET['action'];
}
if($action == "getDataPie"){

	try {
		$pdo = new PDO('mysql:host=localhost;dbname=websensor', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$statement = $pdo->prepare("SELECT * FROM event");
		$statement->execute();
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);
		echo(json_encode($results));
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
}
elseif($action == "getDataLine"){
	$date_from = "2020-05-27";
	$date_to = "2020-06-03";
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=websensor', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		//"SELECT * FROM popularity INNER join event ON popularity.event_id = event.event_id INNER join tweet ON tweet.tweet_id=popularity.tweet_id WHERE popularity_date between " + $date_from + " and " + $date_to
		$statement = $pdo->prepare("SELECT * FROM popularity,event,tweet WHERE popularity.event_id = event.event_id AND tweet.tweet_id=popularity.tweet_id AND popularity.popularity_date between \"" . $date_from . "\" AND \"" . $date_to ."\"");
		$statement->execute();
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);
		echo(json_encode($results));
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
}
?>

	