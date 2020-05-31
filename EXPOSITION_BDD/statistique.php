<?php
    //
    require_once "App/DB.php";
    require_once "App/class/Statistique.php";
    require_once "App/models/StatistiqueModel.php";

    //
    $statistiqueModel = new StatistiqueModel();
    $data_expo_annee = $statistiqueModel->getCountExpositionByAnnee();
    $data_expo_jours = $statistiqueModel->getNbJourByExposition();
    $data_exp_organisation = $statistiqueModel->getCountExpositionByOrganisation();
    $data_expo_arrivee =$statistiqueModel->getNbArriveeByExposition();


    // var_dump($data_expo_arrivee);
?>
<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> expositions </title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
<style>
    .chart {
        width: 1000px;
        height: 500px;
        -webkit-box-shadow: 4px 4px 15px -3px rgba(0,0,0,0.39);
        -moz-box-shadow: 4px 4px 15px -3px rgba(0,0,0,0.39);
        box-shadow: 4px 4px 15px -3px rgba(0,0,0,0.39);
        border-radius: 4px;
        margin: 10px;
        float: left;
        position: relative;
    }
</style>

<a class="skip-link screen-reader-text" href="#content">Skip to content</a>
<div class="outer-wrap">
    <header class="masthead">
        <div class="centered">
            <div class="site-branding">
                <h1 class="site-title"> Expositions Musée de Bretagne et Les Champs Libres</h1>
            </div><!-- .site-title -->
        </div><!-- .centered -->
        <div class="nav-mixed menu container">
            <nav id="multi-level-nav" class="multi-level-nav" role="navigation">
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="expositionlist.php">Exposition</a></li>
                    <li><a href="statistique.php">Statistique</a></li>
            </nav><!-- #multi-level-nav .multi-level-nav -->
        </div><!-- .mixed-menu -->
        <div>
    </header><!-- .masthead -->


    <div class="container">

        <div id="chart1" class="chart"></div>
        <div id="chart2" class="chart"></div>

        <div id="chart5" class="chart"></div>
        <div id="chart6" class="chart"></div>

    </div>



    <footer class="footer-area">
        <p>Le pied de page</p>
    </footer>

</div><!-- .outer-wrap -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<script src="https://www.amcharts.com/lib/3/xy.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script>



    /**
     * Initialize a chart update queue
     */
    AmCharts.updateQueue = [];
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
     * Generates data $data_expo_jours
     */
    function generateData1() {
        var data = [];

            <?php
            foreach ($data_expo_jours as $data):
            ?>
                data.push({
                    "country":  "<?= $data->abscisse ?>",
                    "visits": <?= $data->ordonnee ?>
                });
            <?php
            endforeach;
            ?>

        return data;
    }


    /**
     * Generates data $data_expo_arrivee
     */
    function generateData2() {
        var data = [];

        <?php
        foreach ($data_expo_arrivee as $data):
        ?>
        data.push({
            "country":  "<?= $data->abscisse ?>",
            "visits": <?= $data->ordonnee ?>
        });
        <?php
        endforeach;
        ?>

        return data;
    }

    /**
     * Generates data $data_expo_annee
     */
    function generateData3() {
        var data = [];

        <?php
        foreach ($data_expo_annee as $data):
        ?>
        data.push({
            "country":  "<?= $data->abscisse ?>",
            "visits": <?= $data->ordonnee ?>
        });
        <?php
        endforeach;
        ?>

        return data;
    }

    /**
     * Generates data $data_exp_organisation
     */
    function generateData4() {
        var data = [];

        <?php
        foreach ($data_exp_organisation as $data):
        ?>
        data.push({
            "country":  "<?= $data->abscisse ?>",
            "visits": <?= $data->ordonnee ?>
        });
        <?php
        endforeach;
        ?>

        return data;
    }


    /**
     * Chart 1
     */
    AmCharts.makeChart("chart1", {
        "type": "serial",
        "theme": "light",
        "dataProvider": generateData1(),
        "titles": [{
            "text": "Durée(Jour) d'une exposition"
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
            "labelsEnabled": true
        }],
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 45
        }
    });

    /**
     * Chart 2
     */
    AmCharts.makeChart("chart2", {
        "type": "serial",
        "theme": "light",
        "dataProvider": generateData2(),
        "titles": [{
            "text": "Nombres arrivée par exposition"
        }],
        "startDuration": 1.5,
        "graphs": [{
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "visits"
        }],
        "categoryField": "country",
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 45
        },
        "valueAxes": [{
            "labelsEnabled": true
        }]
    });

    /**
     * Chart 5
     */
    AmCharts.makeChart("chart5", {
        "type": "pie",
        "theme": "light",
        "dataProvider": generateData3(),
        "titles": [{
            "text": "Nombre d'exposition par année "
        }],
        "valueField": "visits",
        "titleField": "country",
        "pullOutRadius": 0
    });

    /**
     * Chart 4
     */
    AmCharts.makeChart("chart6", {
        "type": "pie",
        "theme": "light",
        "dataProvider": generateData4(),
        "titles": [{
            "text": "Nombre d'exposition par organisateur "
        }],
        "valueField": "visits",
        "titleField": "country",
        "pullOutRadius": 0
    });

</script>

</body>

</html>