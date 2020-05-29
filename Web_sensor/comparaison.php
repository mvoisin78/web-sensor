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
</head>
<body>
<?php
	require ('include/header.inc.php');
	headWeb("Index","Gestion de l'apprentissage","home","index");
?>

<div class="page">
<section id="main">
  <h3>Visualiser et comparer des événments: </h3>
   <div class="informations-accueil">
  <ul> Liste d'events à comparer :
   <li>event n°1 : </li>
        <li>event n°2 :</li>
        <li>event n°3 : </li>
  </ul>
  </div>


     
<div class="informations-accueil">
  <ul>Informations sur l'event :
        <li>Nom : </li>
        <li>Catégorie :</li>
        <li>Lieu : </li>
        <li> Date : </li>
        <li>Popularité : </li>
        <li> Tweet Populaire : </li>

      </ul>
  </div


<h2>Les graphiques de comparaison :</h2>
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


  <form>
  <a href="#" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Ajouter un event</a>
  <a href="#" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Supprimer un event</a>
  <a href="#" class="btn btn-default"><span class="glyphicon glyphicon-signal"></span> Changer de graphique</a>
</form>

</section>
</div>
<?php
require("include/footer.inc.php");
  foot();
  ?>
