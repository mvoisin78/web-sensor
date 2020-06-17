<?php
$availableTags = array(
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
/*
try {
    $pdo = new PDO('mysql:host=localhost;dbname=websensor', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$statement = $pdo->prepare("SELECT name,features_event FROM event WHERE name LIKE ? OR features_event LIKE ?");
	$statement->execute(array("%".$terme."%", "%".$terme."%"));
	$results = $statement->fetchAll(PDO::FETCH_ASSOC);
	echo(json_encode($results));
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
*/
?>