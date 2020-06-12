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
	<script src="data_charts.js" type="text/javascript"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>  

	<style>
	blockquote.twitter-tweet {
		display: inline-block;
		font-family: "Helvetica Neue", Roboto, "Segoe UI", Calibri, sans-serif;
		font-size: 12px;
		font-weight: bold;
		line-height: 16px;
		border-color: #eee #ddd #bbb;
		border-radius: 5px;
		border-style: solid;
		border-width: 1px;
		box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
		margin: 10px 5px;
		padding: 0 16px 16px 16px;
		max-width: 468px;
	}
	blockquote.twitter-tweet p {
		font-size: 16px;
		font-weight: normal;
		line-height: 20px;
	}
	blockquote.twitter-tweet a {
		color: inherit;
		font-weight: normal;
		text-decoration: none;
		outline: 0 none;
	}
	blockquote.twitter-tweet a:hover,
	blockquote.twitter-tweet a:focus {
		text-decoration: underline;
	}
	</style>
</head>
<body>
<?php
	require ('include/header.inc.php');
	headWeb("Index","Gestion de l'apprentissage","home","index");
?>

<div class="page">
<section id="main">
  <div class="container-fluid">
    <div class="container">
      <div class="row">

<div class="col-md-4">
     <div class="informations-accueil">
      <h3> Liste d'events à comparer :</h3>
      <ul>
        <li>event n°1 : Coupe du monde</li>
        <li>event n°2 :Coupe d'Europe </li>
    
      </ul>
     </div>
     
     <div class="informations-accueil">
          <h3>Informations sur l'event :</h3>

      <ul>
        <li>Nom : Coupe du monde </li>
        <li>Popularité : 450958 </li>
        <li> Tweet Populaire :<blockquote class="twitter-tweet" lang="fr">
  MERCI à l’équipe de France ! 🇫🇷<br><br>MERCI au peuple français ! 🇫🇷<br><br>MERCI à toute la France ! 🇫🇷<br><br>Cette Coupe du monde restera gravée dans l’histoire du football français. 🔵⚪️🔴</p>
  &mdash; Actu Foot (@ActuFoot_) <a href="https://twitter.com/USER/status/TWEET_ID">July 16, 2018</a>
</blockquote>
<script src="//platform.twitter.com/widgets.js" charset="utf-8"></script>


      </ul>
     </div>
   <div class="informations-accueil">
    <h3>Informations sur l'event :</h3>
      <ul>
        <li>Nom : Coupe d'Europe </li>
        <li>Popularité : 45018 </li>
        <li> Tweet Populaire :<blockquote class="twitter-tweet" lang="fr">
  <p style="margin-top:15px;">Exclu des Coupes d’Europe, Manchester City devant le TAS
  </p>&mdash; FranceInfo (@francinfo) <a href="https://twitter.com/USER/status/TWEET_ID" 
  data-datetime=DATE>Mai 3, 2020</a>
</blockquote>
<script src="//platform.twitter.com/widgets.js" charset="utf-8"></script></li>
    </ul>
     </div>

</div> 

<div class="col-md-8">
	<h3>Graphique la popularité des events au cours du temps :</h3>
	<div class="accueil-graphique">
	<div id="linechart_comparison" class="chartjs" data-chart="">
		<canvas class="chartjs-render-monitor" style="font-family: 'Courier New'; font-weight: 400; line-height: 24px; border-width: 1px; display: block; width: 100%; height: 100%"></canvas>
		 <!-- /container -->

		<script id="chartjs-script" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
		<script type="text/javascript">
		dataTestSQL = getDataForGraphics("linechart");
		console.log(dataTestSQL);
		var dateList = [];
		var numberList = [];
		/*
		for (var obj in dataTestSQL) {
			name = dataTestSQL[obj]['name'];
			dateList[name] = [];
			dateList[name].push(dataTestSQL[obj]['popularity']);
		}
		*/
		var dataChart = {
			'type':'line',
			'data':{
				'labels':['01/06','02/06','03/06','04/06','05/06','06/06','07/06','08/06','09/06','10/06'],
				'datasets':[
					{
						'data':[12,19,3,5,2,3],
						'fill':false,
						'borderColor':'rgba(255, 99, 132, 0.5)'
					},
					{
						'fill':false,
						'data':[3,15,7,4,19,12],
						'borderColor':'rgba(54, 162, 235, 0.5)'
					}
				]
			}
		};
		var divCanvas = document.getElementById("linechart_comparison");
		divCanvas.setAttribute("data-chart",dataChart);
		divCanvas.style.height = "100%";
		
		$(document).ready(function() {
				 $(".chartjs").each(function () {
							 ctx = $("canvas", this).get(0).getContext("2d");
							 config = (dataChart);            
							 chartjs = new Chart(ctx, config);         
						   });       
			   });       
		</script>
	</div>
	</div>  

	<form style="margin-top:15px;">
	<a href="#" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> Ajouter un event</a>
	<a href="#" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-remove"></span> Supprimer un event</a>
	<a href="#" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-signal"></span> Changer de graphique</a>
	</form>

	<div class="informations-accueil"  style="margin-top:15px;">
	<h3>Liste de tous les events :</h3>
		<ul>
			<li>Coronavirus </li>
			<li>Stade de France</li>
			<li> fête nationale </li>
			<li> League des champions </li>
			<li> Les elecetions présidentielles</li>
			<li> Nouvel an</li>
			<li> Match de Rugby</li>
		</ul>
	</div>

</div>
</div>
</div>

</section>
</div>
<?php
require("include/footer.inc.php");
  foot();
  ?>
