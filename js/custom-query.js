
/**
 * This function is called from the custom query submit button onclick event. 
 */
function gameInfoQuery(url) {

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
	
	var params = $("#game-form").serialize();
	
	// Send the proper header information along with the request
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.setRequestHeader("Content-length", params.length);
	xhttp.setRequestHeader("Connection", "close");

	xhttp.send(params);
	
	
	//var outputTable = document.getElementById("output-table");
	//sorttable.makeSortable(outputTable);
}


function populateEndBox(startID, endID, allVal, maxIndex, descending)
{
	// Clear end box each time a value is changed
	document.getElementById(endID).options.length = 0;
	var startValue = document.getElementById(startID).value;
	
	// If select box option for all is chosen
	if (startValue == allVal)
	{
		$("#"+endID).attr('disabled', 'disabled');
	}
	else
	{
		$("#"+endID).removeAttr('disabled');
		
		var startOptions = document.getElementById(startID).options;
		var endElement = document.getElementById(endID);
		var maxValue = parseInt(document.getElementById(startID).options[maxIndex].value);
		
		if (descending)
		{
			var selectedIndex = document.getElementById(startID).selectedIndex;
			
			while (selectedIndex >= maxIndex)
			{
				var option = document.createElement("option");
				option.value = parseFloat(startOptions[selectedIndex].value) +1; // Parse and add 1 so end cannot equal start
				option.text = parseFloat(startOptions[selectedIndex].text) +1;
				endElement.add(option);
				selectedIndex--;
			}
		}
		else
		{
			var selectedIndex = document.getElementById(startID).selectedIndex;
			while (selectedIndex <= maxIndex)
			{
				var option = document.createElement("option");
				option.value = startOptions[selectedIndex].value;
				option.text = startOptions[selectedIndex].text;
				endElement.add(option);
				selectedIndex++;
			}
		}
	}
}