<!DOCTYPE html>
<?php
session_start();
?>

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
<!-- Header -->
<?php
	require ('include/header.inc.php');
	headWeb("Index","Gestion de l'apprentissage","home","index");
?>

<!-- Content -->

<div class="page">
	<section class="main"> 
	<div class="container-fluid">
	<div class="container">	
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<h2> Top 10 des events populaires : </h2>
			<div class="informations-accueil">  
			<?php
			try{
				$bdd = new PDO('mysql:host=localhost;dbname=WebSensor', 'root', 'root',  array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			}
			catch (Exception $e){
				die('Erreur : ' . $e->getMessage());
			}
			//GROUP BY name ---- ca c pr o cas uy a des douSELECT * FROM popularity WHERE date = " " FETCH FIRST 10 ROW ONLY ORDER BY daily_popularity;

			$reponse = $bdd->query('SELECT DISTINCT * 
										FROM popularity 
										INNER join event ON popularity.event_id = event.event_id 
										INNER join tweet ON tweet.tweet_id=popularity.tweet_id  
										WHERE popularity_date = CURDATE()
										ORDER BY popularity.number desc 
										LIMIT 10
										');
			
			while ($donnees = $reponse->fetch()){
			?>
		
				<ul> 
					<li style="margin-top=18px;"><h4 style = "color:#1873A1"><a href="https://twitter.com"><img class="logo"src="/img/logo.png"
     alt="logo twitter"></a><?php echo $donnees['name']; ?></h4>
						<blockquote class="twitter-tweet" lang="fr">
							<p lang="fr" dir="ltr"><?php echo $donnees['tweet_text']; ?></p>&mdash; <?php echo $donnees['user_name']; ?> 
							<a href="https://twitter.com/USER/status/TWEET_ID" data-datetime=DATE><?php echo $donnees['popularity_date']; ?></a>
						</blockquote>
						<script src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
					</li>
				</ul>

			<?php
			}

			$reponse->closeCursor(); // Termine le traitement de la requête
			?>

			</div>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
			<h2> Graphique du top 10 : </h2>

			<div id="piechart" class="accueil-graphique">
			  <!-- pdo/sql_request.php -> data_charts.js -> index.php -->
				<script type="text/javascript">
				dataTestSQL = getDataForGraphics("piechart");
				console.log(dataTestSQL);

				//PIECHART

				occurence_list = [];
				label_list = [];

				//json to list
				for (const obj of dataTestSQL) {
					label_list.push(obj.name)
					occurence_list.push(obj.total_popularity)
				}

			//	console.log(label_list)
			//	console.log(occurence_list)
				var width = document.getElementById('piechart').offsetWidth,
					height = document.getElementById('piechart').offsetHeight,
					radius = Math.min(width, height) / 2;

				var color = ["red","orange","yellow","34CA00","green","steelblue","blue","10cf9b","13b934","81431E","ef3038","2b4ab1","715438","814994","purple","ddde1e","c6721a","ea7c60","d154e9","ea5c61","998df0","27e33c","9bcb1a","edca77","a1f3b1",/*repeat*/"red","orange","yellow","34CA00","green","steelblue","blue","10cf9b","13b934","647f1f","81431E","ef3038","2b4ab1","715438","814994","purple","ddde1e","c6721a","ea7c60","d154e9","ea5c61","998df0","27e33c","9bcb1a","edca77","a1f3b1"];

				var arc = d3.arc()
					.outerRadius(radius - 10)
					.innerRadius(0);

				var labelArc = d3.arc()
					.outerRadius(radius - 40)
					.innerRadius(radius - 40);

				var pie = d3.pie()
					.sort(null)
					.value(function(d) { return d; });

				var svg = d3.select("#piechart").append("svg")
					.attr("width", width)
					.attr("height", height)
					.append("g")
					.attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

				var g = svg.selectAll(".arc")
					.data(pie(occurence_list))
					.enter().append("g")
					.attr("class", "arc");

				g.append("path")
					.attr("d", arc)
					.style("opacity", 0.8)
					.style("fill", function(d, i) { return color[i]; })
					.on("mouseover", function() { d3.select(this).style("stroke-width", "2px").style("opacity", 1)})
					.on("mouseout", function() { d3.select(this).style("stroke-width", "1px").style("opacity", 0.8)});
						

				g.append("text")
					.attr("transform", function(d) { return "translate(" + labelArc.centroid(d) + ")"; })
					.text(function(d) { return d.data; })
					.attr("dy", "1em");
				g.append("text")
					.attr("transform", function(d) { return "translate(" + labelArc.centroid(d) + ")"; })
					.text(function(d) { return label_list[d.index]; })
					.attr("dy", "0em");

			  </script>
			</div>
		</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
			<h2> Prédictions pour la semaine prochaine : </h2>
			<div class="informations-accueil">
					
		<?php
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=WebSensor', 'root', 'root');
		}
		catch (Exception $e)
		{
				die('Erreur : ' . $e->getMessage());

		}


		$reponse_prediction = $bdd->query('SELECT * FROM prediction, event WHERE prediction.event_id = event.event_id');


		$donnees_prediction = $reponse_prediction->fetch();

		while ($donnees_prediction = $reponse_prediction->fetch())
		{
		?>
	
				<ul>
					<li><?php echo $donnees_prediction['name']; ?></li>

				</ul>
		
		<?php
		}
		$reponse_prediction->closeCursor(); // Termine le traitement de la requête
		?>
	</div>
		</div>
	</div>
	</div>
	</div>
	</section>
</div>

<!-----Footer-->
<?php
require("include/footer.inc.php");
  foot();
?>