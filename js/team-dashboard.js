/*
 * Javascript Functions for the Team Dashboard
 */

$(document).ready(function()
{
	//setRankColors();
	

});
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

//.navbar-header a, .navbar-right a

function setPageColor(arr)
{
	// Top Nav Color
	var topNav = document.getElementsByClassName('navbar-fixed-top');
	$(topNav[0]).css('background-color', "#"+ arr[0]['TopNavColor']);
	
	// Top Nav Left Text
	var topNavLeft = document.getElementsByClassName('navbar-header');
	$(topNavLeft[0]).css('color', "#"+ arr[0]['TopNavText']);
	
	// Top Nav Right Text
	var topNavRight = document.getElementsByClassName('navbar-right');
	$(topNavRight[0]).css('color', "#"+ arr[0]['TopNavText']);
	
	// Side Bar Color
	var elements = document.getElementsByClassName("side-nav");
	var sideNav = elements[0];
	$(sideNav).css('background-color', "#"+ arr[0]['SideNavColor']);
	
	// Side Bar Link Text
	var sideNav = document.getElementsByClassName("side-nav");
	$(sideNav[0]).css('color', "#"+ arr[0]['SideNavText']);
	var teamLinks = document.getElementsByClassName("team-link");
	$(teamLinks).css('color', "#"+ arr[0]['SideNavText']);
}

/**
 * Set the page color to match Team 
 */
function setPageColorOLD(primaryColor, secondaryColor)
{
	secondaryColor = secondaryColor || "ffffff";
	secondaryColor = "#" + secondaryColor;
	primaryColor = "#"+ primaryColor;
	
	// Side Bar
	var elements = document.getElementsByClassName("side-nav");
	var sideNav = elements[0];
	$(sideNav).css('background-color', secondaryColor);
	//$(sideNav).css('background-color', 'black');
	
	// Change color of top nav
	var topNav = document.getElementsByClassName('navbar-fixed-top');
	$(topNav[0]).css('background-color', primaryColor);
	//$(topNav[0]).css('background-color', '#FFB612');
	
	
	// Change color of anchor tags in sidebar		
	var sideNav = document.getElementsByClassName("side-nav");
	$(sideNav[0]).css('color', primaryColor);
	//$(sideNav[0]).css('color', '#FFB612');
	
	
	// Change color of text in team dashboard links (they are buttons)
	var teamLinks = document.getElementsByClassName("team-link");
	$(teamLinks).css('color', primaryColor);
	//$(teamLinks).css('color', '#FFB612');
	
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
