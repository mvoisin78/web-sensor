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
	.check-event p{
	margin-block-start: 0em;
    margin-block-end: 0em;"
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

<div class="col-md-3">
	<div id="content-checkbox-list" class="check-event informations-accueil">
		<h3>Comparer des events :</h3>
		<div id="checkbox-list">
		</div>
	</div>

</div> 
<div id="content-comparison" class="col-md-9">
	<div class="accueil-graphique" style="height:auto">
	<h3>Graphique de la popularité des events au cours du temps :</h3>
	<div id="linechart_comparison" class="chartjs" data-chart="">
		<canvas class="chartjs-render-monitor" style="font-family: 'Courier New'; font-weight: 400; line-height: 24px; border-width: 1px; display: block; width: 100%; height: 100%"></canvas>

		<script id="chartjs-script" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
		
	</div>
		<form style="margin-top:15px;">
			<label for="start">From :</label>
			<input type="date" id="start_date" name="graph-start" style="width:140px; height: 27px" value="2020-02-11" min="2020-01-01" max="2030-01-01">
			<label for="start">To :</label>
			<input type="date" id="end_date" name="graph-end" style="width:140px; height: 27px" value="2020-03-20" min="2020-01-01" max="2030-01-01">
		</form>
	</div>  
	
	
	<script type="text/javascript">

		//GET AND BUILD DATA
		function getDates (startDate, endDate, dateList) {
			if (typeof startDate == "undefined"){
				startDate = dateList[0];
			}
			var date1 = new Date(startDate);
			var date2 = new Date(endDate);
		
			// To calculate the time difference of two dates 
			var differenceDay = parseInt(date2.getDate(),10) - parseInt(date1.getDate(),10);
			return differenceDay;
		};
		
		var listColor = ["rgba(255, 99, 132,0.8)","rgba(54, 162, 235,0.8)","rgba(255, 165, 0,0.8)",
		"rgba(239, 83, 80,0.8)","rgba(0,255,0,0.8)","rgba (156, 39, 176,0.8)",
		"rgba(63, 81, 181,0.8)","rgba(33, 150, 243,0.8)","rgba(0, 188, 212,0.8)",
		"rgba(102, 187, 106,0.8)","rgba(255, 238, 88,0.8)","rgba(255, 152, 0,0.8)",
		"rgba(109, 76, 65,0.8)"];
		var dateList = [];
		var eventList = [];
		
		var dataSQL = getDataForGraphics("linechart",null,null);
		console.log(dataSQL);

		for ($dayPop in dataSQL){
			
			$eventId = String(dataSQL[$dayPop]['event_id']);
			$eventName = dataSQL[$dayPop]['name'];
			$popularityDate = ((dataSQL[$dayPop]['popularity_date']).toString().substring(0, 10));
			$popularity = dataSQL[$dayPop]['number'];
		
			if (typeof eventList[$eventId] == 'undefined') {
				//insert html checkboxes
				document.getElementById("checkbox-list").innerHTML += "<p><input name='"+dataSQL[$dayPop].event_id+"' class='checkbox-event' type='checkbox' />&nbsp;"+dataSQL[$dayPop].name+"<br /></p>";
				//create element of list of event
				eventList[$eventId] = {};
				eventList[$eventId].label = $eventName;
				eventList[$eventId].data = [];
				eventList[$eventId].popularityDate = [];
				eventList[$eventId].fill = false;
			}
			
			if(!(dateList.includes($popularityDate))){
				dateList.push($popularityDate);
			}

			//Push 0 while we we don't have one data for each day since the last date to the actual date
			if(!(eventList[$eventId].popularityDate.includes(String($popularityDate)))){
				var tmpArray = eventList[$eventId].popularityDate;
				var $startDate = tmpArray[tmpArray.length - 1];
				var $endDate = $popularityDate
				
				console.log("DATES : " + $startDate + " " + $endDate + " : " + dayCount);
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
				
				if(eventList[$eventId].label == "Concours Top Achat"){
				
					console.log(dayCount + " " +$startDate + " " + eventList[$eventId].data);
				}
				eventList[$eventId].popularityDate.push(String($popularityDate));	
			}
			//add data of the day to eventList[eventID].data
			eventList[$eventId].data.push(String($popularity));
		}
		
		var saveDateList = dateList.slice(0);
		
		//Push 0 while we we don't have one data for each day since the last data provide.
		for ($event in eventList){
			var number_data = dateList.length
			while (eventList[$event].data.length != number_data){
				eventList[$event].data.push("0");
			}
		}
		console.log(eventList);
		
		eventListClear = []
		eventList.forEach(element => eventListClear.push(element));

		var dataChart = {};
		dataChart.type = 'line';
		dataChart.data = {};
		dataChart.data.labels = dateList;
		for(var key in dataChart.data) {
			console.log(key+ "truc :" + dataChart.data[key]);
		}

		console.log(dataChart);

		//DRAW THE CHART		
		
		function createChart(dataChart){
			if (typeof chartjs != 'undefined') {
				chartjs.destroy();
			}
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
			
			$(".checkbox-event").each(function(i){
				$(this)[0].setAttribute('onclick', 'handleClick(false)');
			});
		}
		
		createChart(dataChart);
		
		//FONCTIONS FOR CHECKBOXES

		function handleClick(option) {
			document.getElementById("linechart_comparison").setAttribute("data-chart","");
			//var d2 = new Date(d1);
			var eventListNew = [];
			var indexColor = 0;
			eventListNew = eventList.slice(0);
			$(".checkbox-event").each(function(i){
				if(!($(this)[0].checked)){
					eventListNew[$(this)[0].name] = null;
				}
				//set attribut color
				else{
					if(indexColor < listColor.length){
						eventListNew[$(this)[0].name].borderColor = listColor[indexColor];
						indexColor++;
					}
					else{
						dataChart.data.borderColor = listColor[0];
					}
				}
			});
			console.log(eventListNew);
			
			var eventListClear = [];
			for (var i = 0; i < eventListNew.length; i++) {
				
				if(typeof eventListNew[i] != 'undefined'){
					if(eventListNew[i] != null){
						eventListClear.push(eventListNew[i]);
					}
				}
			}
			if(option == true){
				var dateStart = new Date(document.getElementById("start_date").value);
				var dateEnd = new Date(document.getElementById("end_date").value)
				
				if(dateStart > new Date(dateList[0])){
					for (var i = dateList.length; i >= 0; i--){
						if (new Date(dateList[i]) < dateStart){
							dateList.splice(i, 1);
						}
					}
				}
				else if(dateStart < new Date(saveDateList[0])){
					dateList = saveDateList
				}
				else if(dateStart < new Date(dateList[0])){
					for (var i = saveDateList.indexOf(dateList[0]); i >= 0; i--){
						if (new Date(saveDateList[i]) >= dateStart){
							dateList.unshift(saveDateList[i]);
						}
					}
				}
				if(dateEnd < new Date(dateList[dateList.length-1])){
					for (var j = dateList.length; j >= 0; j--){
						if (new Date(dateList[j]) > dateEnd){
							dateList.splice(j, 1);
						}
					}
				}
				else if(dateEnd > saveDateList[saveDateList.length-1]){
					dateList = saveDateList
				}
				else if(dateEnd > new Date(dateList[dateList.length-1])){
					for (var j = (saveDateList.length)-1; j > (dateList.length)-1; j--){
						if (new Date(saveDateList[j]) <= dateEnd){
							dateList.push(saveDateList[j]);
						}
					}
				}
				
			}
			console.log(dateList);
			var dataChart = {};
			dataChart.type = 'line';
			dataChart.data = {};
			dataChart.data.labels = dateList;
			dataChart.data.datasets = eventListClear;
			//ReCreate the chart
			createChart(dataChart);
		}
		function changeDate(){
			handleClick(true);
		}

		//START DATE changing event
		let start_date=window.document.getElementById("start_date");
		let olddate=start_date.value;
		let isChanged = function(){
		  if(start_date.value!== olddate){
			olddate=start_date.value;
			return true;
		  };
		  return false;
		};
		start_date.addEventListener("blur", function(){
		  if(isChanged())
			changeDate();
		});
		
		//END DATE changing event
		let end_date=window.document.getElementById("end_date");
		let olddate2=end_date.value;
		let isChanged2 = function(){
		  if(end_date.value!== olddate2){
			olddate2=end_date.value;
			return true;
		  };
		  return false;
		};
		end_date.addEventListener("blur", function(){
		  if(isChanged2())
			changeDate();
		});
		
		/* //OBJET POUR CANEVA
		var dataChart = {
			'type':'line',
			'data':{
				'labels':['01/06','02/06','03/06','04/06','05/06','06/06','07/06','08/06','09/06','10/06'],
				'datasets':[
					{
						'label':"event1",
						'data':[12,19,3,5,2,3],
						'fill':false,
						'borderColor':'"rgbaa(255, 99, 132, 0.5)'
					},
					{
						'label':"event2",
						'fill':false,
						'data':[3,15,7,4,19,12],
						'borderColor':'"rgbaa(54, 162, 235, 0.5)'
					}
				]
			}
		};
		*/

		//document.getElementById("content-checkbox-list").setAttribute("style","max-height:"+document.getElementById('linechart_comparison').height);
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
