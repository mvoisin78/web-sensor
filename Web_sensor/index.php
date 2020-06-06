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

<!-- Test de la requête : sql_request -> data_charts -> index.php -->
<script type="text/javascript">
	dataTestSQL = getDataForGraphics("lineChart");

	for (var obj in dataTestSQL) {
		alert(dataTestSQL[obj].label);
	}
</script>

<div class="page">
<section class="main"> 
	<div class="container-fluid">
		<div class="container">
<div class="row">

<h2> Events populaires : </h2>
<div class="col-md-6">
<div class="informations-accueil"> 
	<ul> 
		<li> <blockquote class="twitter-tweet"><p lang="fr" dir="ltr">🥇🔥🇫🇷<br>La médaille, la flamme, Marianne.<br>Voici le nouveau visage des Jeux Olympiques et Paralympiques de  #Paris2024<br><br>The medal, the flame, Marianne</p>&mdash; Paris 2024 (@Paris2024) 
			October 21, 2019</blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></li>
		<li>Event 2: <blockquote class="twitter-tweet"><p lang="fr" dir="ltr">🇫🇷 FLASH - Il est 00h, nous sommes le <a href="https://twitter.com/hashtag/11mai?src=hash&amp;ref_src=twsrc%5Etfw">#11mai</a> : la 
			<a href="https://twitter.com/hashtag/France?src=hash&amp;ref_src=twsrc%5Etfw">#France</a> n’est désormais plus en <a href="https://twitter.com/hashtag/confinement?src=hash&amp;ref_src=twsrc%5Etfw">#confinement</a>. Au total, le pays aura été confiné pendant 55 jours en raison de l’épidémie de 
			<a href="https://twitter.com/hashtag/COVID19?src=hash&amp;ref_src=twsrc%5Etfw">#COVID19</a>. <a href="https://twitter.com/hashtag/Deconfinement?src=hash&amp;ref_src=twsrc%5Etfw">#Deconfinement</a></p>&mdash; Conflits (@Conflits_FR)
		 <a href="https://twitter.com/Conflits_FR/status/1259604126834532359?ref_src=twsrc%5Etfw">May 10, 2020</a></blockquote>
		  <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></li>
		<li> Event 3: <blockquote class="twitter-tweet"><p lang="fr" dir="ltr"><a href="https://twitter.com/hashtag/CORONAVIRUS?src=hash&amp;ref_src=twsrc%5Etfw">#CORONAVIRUS</a> <a href="https://twitter.com/hashtag/COVID19?src=hash&amp;ref_src=twsrc%5Etfw">#COVID19</a>
		 | Le port du masque est-il obligatoire dans les transports en commun ? ⤵️<br>⚠️ Si vous êtes malade, avez été en contact avec un malade ou êtes une personne à risque, le port du masque est également fortement recommandé. <a href="https://t.co/qexgqCYkHs">
		 pic.twitter.com/qexgqCYkHs</a></p>&mdash; Gouvernement (@gouvernementFR) <a href="https://twitter.com/gouvernementFR/status/1264560233126518786?ref_src=twsrc%5Etfw">May 24, 2020</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></li>
		<li> Event 4: <blockquote class="twitter-tweet"><p lang="fr" dir="ltr">Il y a 6 ans jour pour jour, l&#39;équipe de France battait l&#39;Ukraine 3-0 au Stade de France après une défaite 2-0 au match aller, et se qualifiait pour la Coupe du monde 2014.<br>🇫🇷<br><br>Ce match était fou. 🤯 
			<a href="https://t.co/smDVoCvshc">pic.twitter.com/smDVoCvshc</a></p>&mdash; Actu Foot (@ActuFoot_) <a href="https://twitter.com/ActuFoot_/status/1196578094078926848?ref_src=twsrc%5Etfw">November 18, 2019</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> </li>
		<li> Event 5: <blockquote class="twitter-tweet"><p lang="fr" dir="ltr">🥇🔥🇫🇷<br>La médaille, la flamme, Marianne.<br>Voici le nouveau visage des Jeux Olympiques et Paralympiques de <a href="https://twitter.com/hashtag/Paris2024?src=hash&amp;ref_src=twsrc%5Etfw">#Paris2024</a><br><br>The medal, the flame, Marianne<br>Here is the new face of the Olympic and Paralympic Games of <a href="https://twitter.com/hashtag/Paris2024?src=hash&amp;ref_src=twsrc%5Etfw">#Paris2024</a> <a href="https://t.co/6VvsItrql6">pic.twitter.com/6VvsItrql6</a></p>&mdash; Paris 2024 (@Paris2024) 
			<a href="https://twitter.com/Paris2024/status/1186347647403249664?ref_src=twsrc%5Etfw">October 21, 2019</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></li>
		<li> Event 6:<blockquote class="twitter-tweet"><p lang="fr" dir="ltr">🇫🇷 FLASH - La <a href="https://twitter.com/hashtag/France?src=hash&amp;ref_src=twsrc%5Etfw">#France</a>
		 sera la seule destination possible lors des <a href="https://twitter.com/hashtag/vacances?src=hash&amp;ref_src=twsrc%5Etfw">#vacances</a> d’<a href="https://twitter.com/hashtag/%C3%A9t%C3%A9?src=hash&amp;ref_src=twsrc%5Etfw">#été</a>. Les 9 millions de touristes français qui avaient prévu de partir à l’étranger devront rester dans le pays. (Le Parisien) <a href="https://t.co/SEz7CEoT4f">pic.twitter.com/SEz7CEoT4f</a></p>&mdash; La Plume Libre (@LPLdirect) <a href="https://twitter.com/LPLdirect/status/1251436987988561921?ref_src=twsrc%5Etfw">April 18, 2020</a></blockquote> 
			<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> </li>
		<li> Event 7: <blockquote class="twitter-tweet"><p lang="fr" dir="ltr">Le 1er tour des <a href="https://twitter.com/hashtag/municipales?src=hash&amp;ref_src=twsrc%5Etfw">#municipales</a> s’est tenu le 15 mars dans des conditions exceptionnelles, avec un taux d’abstention significatif mais dans des conditions rigoureuses de distanciation physique et d’hygiène. Merci aux assesseurs et aux équipes municipales qui l’ont rendu possible. 
			<a href="https://t.co/is2yvRM2xo">pic.twitter.com/is2yvRM2xo</a></p>&mdash; Edouard Philippe (@EPhilippePM) <a href="https://twitter.com/EPhilippePM/status/1263783971814547456?ref_src=twsrc%5Etfw">May 22, 2020</a></blockquote>
		 <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></li>

	
</ul>
</div> 
</div>
<div class="col-md-6">
<div id="piechart" class="accueil-graphique">


<script>

	//PIECHART

	var data_list_obj = [
		{"label" : "Event 1",
		"occurence" : 4348
		},
		{"label" : "Event 2",
		"occurence" : 8851
		},
		{"label" : "Event 3",
		"occurence" : 7544
		},
		{"label" : "Event 4",
		"occurence" : 1200
		},
		{"label" : "Event 5",
		"occurence" : 7544
		},
		{"label" : "Event 6",
		"occurence" : 1551
		},
		{"label" : "Event 7",
		"occurence" : 2303
		}
	];
	occurence_list = [];
	label_list = [];

	//json to list
	for (const obj of data_list_obj) {
		label_list.push(obj.label)
		occurence_list.push(obj.occurence)
	}

	console.log(label_list)
	console.log(occurence_list)
	var width = document.getElementById('piechart').offsetWidth,
		height = document.getElementById('piechart').offsetHeight,
		radius = Math.min(width, height) / 2;

	var color = ["red","orange","yellow","34CA00","green","steelblue","blue","10cf9b","13b934","647f1f","81431E","ef3038","2b4ab1","715438","814994","purple","ddde1e","c6721a","ea7c60","d154e9","ea5c61","998df0","27e33c","9bcb1a","edca77","a1f3b1",/*repeat*/"red","orange","yellow","34CA00","green","steelblue","blue","10cf9b","13b934","647f1f","81431E","ef3038","2b4ab1","715438","814994","purple","ddde1e","c6721a","ea7c60","d154e9","ea5c61","998df0","27e33c","9bcb1a","edca77","a1f3b1"];

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

