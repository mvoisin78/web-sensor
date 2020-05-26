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

      <style type="text/css">
        html { height: 100% }
        body { height: 100%; margin: 3; padding: 3}
        #container { width: 100%}
    .line {
      fill: none;
      stroke: steelblue;
      stroke-width: 2px;
    }

    </style>

</head>

<body>

<?php
  require ('include/header.inc.php');
    headWeb("Index","Gestion de l'apprentissage","home","index");
  /*$connexion = new PDO('pgsql:host=postgresql-websensor.alwaysdata.net;port=5432;dbname=websensor_2019;user=websensor;password=projet2019');
  $resultset = $connexion->prepare("SELECT * FROM vectors");
  $resultset->execute();
  $count = $resultset->rowCount();
  while ($row = $resultset->fetch(PDO::FETCH_ASSOC)) {
    print(strval($row["vector"]));
    print(strval($row["tweet_content"]));
    print(strval($row["id_tweet"]));
    print(strval($row["date"]));
  }
  print($count);
  */
?>

<div class="page">
<section class="main">

<h2> Visionner et rechercher tous les evenements du moment </h2>


<div class="informations-accueil">
  <p>Ici y aura les infos sur l'event affiché</p>
  <ul><li>tu peux mettre une liste nom, lieu ...etc</li></ul>
</div>
<div class="accueil-graphique">
  <p>on verra bien ce que la vie nous reservera</p>
</div>



</section>
</div>


<?php
require("include/footer.inc.php");
  foot();
  ?>

