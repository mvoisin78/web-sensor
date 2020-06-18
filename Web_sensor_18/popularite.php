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
<div class="page" style="padding-bottom:10px; height:500px">
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
	  <div class="row" height="100%" >
		<div class="col-md-4">

				  <h3>Informations sur l'event :</h3>
			<?php
			
			$terme_trouve=[];
			$terme_trouve = $_SESSION['rechercheList'][$_GET['nameevent']];
			
			echo"<div id=\"event_id\" event_id=\"".$terme_trouve['event_id']."\" idclass=\"informations-accueil\">";

				  echo"<ul style=\"margin-top:10px;list-style-type:none\">         
					<li>Nom : ".$terme_trouve['name']." </li>
					<li>Popularité : ".$terme_trouve['total_popularity']."</li>
					<li>Tweet d'un utilisateur populaire :
			<blockquote class=\"twitter-tweet\">
			  <p lang=\"fr\" dir=\"ltr\">".$terme_trouve['tweet_text']."</p>&mdash; ".$terme_trouve['user_name']." (@".$terme_trouve['user'].")
			  <a href=\"https://twitter.com/".$terme_trouve['user']."/status/".$terme_trouve['tweet_id']."\">".substr($terme_trouve['popularity_date'], 0, 10)."</a>
			</blockquote>

					 </li>
				  </ul>";
									
			   echo" </div>";
			   ?>
		</div>
		<div id="content-comparison" class="col-md-8" height="400px">
			<div class="accueil-graphique" style="height:auto">
			<div id="linechart_comparison" class="chartjs" data-chart="">
			<h3>Graphique de la popularité au cours du temps :</h3>
				<canvas class="chartjs-render-monitor" style="font-family: 'Courier New'; font-weight: 400; line-height: 24px; border-width: 1px; display: block; width: 100%; height: 350px"></canvas>
				
				<script id="chartjs-script" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script> 
			<script type="text/javascript">

				//GET AND BUILD DATA
				function getDates (startDate, endDate, dateList) {
					if (typeof startDate == "undefined"){
						startDate = dateList[0];
					}
					var date1 = new Date(startDate);
					var date2 = new Date(endDate);
				
					// To calculate the time differencrowe of two dates 
					var differenceDay = parseInt(date2.getDate(),10) - parseInt(date1.getDate(),10);
					return differenceDay;
				};
				Date.prototype.yyyymmdd = function() {
				  var mm = this.getMonth() + 1; // getMonth() is zero-based
				  var dd = this.getDate();
				  return [this.getFullYear(),
						  (mm>9 ? '' : '0') + mm,
						  (dd>9 ? '' : '0') + dd
						 ].join('-');
				};
				Date.prototype.addDays = function(days) {
					var date = new Date(this.valueOf());
					date.setDate(date.getDate() + days);
					return date;
				}
				
				var listColor = ["rgba(255, 99, 132,0.8)","rgba(54, 162, 235,0.8)","rgba(255, 165, 0,0.8)",
				"rgba(239, 83, 80,0.8)","rgba(0,255,0,0.8)","rgba (156, 39, 176,0.8)",
				"rgba(63, 81, 181,0.8)","rgba(33, 150, 243,0.8)","rgba(0, 188, 212,0.8)",
				"rgba(102, 187, 106,0.8)","rgba(255, 238, 88,0.8)","rgba(255, 152, 0,0.8)",
				"rgba(109, 76, 65,0.8)"];
				var dateList = [];
				var eventList = [];
				var eventId = document.getElementById("event_id").getAttribute("event_id");
				
				var dataSQL = getDataForGraphics("linechart",null,eventId);
				console.log(dataSQL);

				//In []: for date in datetime_range(start=datetime(2014, 1, 1), end=datetime(2014, 1, 5)):
	
				var tmpdateList = []
				for ($dates in dataSQL){
					var tmpdate = (dataSQL[$dates]['popularity_date']).toString().substring(0, 10)
					tmpdateList.push(tmpdate);
				}
				var currentDate = new Date(tmpdateList[0]);
				var stopDate = new Date(tmpdateList[tmpdateList.length-1]);
				while (currentDate <= stopDate){
					var currentDateFormat = currentDate.yyyymmdd()
					console.log(currentDateFormat);
					dateList.push(String(currentDateFormat).toString().substring(0, 10));
					currentDate = currentDate.addDays(1);
				}
				console.log(dateList);
				for ($dayPop in dataSQL){
					
					$eventId = String(dataSQL[$dayPop]['event_id']);
					$eventName = dataSQL[$dayPop]['name'];
					$popularityDate = ((dataSQL[$dayPop]['popularity_date']).toString().substring(0, 10));
					$popularity = dataSQL[$dayPop]['number'];
				
					if (typeof eventList[$eventId] == 'undefined'){
						//create element of list of event
						eventList[$eventId] = {};
						eventList[$eventId].label = $eventName;
						eventList[$eventId].data = [];
						eventList[$eventId].popularityDate = [];
						eventList[$eventId].fill = false;
						eventList[$eventId].borderColor = listColor[1];
					}
					
					if(!(dateList.includes($popularityDate))){
						dateList.push($popularityDate);
					}

					//Push 0 while we we don't have one data for each day since the last date to the actual date
					if(!(eventList[$eventId].popularityDate.includes(String($popularityDate)))){
						var tmpArray = eventList[$eventId].popularityDate;
						var $startDate = tmpArray[tmpArray.length - 1];
						var $endDate = $popularityDate
						
						if (typeof $startDate == "undefined" && $popularityDate != dateList[0]){
							eventList[$eventId].data.push("0");
							eventList[$eventId].popularityDate.push(dateList[0]);
						}
						
						var dayCount = getDates($startDate,$endDate,dateList);
						
						if(dayCount > 1){
							for(var i=0; i < dayCount-1; i++){
								eventList[$eventId].data.push("0");
							}
						}
						eventList[$eventId].popularityDate.push(String($popularityDate));	
					}
					//add data of the day to eventList[eventID].data
					eventList[$eventId].data.push(String($popularity));
				}

				console.log(eventList);
				
				eventListClear = []
				eventList.forEach(element => eventListClear.push(element));

				var dataChart = {};
				dataChart.type = 'line';
				dataChart.data = {};
				dataChart.data.labels = dateList;
				dataChart.data.datasets = eventListClear;

				console.log(dataChart);

				//DRAW THE CHART		
				
				function createChart(dataChart){
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
				}
				createChart(dataChart);
								
			</script>
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
