<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'private/config.php';

$erreur = null;
$succes = null;

$db_connect = mysqli_connect(DB_SERVEUR, DB_UTILISATEUR, DB_PASSWORD, DB_DATABASE);
mysqli_set_charset($db_connect, "utf8");

require_once 'inc/functions.php';

if (!est_connecte()) {
    if (isset($_COOKIE['musicFavorite']) && $_COOKIE['musicFavorite'] != 'deconnecte') {
        $sql_cookie = "SELECT id, username, email FROM utilisateurs WHERE MD5(username) = '".clean($_COOKIE['musicFavorite'])."'";
        $result_cookie = mysqli_query($db_connect, $sql_cookie);

        if (mysqli_num_rows($result_cookie) > 0) {
            $result_valeurs = mysqli_fetch_assoc($result_cookie);

            $_SESSION['connecte'] = 1;
            $_SESSION['id'] = $result_valeurs['id'];
            $_SESSION['pseudo'] = $result_valeurs['username'];
        }
        mysqli_free_result($result_cookie); // libere la mémoire
    }
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="SpotIFA : La musique comme vous le voulez">
    <meta name="author" content="SpotIFA Enterprise">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">
    <title><?php echo $sitename; ?></title>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="./">SpotIFA : Musique</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#barreNavigation" aria-controls="barreNavigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="barreNavigation">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="artistes.php">Artistes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="chansons.php">Chansons</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="albums.php">Albums</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Espace membre</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <?php if (est_connecte()){ ?>
                        <a class="dropdown-item" href="moncompte.php">Mon compte</a>
                        <a class="dropdown-item" href="#">Paramètres</a>
                        <a class="dropdown-item" href="deconnexion.php">Déconnexion</a>
                        <?php } else {?>
                        <a class="dropdown-item" href="connexion.php">Connexion</a>
                        <a class="dropdown-item" href="inscription.php">Inscription</a>
                        <?php } ?>
                    </div>
                </li>
            </ul>
            <form action="recherche.php" method="POST" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" name="recherche" placeholder="Recherche" aria-label="Recherche">
                <button class="btn btn-primary" name="recherche-bouton" type="submit">Rechercher</button>
            </form>
        </div>
    </nav>