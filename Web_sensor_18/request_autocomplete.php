<?php
/*$availableTags = array(
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme");
echo json_encode($availableTags);
*/
if(isset($_POST['term'])){
	if($_POST['term'] != NULL){
		$terme = $_POST['term'];
		$wordList = array();
		try {
			$pdo = new PDO('mysql:host=localhost;dbname=websensor17', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$statement = $pdo->prepare("SELECT name FROM event WHERE (name LIKE ? OR features_event LIKE ?) and name != '' ORDER BY LOCATE(?, name)");
			$statement->execute(array("%".$terme."%", "%".$terme."%", "%".$terme."%"));
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			foreach($results as $result){
				array_push($wordList, $result['name']);
			}
			echo(json_encode($wordList));
			
		} catch (PDOException $e) {
			die();
		}
	}
}

?>