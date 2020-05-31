/**
 * Initialize a chart update queue
 */
AmCharts.updateQueue = [];

console.log(AmCharts)
/**
 * Queues data update for the chart
 */
AmCharts.queueDataUpdate = function(chart, data) {

    for (var i = 0; i < AmCharts.updateQueue; i++) {
        if (AmCharts.updateQueue[i].chart = chart) {
            AmCharts.updateQueue[i].data = data
            return;
        }
    }

    // insert into queue
    AmCharts.updateQueue.push({
        "chart": chart,
        "data": data
    });

    // process next item
    AmCharts.processUpdateQueue();
};


/**
 * Updates the next chart in queue
 */
AmCharts.processUpdateQueue = function() {
    if (AmCharts.updateQueue.length) {
        var item = AmCharts.updateQueue.shift();
        item.chart.dataProvider = item.data;
        item.chart.validateData();
    }
};


/**
 * Add handlers dataUpdated handlers for each chart
 */
AmCharts.addInitHandler(function(chart) {

    chart.addListener("dataUpdated", function() {
        // process the next update in queue
        AmCharts.processUpdateQueue();
    })

}, ["serial", "pie", "xy"]);


/**
 * Set up interval to update charts at 2 second intervals
 */
setInterval(function() {

    for(var i = 0; i < AmCharts.charts.length; i++) {
        AmCharts.queueDataUpdate(AmCharts.charts[i], generateData());
    }

}, 2000);

/**
 * Generates random sample data
 */
function generateData() {
    var data = [];
    for (var i = 1; i <= 5; i++) {
        data.push({
            "country": i,
            "visits": Math.ceil(Math.random() * 2000 + 500)
        });
    }
    return data;
}

/**
 * Chart 1
 */
AmCharts.makeChart("chart1", {
    "type": "serial",
    "theme": "light",
    "dataProvider": generateData(),
    "titles": [{
        "text": "Chart #1"
    }],
    "startDuration": 1.5,
    "graphs": [{
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "type": "column",
        "valueField": "visits"
    }],
    "categoryField": "country",
    "valueAxes": [{
        "labelsEnabled": false
    }],
    "categoryAxis": {
        "minHorizontalGap": 5
    }
});

/**
 * Chart 2
 */
AmCharts.makeChart("chart2", {
    "type": "serial",
    "theme": "light",
    "dataProvider": generateData(),
    "titles": [{
        "text": "Chart #2"
    }],
    "startDuration": 1.5,
    "graphs": [{
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "type": "column",
        "valueField": "visits"
    }],
    "categoryField": "country",
    "valueAxes": [{
        "labelsEnabled": false
    }],
    "categoryAxis": {
        "minHorizontalGap": 5
    }
});

/**
 * Chart 5
 */
AmCharts.makeChart("chart5", {
    "type": "pie",
    "theme": "light",
    "dataProvider": generateData(),
    "titles": [{
        "text": "Chart #5"
    }],
    "valueField": "visits",
    "titleField": "country",
    "pullOutRadius": 0,
    "labelRadius": -22,
    "labelText": "[[percents]]%",
    "percentPrecision": 1
});

/**
 * Chart 6
 */
AmCharts.makeChart("chart6", {
    "type": "pie",
    "theme": "light",
    "dataProvider": generateData(),
    "titles": [{
        "text": "Chart #6"
    }],
    "valueField": "visits",
    "titleField": "country",
    "pullOutRadius": 0,
    "labelRadius": -22,
    "labelText": "[[percents]]%",
    "percentPrecision": 1
});

/**
 * Chart 9
 */
AmCharts.makeChart("chart9", {
    "type": "xy",
    "theme": "light",
    "dataProvider": generateData(),
    "titles": [{
        "text": "Chart #9"
    }],
    "valueAxes": [{
        "position": "bottom"
    }, {
        "minMaxMultiplier": 1.2,
        "position": "left",
        "labelsEnabled": false
    }],
    "startDuration": 1.5,
    "graphs": [{
        "bullet": "circle",
        "bulletBorderAlpha": 0.2,
        "bulletAlpha": 0.8,
        "lineAlpha": 0,
        "fillAlphas": 0,
        "xField": "country",
        "yField": "visits",
        "maxBulletSize": 100
    }]
});

/**
 * Chart 10
 */
AmCharts.makeChart("chart10", {
    "type": "xy",
    "theme": "light",
    "dataProvider": generateData(),
    "titles": [{
        "text": "Chart #10"
    }],
    "valueAxes": [{
        "position": "bottom"
    }, {
        "minMaxMultiplier": 1.2,
        "position": "left",
        "labelsEnabled": false
    }],
    "startDuration": 1.5,
    "graphs": [{
        "bullet": "circle",
        "bulletBorderAlpha": 0.2,
        "bulletAlpha": 0.8,
        "lineAlpha": 0,
        "fillAlphas": 0,
        "xField": "country",
        "yField": "visits",
        "maxBulletSize": 100
    }]
});

