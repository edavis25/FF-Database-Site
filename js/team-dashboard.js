/*
 * Javascript Functions for the Team Dashboard
 */

$(document).ready(function()
{
	//setRankColors();
	

});


function yardsBarChart(arr)
{
	
	var rushTrace = 
	{
		x: [arr['RushEarned']],
		y: ['Rush YDs'],
		orientation: 'h',
		marker: 
		{
			color: '#03a81c'
		},
		type: 'bar',
		showlegend: false
	};
	var rushAllowTrace = 
	{
		x: [arr['RushAllowed']],
		y: ['Rush YDs\nAllowed'],
		orientation: 'h',
		marker:
		{
			color: '#b71500'
		},
		type: 'bar',
		showlegend: false
	};
	
	var passTrace =
	{
		x: [arr['PassEarned']],
		y: ['PassYDs'],
		orientation: 'h',
		marker:
		{
			color: '#03a81c'
		},
		type: 'bar',
		showlegend: false
	};
		
	var passAllowTrace = 
	{
		x: [arr['PassAllowed']],
		y: ['Pass YDs\nAllowed'],
		orientation: 'h',
		marker:
		{
			color: '#b71500'
		},
		type: 'bar',
		showlegend: false
	};
	var data = [rushAllowTrace, rushTrace, passAllowTrace, passTrace];
	var layout = 
	{
		// Margin removes empy chart title space
		margin: 
		{
			t: 45,
    		pad: 4
  		},
		barmode: 'stack'
	};
	Plotly.newPlot('yards-bar-chart', data, layout);
	
}



function timelapseChart()
{
	timelapse = document.getElementById('timelapse-chart');
		Plotly.plot( timelapse, [{
		x: [1, 2, 3, 4, 5],
		y: [1, 2, 4, 8, 16] }], {
		margin: { t: 0 } } );
		
		Plotly.plot( timelapse, [{
		x: [1, 2, 3, 4, 5],
		y: [3, 2, 3, 2, 8] }], {
		margin: { t: 0 } } );
		
		Plotly.plot( timelapse, [{
		x: [1, 2, 3, 4, 5],
		y: [11, 6, 8, 12, 8] }], {
		margin: { t: 0 } } );
}


function winLossGauge(win, loss)
{
	try
	{
		win = parseInt(win);
		loss = parseInt(loss);
		var percent = (win / (win + loss)) * 100;
		
		var gg1 = new JustGage
		({
      		id: "win-loss-gauge",
      		value : percent,
      		min: 0,
      		max: 100,
      		decimals: 1,
      		gaugeWidthScale: 1.1,
      		title: 'W/L %',
      		customSectors: 
      		[{
        		color : "#dc030d",
        		lo : 0,
        		hi : 35
      		},
      		{
      			color: "#ff6c0a",
      			lo: 35,
      			hi: 45
      		},
      		{
        		color : "#ffdf02",
        		lo : 45,
        		hi : 55
      		},
		      
      		{
      			color : "#00ba31",
      			lo : 55,
      			hi : 100
      		}],
      		counter: true
    		});
	}
	catch (e)
	{
		alert("ERROR: Win/Loss Parse Error. team-dashboard.js");
	}
}

/**
 * Set the league ranking colors on green-red scale 
 */
function setRankColors()
{
	var elements = document.getElementsByClassName("ranking-value");
	for (var i = 0, end = elements.length; i < end; i++)
	{
		// Parse rank as integer
		var parsed = parseInt(elements[i].innerHTML);
		// Set colors for rank (4 colors, 8 teams per color)
		if (parsed <= 8)
		{
			$(elements[i]).addClass("rank-color-green");
		}
		else if (parsed <= 16)
		{
			$(elements[i]).addClass("rank-color-yellow");
		}
		else if (parsed <= 24)
		{
			$(elements[i]).addClass("rank-color-orange");
		}
		else
		{
			$(elements[i]).addClass("rank-color-red");
		}
	}
}
