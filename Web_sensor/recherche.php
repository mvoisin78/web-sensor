<?php
session_start();

$_SESSION['terme'];

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

<div class="searchbar">
                               
<div class="row">
  <div class="col-md-4 col-md-offset-4">
        <form action = "#" method = "get">
          <input class="form-control form-control-md mr-3 w-75" type="search" placeholder="Rechercher un event..." aria-label="Search" name="terme">
          <input class="btn btn-default" type = "submit" name = "s" value = "Rechercher">
        </form>
</div>
</div>

</div>  


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



echo"<div class=\"informations-accueil\">";

  while($terme_trouve = $select_terme->fetch())
  {
   echo "<div><ul>
   <li> <a href=\"popularite.php\">".$terme_trouve['name']."</a></li></ul>
   <li> Popularité : ".$terme_trouve['total_popularity']."</li>
   <li> Tweet populaire : </li>
   <li> Features : </li>
   </ul>"
   ;
  }
  $select_terme->closeCursor();
  echo"</div>";
   ?>
</section>
</div>

<!--Footer-->
<?php
require("include/footer.inc.php");
  foot();
?>
