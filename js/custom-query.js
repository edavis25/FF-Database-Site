
/**
 * This function is called from the custom query submit button onclick event. 
 */
function gameInfoQuery(url) {

	/*
	var teamNames = getSelectedOptions("select-team");
	var teamNamesJSON = JSON.stringify(teamNames);
	var wonLost = getRadioSelected("won-radios");
	var roof = getRadioSelected("roof-radios");
	var surface = getRadioSelected("surface-radios");
	var spread = getRadioSelected("spread-radios");
	var overUnder = getRadioSelected("overUnder-radios");
	var startWeek = document.getElementById("start-week").value;
	var endWeek = document.getElementById("end-week").value;
	var startYear = document.getElementById("start-year").value;
	var endYear = document.getElementById("end-year").value;
	*/
	
	// Build URL parameter string for PHP script
	
	//var phpVars = "?teamNames="+teamNamesJSON+ "&wonLost="+ wonLost+ "&roof="+roof +"&surface="+surface +"&spread="
	//							+ spread +"&overUnder="+ overUnder+ "&start="+startWeek +"&end="+endWeek +"&startYear="+startYear +"&endYear="+endYear;
	
	
	// Loader GIF
	//document.getElementById("output-table").innerHTML = "<img src=\"img/loader-red.gif\" />";
	var xhttp = new XMLHttpRequest();
	
	// False = synchronous call to Ajax making Javascript wait to continue. Otherwise, sortable will execute before table loads.
	xhttp.open("POST", url, false);	
	
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) 
		{
			document.getElementById("output-table").innerHTML = this.responseText;
		}
	};
	
	//var params = "lorem=ipsum&test=binny";
	var params = $("#game-form").serialize();
	
	// Send the proper header information along with the request
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.setRequestHeader("Content-length", params.length);
	xhttp.setRequestHeader("Connection", "close");

	xhttp.send(params);
	
	
	//var outputTable = document.getElementById("output-table");
	//sorttable.makeSortable(outputTable);
}
