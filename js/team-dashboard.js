/*
 * Javascript Functions for the Team Dashboard
 */

/**
 * Draw the yards bar chart
 * @param {AssocArray} 
 * Array must have indices: ['PassEarned'] & ['RushEarned'] & ['PassAllowed'] & ['Rush Allowed']
 */
function showYardsBarChart(arr)
{
    Highcharts.chart('yards-bar-chart', {
        chart: {
            type: 'bar'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: ['Pass<br />Yards', 'Rush<br />Yards'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Yards',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        credits: {
            enabled: false
        },
        series: [{
                showInLegend: false,
                name: 'Earned',
                data: [parseInt(arr['PassEarned']), parseInt(arr['RushEarned'])],
                color: '#00ba31'
            }, {
                showInLegend: false,
                name: 'Allowed',
                data: [parseInt(arr['PassAllowed']), parseInt(arr['RushAllowed'])],
                color: '#dc030d'
            }]
    });
}

/**
 * Draw the points bar chart
 * @param {AssocArray} 
 * Array must have indices: ['PtsFor'] & ['PtsAgst']
 */
function showPointsBarChart(arr)
{
    var ptsFor = parseInt(arr['PtsFor']);
    var ptsAgst = parseInt(arr['PtsAgst']);
 
    Highcharts.chart('points-bar-chart', {
        chart: {
            type: 'bar'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: ['Points<br />Scored'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Points',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            margin: -15
        },
        credits: {
            enabled: false
        },
        series: [{
                //showInLegend: false,
                name: 'For',
                data: [ptsFor],
                color: '#00ba31'
            }, {
                //showInLegend: false,
                name: 'Against',
                data: [ptsAgst],
                color: '#dc030d'
            }]
    });
}


function timelapseChart()
{
    timelapse = document.getElementById('timelapse-chart');
    Plotly.plot(timelapse, [{
            x: [1, 2, 3, 4, 5],
            y: [1, 2, 4, 8, 16]}], {
        margin: {t: 0}});

    Plotly.plot(timelapse, [{
            x: [1, 2, 3, 4, 5],
            y: [3, 2, 3, 2, 8]}], {
        margin: {t: 0}});

    Plotly.plot(timelapse, [{
            x: [1, 2, 3, 4, 5],
            y: [11, 6, 8, 12, 8]}], {
        margin: {t: 0}});
}

/**
 * Show different 0-100% gauges (just-gauge plugin)
 * @param {Number} value - Percentage between 0-100% to display on gauge
 * @param {String} id - HTML element ID for placing gauge
 * @param {String} title - Title for the gauge
 */
function showGauge(value, id, title)
{
    var gg1 = new JustGage
        ({
            id: id,
            value: value,
            min: 0,
            max: 100,
            decimals: 1,
            gaugeWidthScale: 1.1,
            title: title,
            customSectors:
                [{
                    color: "#dc030d",
                    lo: 0,
                    hi: 35
                },
                {
                    color: "#ff6c0a",
                    lo: 35,
                    hi: 45
                },
                {
                    color: "#ffdf02",
                    lo: 45,
                    hi: 55
                },
                {
                    color: "#00ba31",
                    lo: 55,
                    hi: 100
                }],
            counter: true
        });
}


/**
 * Set team page theme. Configure the colors of the navigation bars unique for each team based on DB data.
 * @param {Array} arr - Associative array containing the team's hex values/URLs from the DB
 * @param {String} baseURL - Base site URL used to find images
 */
function setTeamTheme(arr, baseURL)
{
    // NOTE: Array indices = DB column names
    
    // Top navbar color
    $('.navbar-fixed-top').css('background-color', "#" + arr['TopNavColor']);

    // Top navbar left-hand text color
    $('.navbar-header').css('color', "#" + arr['TopNavText']);

    // Top navbar right-hand text color
    $('.navbar-right').css('color', "#" + arr['TopNavText']);

    // Side navbar border color	
    //$(".side-nav").css('border-color', '#' + arr['SecondaryColor']);
    $(".side-nav").css('border-right', '1px solid #' + arr['SecondaryColor']);

    // Side navbar main anchor links text
    $('.side-nav').css('color', "#" + arr['SideNavText']);

    // Side navbar team name dashboard links (these are buttons)
    $('.team-link').css('color', "#" + arr['SideNavText']);

    // Set team logo image
    var img = document.getElementById("team-logo").src = baseURL + arr['LogoURL'];

    // Set active tab background color
    $("#dashboard").css('background-color', "#" + arr['TopNavColor'], '!important');

    // Set active tab text color (the <a> text inherits the color given to the <li> active container class)
    var active = document.getElementsByClassName("active-container");
    $(active[1]).css('color', "#" + arr['TopNavText'], '!important');

    // Add a new style class for anchor hovers (only way I could figure out how to change hover color)
    $("<style type='text/css'> a:hover { background-color: #" + arr['TopNavColor'] + " !important; color: #" + arr['TopNavText'] + " !important;} </style>").appendTo("head");
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
        } else if (parsed <= 16)
        {
            $(elements[i]).addClass("rank-color-yellow");
        } else if (parsed <= 24)
        {
            $(elements[i]).addClass("rank-color-orange");
        } else
        {
            $(elements[i]).addClass("rank-color-red");
        }
    }
}


/*********************************************
 * TIMELAPSE LINE CHART
 *********************************************/
function makeDataArr(arr, colName) {
    var result = [];
    for (var i = 0; i < arr.length; i++)
    {
        result.push(parseFloat(arr[i][colName]));
    }
    return result;
    
}

function showTimelapseChart(arr) {
    
    var weeks = arr.length;
    //var passYdsArr = makeDataArr(arr, 'PassYds');
    var rushAtt = makeDataArr(arr, 'RushAtt');
    var passAtt = makeDataArr(arr, 'PassAtt');
    var passComp = makeDataArr(arr, 'PassComp');
    var sacks = makeDataArr(arr, 'SkTaken');
    var sackYds = makeDataArr(arr, 'SkYds');
    var firstDowns = makeDataArr(arr, '1stDowns');
    var penalty = makeDataArr(arr, 'Pen');
    
    Highcharts.chart('timelapse-chart', {
        title: {
            text: 'Weekly Stats',
            x: 0 //center
        },
        subtitle: {
            text: '',
            x: 0
        },
        xAxis: {
            min: 1,
            allowDecimals: false,
            title: {
                text: "Week"
            }
        },
        yAxis: {
            title: {
                text: ''
            },
            plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
        },
        tooltip: {
            valueSuffix: ''
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [
            {
                name: 'Rush Att',
                data: rushAtt
            },
            {
                name: 'Pass Att',
                data: passAtt
            },
            {
                name: 'Pass Comp',
                data: passComp
            },
            {
                name: 'Sack Taken',
                data: sacks
            },
            {
                name: 'Sack YDs',
                data: sackYds
            },
            {
                name: 'Penalties',
                data: penalty
            },
            {
                name: '1st Downs',
                data: firstDowns
            }
            /*
             
            ,
            {
                name: '3rd Made',
                data: [4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8, 11.9, 15.2, 17.0, 16.6, 14.2]
            },
            {
                name: '3rd Att',
                data: [4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8, 11.9, 15.2, 17.0, 16.6, 14.2]
            }
            */
            ]
    });
}



/*********************************************
 * TURNOVERS PIE CHART FUNCTIONS
 *********************************************/
// Set turnover margin title red/green based on value
function setColor(num) {
	return num >= 0 ? '#00ba31' : '#dc030d';
}

// Return turnover margin title as string with plus and minus signs
function setTitle(num) {
	return (num > 0) ? "+" + num : "" + num;
}

function showTurnoversPieChart(arr) {
    // Get values from array
    var intLost = parseInt(arr['NegInt']);
    var intGained = parseInt(arr['PlusInt']);
    var fumLost = parseInt(arr['NegFum']);
    var fumGained = parseInt(arr['PlusFum']);

    // Create color array
    var colors = {
        'red': '#dc030d',
        'green': '#00ba31'
    },
            categories = ['Lost', 'Gained'],
            // Data plot for turnovers lost
            data = [{
                    y: intLost + fumLost,
                    color: colors['red'],
                    drilldown: {
                        name: 'Turnover Type',
                        categories: ['Interception', 'Fumble'],
                        data: [intLost, fumLost]
                    }
                },
                // Data plot for turnovers gained
                {
                    y: intGained + fumGained,
                    color: colors['green'],
                    drilldown: {
                        name: 'Turnovers Type',
                        categories: ['Interception', 'Fumble'],
                        data: [intGained, fumGained]
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
    for (i = 0; i < dataLen; i += 1) {
        // add inner pie data
        turnovers.push({
            name: categories[i],
            y: data[i].y,
            color: data[i].color,
            legendIndex: dataLen - i
        });

        // add outer pie data
        drillDataLen = data[i].drilldown.data.length;
        for (j = 0; j < drillDataLen; j += 1) {
            brightness = 0.2 - (j / drillDataLen) / 5;
            turnoverType.push({
                name: data[i].drilldown.categories[j],
                y: data[i].drilldown.data[j],
                color: Highcharts.Color(data[i].color).brighten(brightness).get()
            });
        }
    }

    // Create the chart (name of div)
    Highcharts.chart('turnovers-pie-chart', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Total Turnover Margin'
        },
        subtitle: {
            text: setTitle(((intGained + fumGained) - (intLost + fumLost))),
            floating: true,
            style: {
                'fontSize': '35px',
                'color': setColor(((intGained + fumGained) - (intLost + fumLost)))
            }
        },
        yAxis: {
            title: {
                text: 'Total turnover margin'
            }
        },
        plotOptions: {
            pie: {
                shadow: false,
                center: ['50%', '50%']
            }
        },
        tooltip: {
            //valueSuffix : '$'
        },
        legend: {
            floating: true
        },
        credits: {
            enabled: false
        },
        // Inner pie
        series: [{
                name: 'Total',
                data: turnovers,
                size: '80%',
                dataLabels: {
                    // Inner hover label
                    formatter: function () {
                        //return this.y > 1 ? this.point.name : null;
                        return this.y;
                    },
                    color: '#ffffff',
                    distance: -80,
                    //backgroundColor : "rgba(0,0,0,0.1)",
                    style: {
                        "fontSize": "12px",
                        "textOutline": "0px"
                    }
                },
                showInLegend: true
            },
            // Outer pie
            {
                name: ' ',
                data: turnoverType,
                size: '80%',
                innerSize: '70%',
                // Outer labels
                dataLabels: {
                    formatter: function () {
                        // display only if larger than 1
                        //return this.y > 1 ? '<b>' + this.point.name + ':</b> ' + this.y : null;
                    },
                    distance: -15,
                    style: {
                        color: "#000000",
                        textOutline: "0px"
                    }
                }
            }]
    });
}