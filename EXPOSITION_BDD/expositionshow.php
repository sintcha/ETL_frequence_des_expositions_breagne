<?php
require_once "App/models/Model.php";
require_once "App/models/ExpositionModel.php";
require_once "App/models/ArriveeModel.php";
$expositionModel = new ExpositionModel();
$exposition = null;
// Si on specifie ID
if(isset($_GET['id'])){
    $exposition = $expositionModel->find(htmlspecialchars($_GET['id']));
}

$arriveeModel = new ArriveeModel();
$count_total = 0;
$count_indiv = 0;
$count_multi= 0;


if(!is_null($exposition)){

    if(isset($_POST["solo"]) || isset($_POST["multiple"])){
        $count = 1;
        if(isset($_POST["multiple"])){
            $count = 2;
        }
        // Insert
        $arriveeModel->insert([
            "nom_exposition" => $exposition->nom_exposition,
            "nb_arrivee" => $count
        ]);
    }

    $count_total = $arriveeModel->countByCriterea(["nom_exposition" => $exposition->nom_exposition ]);
    $count_indiv = $arriveeModel->countByCriterea(["nom_exposition" => $exposition->nom_exposition, "nb_arrivee" => 1 ]);
    $count_multi = $arriveeModel->countByCriterea(["nom_exposition" => $exposition->nom_exposition, "nb_arrivee" => 2 ]);
}

?>
<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> expositions </title>
        <link rel="stylesheet" href="main.css" type="text/css" media="all">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>

    <body>
        <style>
            .inforide {
                box-shadow: 1px 2px 8px 0px #f1f1f1;
                background-color: white;
                border-radius: 8px;
                height: 125px;
                color: white !important;
            }

            .fontsty h2{
                font-size: 40px;
                margin-top: 15px;
                text-align: right;
            }

            .fontsty h4{
                font-size: 25px;
                margin-top: 20px;
                text-align: right;
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
            </header><!-- .masthead -->


            <div class="container">
                <div class="row mt-5">
                    <div class="col-12">
                        <h1><?= $exposition->nom_exposition?></h1>
                    </div>
                    <div class="col-12">
                        <span>
                        Du <b><?= $exposition->date_debut_d_exposition?></b> au
                        <b><?= $exposition->date_fin_d_exposition?></b>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <!-- Icon Cards-->
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
                        <div style="background: orange" class="inforide">
                            <div class="row">
                                <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                                    <h4>Total</h4>
                                    <h2><?= $count_total?></h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Icon Cards-->
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
                        <div style="background: cornflowerblue"  class="inforide">
                            <div class="row">
                                <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                                    <h4>Individuel</h4>
                                    <h2><?= $count_indiv?></h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Icon Cards-->
                    <div  class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
                        <div style="background: gray;"  class="inforide">
                            <div class="row">
                                <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                                    <h4>Multiple</h4>
                                    <h2><?= $count_multi ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 row">
                    <?php
                        if(is_null($exposition)):
                    ?>
                        <div class="alert alert-danger" role="alert">
                            Exposition indisponible !
                        </div>
                    <?php
                        else:
                    ?>
                        <div class="p-5">
                            <div class="row justify-content-center">
                                <h4 class="mr-5">Ajouter une :</h4>
                                <form action="" method="post" class="form flex">
                                    <button type="submit" name="solo" class="btn btn-primary btn-lg">Arrivée SOLO</button>
                                    <button type="submit" name="multiple" class="btn btn-secondary btn-lg">Arrivée multiple</button>
                                </form>
                            </div>

                        </div>

                    <?php

                        endif;
                    ?>
                </div>
            </div>

           <footer class="footer-area">
                <p>Le pied de page</p>
            </footer>

        </div><!-- .outer-wrap -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
        <script type="text/javascript" src="JS/libs/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="JS/sidebar-switcher.js"></script>
        <script type="text/javascript" src="JS/menu-toggle.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>