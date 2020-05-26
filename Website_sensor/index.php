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
	
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="data_charts.js" type="text/javascript"></script>
	<script src="https://d3js.org/d3.v4.min.js"></script>

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
<!-- Header -->
<?php
	require ('include/header.inc.php');
	headWeb("Index","Gestion de l'apprentissage","home","index");
?>

<!-- Content -->

<!-- Test de la requête : sql_request -> data_charts -> index.php -->
<script type="text/javascript">
	dataTestSQL = getDataForGraphics("lineChart");

	for (var obj in dataTestSQL) {
		alert(dataTestSQL[obj].label);
	}
</script>

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

<!--Footer-->
<?php
require("include/footer.inc.php");
  foot();
?>

