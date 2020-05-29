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

 if (isset($terme))
 {
  $terme = strtolower($terme);
  $select_terme = $bdd->prepare("SELECT label, tweet FROM event WHERE label LIKE ? OR tweet LIKE ?");
  $select_terme->execute(array("%".$terme."%", "%".$terme."%"));
 }
 else
 {
  $message = "Vous devez entrer votre requete dans la barre de recherche";
 }
}
?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset = "utf-8" >
  <title>Les résultats de recherche</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style2.css">
 </head>
 <body>

  <?php
  require ('include/header.inc.php');
  headWeb("Index","Gestion de l'apprentissage","home","index");


echo"<div class=\"page\">";
echo"<section class=\"main\">";

echo"<div class=\"informations-accueil\">";

  while($terme_trouve = $select_terme->fetch())
  {
   echo "<div><h2>".$terme_trouve['label']."</h2>
   <ul>
     <li>Nom : </li>
        <li>Catégorie :</li>
        <li>Lieu : </li>
        <li> Date : </li>
        <li>Popularité : </li>
        <li> Tweet Populaire : </li>
   </ul>
   <p> ".$terme_trouve['tweet']."</p>"
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
