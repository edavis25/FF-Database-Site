
/**
 * This function is called from the custom query submit button onclick event. 
 */
function runQuery(url, formID) {

	// Show Loader GIF
	$("#load").show();
	
	//document.getElementById("output-table").innerHTML = "<img src=\"img/loader-red.gif\" />";
	var xhttp = new XMLHttpRequest();
	
	// False = synchronous call to Ajax making Javascript wait to continue. Otherwise, sortable will execute before table loads.
	xhttp.open("POST", url, false);	
	
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) 
		{
			document.getElementById("output-table-div").innerHTML = this.responseText;
		}
	};
	
	var params = $("#"+formID).serialize();
	
	// Send the proper header information along with the request
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.setRequestHeader("Content-length", params.length);
	xhttp.setRequestHeader("Connection", "close");

	xhttp.send(params);
	
	// Hide loader GIF
	$("#load").hide();
	
	//var outputTable = document.getElementById("output-table");
	//sorttable.makeSortable(outputTable);
}

/**
 * Populate a dropdown box w/ values related to another dropdown box. Used to populate the ending year/week form inputs in custom queries.
 * @param {String} startID - HTML element ID for the related dropdown box (the starting values)
 * @param {String} endID - HTML element ID for the dropdown box being populated
 * @param {String} allVal - Value from the starting box input that means select all. (When this option is selected, ending box will be disabled - all values desired)
 * @param {Integer} maxIndex - Stopping index for the dynamically populated end box (how many items should be created)
 * @param {Boolean} descending - Flag to populate the elements in the ending dropdown in ascending or descending
 */
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

/**
 * Get table data as a CSV formatted string
 * @param {String} id - HTML element ID for the table to be exported
 * @return {String} - Table data formatted as a CSV string
 */
function tableAsCsv(id) {
  // Make sure table exists and contains at least 1 row
  if (!document.getElementById(id) || document.getElementById(id).rows.length == 0) {
    return;
  }
		
  // Get reference to table & number of rows
  var tbl = document.getElementById(id);
  var numRows = tbl.rows.length;
		
  // Iterate table and build formatted csv string
  var result = '';
  for (var i = 0; i < numRows; i++) {
    for (var j = 0; j < tbl.rows[i].cells.length; j++) {
      result += decodeHtml(tbl.rows[i].cells[j].innerHTML);
      result += ",";
    }
    result += "\n";
  }
  
  return result;
}

/**
 * !!!!! REPLACED WITH FileSaver.js LIBRARY !!!!!
 * 
 * Save a string to .CSV file using a blob
 * @param {Object} str - Formatted CSV string
 * @param {Object} fileName - Download file name (DO NOT ADD FILE EXTENSION)
 */
function saveStringToCsvFile(str, fileName) {
	// Create blob with string data
	var blob = new Blob([str], {type:"text/csv"});
	// Give blob a url for download
	var url = window.URL.createObjectURL(blob);
	
	// Create a temporary anchor element & add attributes
	var temp = document.createElement("a");
	temp.download = fileName + ".csv"; // Add extension here because thats what Edge likes even though given filename won't be used...
	temp.href = url;
	
	// Add link and click it
	document.body.appendChild(temp);
	temp.click();
	
	// Remove temp anchor
	window.URL.revokeObjectURL(url);
	document.body.remove(temp);
} 

/**
 * Decode HTML entities for CSV export
 * Snippet from: http://stackoverflow.com/questions/7394748/whats-the-right-way-to-decode-a-string-that-has-special-html-entities-in-it?lq=1
 * @param {HTML} html - HTML to be decoded
 */
function decodeHtml(html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
}


function clearForm(className)
{
	// Reset form
	$("."+className).trigger("reset");
		
	// Clear and disable select boxes
	$(".disable-on-clear option").each(function(index, option)
	{
		$(option).remove();
	});
		
	$(".disable-on-clear").attr("disabled", "disabled");
}