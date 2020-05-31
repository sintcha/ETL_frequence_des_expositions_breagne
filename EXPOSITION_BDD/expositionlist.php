 <?php
require_once "App/models/Model.php";
require_once "App/models/ExpositionModel.php";
$expositionModel = new ExpositionModel();
// Item supprimé
$deleted = false;
if(isset($_GET['delete'])){
    $deleted = $expositionModel->delete(htmlspecialchars($_GET['delete']));
}
$expositions = $expositionModel->all();
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
            </header><!-- .masthead -->

            <div class="container">
                <div class="p-5 row justify-content-center">
                    <h3> Liste des expositions </h3><br>

                    <?php
                        if($deleted):
                    ?>
                            <div class="alert alert-success" role="alert">
                                Exposition supprimé avec succes !
                            </div>
                    <?php
                        endif;
                    if(isset($_GET['delete']) && !$deleted):
                        ?>
                        <div class="alert alert-danger" role="alert">
                            Echec de la suppression !
                        </div>
                    <?php
                    endif;
                    ?>
                    <table class="table table-bordered">
                        <thead> 
                        <tr>
                            <th>Nom exposition</th>
                            <th>Date debut</th>
                            <th>Date fin</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($expositions as $exposition):
                            ?>
                            <tr>
                                <td><?= $exposition->nom_exposition?></td>
                                <td><?= $exposition->date_debut_d_exposition?></td>
                                <td><?= $exposition->date_fin_d_exposition?></td>
                                <td>
                                    <a href="expositionshow.php?id=<?= $exposition->nom_exposition?>">Afficher</a>
                                    <a href="?delete=<?= $exposition->nom_exposition?>">Supprimer</a>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                        </tbody>
                    </table>
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