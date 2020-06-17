<?php
function requeteSQL($dateDay){
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=websensor', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$statement = $pdo->prepare("SELECT * FROM popularity INNER join event ON popularity.event_id = event.event_id INNER join tweet ON tweet.tweet_id=popularity.tweet_id");
		$statement->execute();
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);
		return results;
		
	
		
		//pour un attribut spécifique de la première ligne :
		echo($results[0]['name']);
		//pour chaque ligne on affiche le même attribut name :
		foreach($results as $result){
			echo('\t' + $result['name']); //ici tu peux include tes balise li pour faire une nouvelle ligne pour chaque result recupéré de la base
		} 
		//////////////////////////////////
		
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
}
?>
