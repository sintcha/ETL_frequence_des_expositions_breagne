<?php
    require_once "App/models/Model.php";
    require_once "App/models/SalleModel.php";
    require_once "App/models/OrganisateurModel.php";
    require_once "App/models/ExpositionModel.php";
    $salleModel = new SalleModel();
    $salles = $salleModel->all();
    $organisateurModel = new OrganisateurModel();
    $organisateurs = $organisateurModel->all();
    //var_dump($organisateurs);
    //die();
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
        <div class="p-5 row justify-content-center">
            <div class="col-9">
                <h3> Enregister une nouvelle exposition</h3><br>

                <?php
                    // Lorsque le boutton enregistrer est cliqué
                    if(isset($_POST['soumettre'])){
                        var_dump($_POST);
                        $nom_expo = htmlspecialchars($_POST['titre']);
                        $description_expo = htmlspecialchars($_POST['description']);
                        $nom_organisateur = htmlspecialchars($_POST['organisateur']);
                        // Check if any option is selected

                        $date_debut_expo= htmlspecialchars($_POST['date_debut']);
                        $date_fin_expo= htmlspecialchars($_POST['date_fin']);

                        $errors = [];

                        // Validation
                        if(empty($nom_expo) || (strlen($nom_expo) < 3  && strlen($nom_expo) > 255)){
                            $errors["titre"] = "Le nom de l'exposition est incorrecte !";
                        }

                        if(empty($nom_organisateur) || strlen($nom_organisateur) < 3){
                            $errors["organisateur"] = "L'organisateur est mal spécifié !";
                        }
                        if(isset($_POST["salles"]))
                        {
                            $salles = $_POST["salles"];
                        }
                        else{
                            $errors["salles"] = "La salle est mal spécifié !";
                        }

                        if(empty($description_expo) || (strlen($description_expo) < 3 && strlen($description_expo) > 500)){
                            $errors["description"] = "Le champs description est incorrecte !";
                        }

                        // Si notre formulaire est correct
                        if(count($errors) == 0) {
                            // On cree l expo
                            $expositionModel = new ExpositionModel();
                            $expo = [
                                    "nom_exposition"=> $nom_expo,
                                    "descriptif_exposition"=> $description_expo,
                                    "date_debut_d_exposition"=> $date_debut_expo,
                                    "date_fin_d_exposition"=> $date_fin_expo,
                                    "nom_organisateur"=> $nom_organisateur,
                                ];
                            $expoCreated = $expositionModel->insert($expo);
                            // On cree les salle_expo

                        }
                    }
                ?>

                <form class="p-2 needs-validation" method="post" action="." novalidate>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Titre</label>
                            <input type="text" name="titre" class="form-control" id="validationCustom01" value="" required>
                            <div class="invalid-feedback">
                                Please enter an exhibition title.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom05">Organisateur</label>
                            <select class="custom-select" name="organisateur"  id="validationCustom04" required>
                                <option selected disabled value="">Choose...</option>
                                <?php
                                foreach ($organisateurs as $organisateur):
                                    ?>
                                    <option value="<?= $organisateur->nom_organisateur ?>"><?= $organisateur->nom_organisateur ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid organisation.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom04">Salle</label>
                            <select class="custom-select" name="salles[]" id="validationCustom04" multiple required>
                                <option selected disabled value="">Choose...</option>
                                <?php
                                foreach ($salles as $salle):
                                    ?>
                                    <option value="<?= $salle->nom_salle ?>"><?= $salle->nom_salle ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid salle.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">Date de début</label>
                            <input type="date" name="date_debut" class="form-control" id="validationCustom02" value="" required>
                            <div class="invalid-feedback">
                                Please enter a start date.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustomUsername">Date de fin</label>
                            <input type="date"  name="date_fin"  class="form-control" id="validationCustomUsername"  required>
                            <div class="invalid-feedback">
                                Please enter a end date.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="validationCustom03">Descriptif</label>
                        <textarea name="description" class="form-control" id="validationCustom03" required></textarea>
                        <div class="invalid-feedback">
                            Description is required.
                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-center">
                        <button class="btn btn-dark btn-lg" name="soumettre" type="submit">ENREGISTRER</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

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