<?php
if ($_GET['action'] != NULL){
	$action = $_GET['action'];
}

header("content-type:application/json");
try {
    $pdo = new PDO('mysql:host=localhost;dbname=websensor', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$statement = $pdo->prepare("SELECT * FROM event");
	$statement->execute();
	$results = $statement->fetchAll(PDO::FETCH_ASSOC);
	echo(json_encode($results));
	/*
	$json = array();
	for($i=0; $i<count($results);$i++){
		array_push($json,$results[$i]);
    }
	echo(json_encode($json));
	*/
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>

	