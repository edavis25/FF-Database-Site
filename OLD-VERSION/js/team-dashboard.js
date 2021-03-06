/*
 * Javascript Functions for the Team Dashboard
 */


function yardsBarChart(arr) 
{
	Highcharts.chart('yards-bar-chart', {
		chart : {
			type : 'bar'
		},
		title : {

			text : ''
		},
		subtitle : {
			text : ''
		},
		xAxis : {
			categories : ['Pass<br />Yards', 'Rush<br />Yards'],
			title : {
				text : null
			}
		},
		yAxis : {
			min : 0,
			title : {
				text : 'Total Yards',
				align : 'high'
			},
			labels : {
				overflow : 'justify'
			}
		},
		tooltip : {
			valueSuffix : ''
		},
		plotOptions : {
			bar : {
				dataLabels : {
					enabled : true
				}
			}
		},
		credits : {
			enabled : false
		},
		series : [{
			showInLegend: false,
			name : 'Earned',
			data : [parseInt(arr['PassEarned']), parseInt(arr['RushEarned'])],
			color: '#00ba31'
		}, {
			showInLegend: false,
			name : 'Allowed',
			data : [parseInt(arr['PassAllowed']), parseInt(arr['RushAllowed'])],
			color: '#dc030d'
		}]
	});
}


function pointsBarChart(arr) 
{
	Highcharts.chart('points-bar-chart', {
		chart : {
			type : 'bar'
		},
		title : {

			text : ''
		},
		subtitle : {
			text : ''
		},
		xAxis : {
			categories : ['Points<br />Scored'],
			title : {
				text : null
			}
		},
		yAxis : {
			min : 0,
			title : {
				text : 'Total Points',
				align : 'high'
			},
			labels : {
				overflow : 'justify'
			}
		},
		tooltip : {
			valueSuffix : ''
		},
		plotOptions : {
			bar : {
				dataLabels : {
					enabled : true
				}
			}
		},
		legend : {
			margin: -15
		},
		credits : {
			enabled : false
		},
		series : [{
			//showInLegend: false,
			name : 'For',
			data : [parseInt(arr[0])],
			color: '#00ba31'
		}, {
			//showInLegend: false,
			name : 'Against',
			data : [parseInt(arr[1])],
			color: '#dc030d'
		}]
	});
}

function yardsBarChartOLD(arr)
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
			t: 0,
    		pad: 2
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


function showGauge(value, id, title)
{
	var gg1 = new JustGage
	({
   		id: id,
   		value : value,
  		min: 0,
  		max: 100,
   		decimals: 1,
   		gaugeWidthScale: 1.1,
  		title: title,
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

/**
 *REPLACED 
 */
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
 * Set team page theme. Configure the colors of the navigation bars unique for each team based on DB data.
 * @param {Array} arr - Associative array containing the team's hex values/URLs from the DB  
 */
function setTeamTheme(arr)
{
	// Top navbar color
	$('.navbar-fixed-top').css('background-color', "#"+ arr[0]['TopNavColor']);
	
	// Top navbar left hand text color
	$('.navbar-header').css('color', "#"+ arr[0]['TopNavText']);
	
	// Top navbar right hand text color
	$('.navbar-right').css('color', "#"+ arr[0]['TopNavText']);
	
	// Side navbar border color	
	$(".side-nav").css('border-color', '#'+ arr[0]['SecondaryColor']);
	$(".side-nav").css('border-right', '1px solid #'+arr[0]['SecondaryColor']);
	
	// Side navbar main anchor links text
	$('.side-nav').css('color', "#"+ arr[0]['SideNavText']);
	
	// Side navbar team name dashboard links (these are buttons)
	$('.team-link').css('color', "#"+ arr[0]['SideNavText']);
	
	// Set team logo image
	var img = document.getElementById("team-logo").src= arr[0]['LogoURL'];
	
	// Set active tab background color
	$("#dashboard").css('background-color', "#"+ arr[0]['TopNavColor'], '!important');
	
	// Set active tab text color (the <a> text inherits the color given to the <li> active container class)
	var active = document.getElementsByClassName("active-container");
	$(active[1]).css('color', "#"+ arr[0]['TopNavText'], '!important');
	
	// Add a new style class for anchor hovers (only way I could figure out how to change hover color)
	$("<style type='text/css'> a:hover { background-color: #"+ arr[0]['TopNavColor'] +" !important; color: #"+ arr[0]['TopNavText'] +" !important;} </style>").appendTo("head");
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
