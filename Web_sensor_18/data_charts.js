function getDataForGraphics(requestGraphicType, date_from, date_to){

	var list = null;
	var data_action;

	switch(requestGraphicType){
	
		case "linechart" :
			data_action = "getDataLine";
			break;
			
		case "piechart" :
			data_action = "getDataPie";
			break;

		default :
			alert("Le type de graphique n'est pas renseigné dans le function getDataForGraphics");
			data_action = "action=getDataLine";
	}
	console.log(data_action);
	$.ajax({
		method : "GET",
		url : 'pdo/sql_request.php',
		async : false,
		data : {action: data_action, date_from: date_from, date_to: date_to},
		dataType : "json",
		accepts : "application/json; charset=utf-8",
	}).done(function(data) {
		list = data;
		console.log(data);

	}).fail(function(data) {
		
		var respObj = null;
		var msg;

		try {
			respObj = JSON.parse(data.responseText);
			msg = respObj.msg;
		} catch (err) {
			msg = data.responseText;
		}
		alert("Erreur : " + msg);
	});
	return list;
}