/*
 * Set turnover margin title red/green based on value
 */
function setColor(num) {
	return num >= 0 ? '#00ba31' : '#dc030d';
}

/*
 * Return turnover margin title as string with plus and minus signs
 */
function setTitle(num) {
	return (num > 0) ? "+" + num : "" + num;
}

function showTurnoversPieChart(arr) {
	var intLost = parseInt(arr[0]['NegInt']);
	var intGained = parseInt(arr[0]['PlusInt']);
	var fumLost = parseInt(arr[0]['NegFum']);
	var fumGained = parseInt(arr[0]['PlusFum']);

	// Create color array
	var colors = {
		'red' : '#dc030d',
		'green' : '#00ba31'
	},
	categories = ['Turnovers<br />Lost', 'Turnovers<br />Gained'],

	// Data plot for turnovers lost
	data = [{
		y : intLost + fumLost,
		color : colors['red'],
		drilldown : {
			name : 'Turnover Type',
			categories : ['Interception', 'Fumble'],
			data : [intLost, fumLost]
		}
	},
	// Data plot for turnovers gained
	{
		y : intGained + fumGained,
		color : colors['green'],
		drilldown : {
			name : 'Turnovers Type',
			categories : ['Interception', 'Fumble'],
			data : [intGained, fumGained]
		}
	}],
	turnovers = [],
	turnoverType = [],
	i,
	j,
	dataLen = data.length,
	drillDataLen,
	brightness;

	// Build the data arrays
	for ( i = 0; i < dataLen; i += 1) {
		// add inner pie data
		turnovers.push({
			name : categories[i],
			y : data[i].y,
			color : data[i].color
		});

		// add outer pie data
		drillDataLen = data[i].drilldown.data.length;
		for ( j = 0; j < drillDataLen; j += 1) {
			brightness = 0.2 - (j / drillDataLen) / 5;
			turnoverType.push({
				name : data[i].drilldown.categories[j],
				y : data[i].drilldown.data[j],
				color : Highcharts.Color(data[i].color).brighten(brightness).get()
			});
		}
	}

	// Create the chart (name of div)
	Highcharts.chart('turnovers-pie-chart', {
		chart : {
			type : 'pie'
		},
		title : {
			text : 'Total Turnover Margin'
		},
		subtitle : {
			text : setTitle(((intGained + fumGained) - (intLost + fumLost))),
			floating : true,
			style : {
				'fontSize' : '35px',
				'color' : setColor(((intGained + fumGained) - (intLost + fumLost)))
			}
		},
		yAxis : {
			title : {
				text : 'Total turnover margin'
			}
		},
		plotOptions : {
			pie : {
				shadow : false,
				center : ['50%', '50%']
			}
		},
		tooltip : {
			//valueSuffix : '$'
		},
		// Inner pie
		series : [{
			name : 'Total',
			data : turnovers,
			size : '80%',
			dataLabels : {
				// Inner hover label
				formatter : function() {
					return this.y > 1 ? this.point.name : null;
				},
				color : '#ffffff',
				distance : -80,
				backgroundColor : "rgba(0,0,0,0.1)",
				style : {
					"fontSize" : "12px",
					"textOutline" : "0px"
				}
			}
		},
		// Outer pie
		{
			name : ' ',
			data : turnoverType,
			size : '80%',
			innerSize : '70%',
			// Outer labels
			dataLabels : {
				formatter : function() {
					// display only if larger than 1
					return this.y > 1 ? '<b>' + this.point.name + ':</b> ' + this.y : null;
				}
			}
		}]
	});
} 