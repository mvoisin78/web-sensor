<?php
session_start();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Accueil</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style2.css">  

	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<script>
	$( function() {
		$( "#search_bar" ).autocomplete({
			source: 'request_autocomplete.php'
		});
	});
	</script>
</head>
<body>
<?php
  require ('include/header.inc.php');
  headWeb("Index","Gestion de l'apprentissage","home","index");
?>

 <div class="page">
<section id="main">

<div class="searchbar">
                               
<div class="row">
  <div class="col-md-4 col-md-offset-4">
        <form action = "#" method = "get">
          <input id="search_bar" class="form-control form-control-md mr-3 w-75" type="text" placeholder="Rechercher un event..." aria-label="Search" name="terme">
          <input class="btn btn-default" type = "submit" name = "s" value = "Rechercher">
        </form>
</div>
</div>

</div>  


<?php
try
{
 $bdd = new PDO("mysql:host=localhost;dbname=websensor", "root", "root");
 $bdd ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
  die("Une érreur a été trouvé : " . $e->getMessage());
}
$bdd->query("SET NAMES UTF8");

if (isset($_GET["s"]) AND $_GET["s"] == "Rechercher")
{
 $_GET["terme"] = htmlspecialchars($_GET["terme"]); //pour sécuriser le formulaire contre les intrusions html
 $terme = $_GET["terme"];
 $terme = trim($terme); //pour supprimer les espaces dans la requête de l'internaute
 $terme = strip_tags($terme); //pour supprimer les balises html dans la requête

 if (isset($terme)){
  $terme = strtolower($terme);
  //$select_terme = $bdd->prepare("SELECT label, tweet FROM event WHERE label LIKE ? OR tweet LIKE ?");
    
    $select_terme = $bdd->prepare("SELECT name, total_popularity FROM event WHERE name LIKE ? OR features_event LIKE ?");

	$select_terme->execute(array("%".$terme."%", "%".$terme."%"));
  
  
	$terme = $select_terme->fetchall();

	$_SESSION['recherche']= $terme;
	$_SESSION['rechercheList']= [];
	
	foreach ($terme as $terme_trouve  ) {
		$_SESSION['rechercheList'][$terme_trouve['name']]=$terme_trouve;
		echo"<div class=\"informations-accueil\">";
		echo "<div ><ul>
			<li> <a href=\"popularite.php?nameevent=".$terme_trouve['name']."\">".$terme_trouve['name']. "</a></li></ul>
			<li> Popularité : ".$terme_trouve['total_popularity']."</li>
			<li> Tweet populaire : </li>
		</ul>
		</div></div>";
  }
  $select_terme->closeCursor();
 }
 else
 {
  $message = "Vous devez entrer votre requete dans la barre de recherche";
 }
}
   ?>
</section>
</div>

<!--Footer-->
<?php
require("include/footer.inc.php");
  foot();
?>
