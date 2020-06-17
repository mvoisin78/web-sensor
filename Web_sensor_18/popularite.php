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

	<script src="data_charts.js" type="text/javascript"></script>

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
 $bdd = new PDO("mysql:host=localhost;dbname=websensor17", "root", "root");
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
    
    $select_terme = $bdd->prepare("SELECT DISTINCT * 
                    FROM event 
                    INNER join popularity ON popularity.event_id = event.event_id 
                    INNER join tweet ON tweet.tweet_id=popularity.tweet_id 
                    WHERE popularity_date ='2020-02-23 00:00:00' And name LIKE ? OR features_event LIKE ?  
");

  $select_terme->execute(array("%".$terme."%", "%".$terme."%"));
 }
 else
 {
  $message = "Vous devez entrer votre requete dans la barre de recherche";
 }
}

?>

<div class="container-fluid">
  <div class="container"> 
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <h3>Informations sur l'event :</h3>
<?php
echo"<div class=\"informations-accueil\">";

$terme_trouve=[];
$terme_trouve = $_SESSION['rechercheList'][$_GET['nameevent']];



      echo"<ul style=\"margin-top:10px;\">         
        <li>Nom : ".$terme_trouve['name']." </li>
        <li>Popularité : ".$terme_trouve['total_popularity']."</li>
        <li> Tweet Populaire :
<blockquote class=\"twitter-tweet\">
  <p lang=\"fr\" dir=\"ltr\">".$terme_trouve['tweet_text']."</p>&mdash; ".$terme_trouve['user_name']." (@".$terme_trouve['user'].")
  <a href=\"https://twitter.com/".$terme_trouve['user']."/status/".$terme_trouve['tweet_id']."\">".substr($terme_trouve['popularity_date'], 0, 10)."</a>
</blockquote>

         </li>
      </ul>";
						
   echo" </div>";
   ?>
<canvas id="myChart" style="max-width: 500px;"></canvas>
<div>
  
 
<div data-component-chartjs="" class="chartjs" data-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Red&quot;,&quot;Blue&quot;,&quot;Yellow&quot;,&quot;Green&quot;,&quot;Purple&quot;,&quot;Orange&quot;],&quot;datasets&quot;:[{&quot;data&quot;:[12,19,3,5,2,3],&quot;fill&quot;:false,&quot;borderColor&quot;:&quot;rgba(255, 99, 132, 0.2)&quot;},{&quot;fill&quot;:false,&quot;data&quot;:[3,15,7,4,19,12],&quot;borderColor&quot;:&quot;rgba(54, 162, 235, 0.2)&quot;}]}}" style="min-height:240px;min-width:240px;width:100%;height:100%;position:relative">        <canvas width="975" height="487" class="chartjs-render-monitor" style="display: block; width: 975px; height: 487px;"></canvas>      </div>

     <!-- /container -->
  

<script id="chartjs-script" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script><script>       $(document).ready(function() {          $(".chartjs").each(function () {            ctx = $("canvas", this).get(0).getContext("2d");            config = JSON.parse(this.dataset.chart);            chartjs = new Chart(ctx, config);         });       });       </script>

   </div>


</section>
</div>
</div>
</div>
</div>
</div>";
?>
<?php
require("include/footer.inc.php");
  foot();
  ?>
