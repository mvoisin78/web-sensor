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

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>    
</head>
<body>

<?php
  require ('include/header.inc.php');
  headWeb("Index","Gestion de l'apprentissage","home","index");
  ?>
  <div class="page">
<section id="main">

<?php
try
{
 $bdd = new PDO("mysql:host=localhost;dbname=WebSensor", "root", "root");
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

 if (isset($terme))
 {
  $terme = strtolower($terme);
  //$select_terme = $bdd->prepare("SELECT label, tweet FROM event WHERE label LIKE ? OR tweet LIKE ?");
    
    $select_terme = $bdd->prepare("SELECT name, total_popularity FROM event WHERE name LIKE ? OR features_event LIKE ?");

  $select_terme->execute(array("%".$terme."%", "%".$terme."%"));
 }
 else
 {
  $message = "Vous devez entrer votre requete dans la barre de recherche";
 }
}
?>

<?php
	

echo"<div class=\"page\">";
echo"<section id=\"main\">";
echo"<div class=\"event-description\">
      <ul> Informations sur l'event :
        <li>Nom : ".$terme_trouve['name']." </li>
        <li>Popularité : ".$terme_trouve['total_popularity']."</li>
        <li> Tweet Populaire :
<blockquote class=\"twitter-tweet\" lang=\"fr\">
  <p>".$terme_trouve['name']."</p>&mdash;
  ".$terme_trouve['name']." <a href=\"https://twitter.com/USER/status/TWEET_ID\" 
  data-datetime=DATE>".$terme_trouve['name']."</a>
</blockquote>
<script src=\"//platform.twitter.com/widgets.js=\" charset==\"utf-8=\"></script>

         </li>
      </ul>
    </div>


</section>
</div>";
?>
<?php
require("include/footer.inc.php");
  foot();
  ?>
