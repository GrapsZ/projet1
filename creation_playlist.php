<?php
include 'inc/header.php';
if (!est_connecte()) {
    header('Location: connexion.php');
    exit();
}

if (isset($_POST['submit'])) {
    if (empty($_POST['titre'])) {
        $erreur = "Veuillez saisir un titre pour votre playlist.";
    } else {
        $sql = "INSERT INTO playlists (nom, id_users) VALUES ('".clean($_POST["titre"])."', '".clean($_SESSION["id"])."')";
        $result = mysqli_query($db_connect, $sql);
        if ($result) {
            $succes = "Votre playlist est bien créée.";
            header("Refresh: 1;url=chansons.php");
        } else {
            $erreur = "Une erreur est survenue, votre playlist n'a pas pu être créée.";
        }
    }
}
?>
    <main role="main">

        <div class="jumbotron">
            <div class="container">
                <div class="alert alert-dismissible alert-secondary">
                    <h2 class="text-secondary text-center">Création d'une playlist</h2>
                </div>

                <?php if ($erreur): ?>
                    <div class="alert alert-danger">
                        <?= $erreur ?>
                    </div>
                <?php endif ?>
                <?php if ($succes): ?>
                    <div class="alert alert-success">
                        <?= $succes ?>
                    </div>
                <?php endif ?>
                <form action="" method="POST" name="playlist">
                    <div class="form-group">
                        <label for="titre"><p>Titre de votre playlist :</p></label>
                        <input type="text" name="titre" class="form-control w-50" required/>
                    </div>
                    <input type="submit" value="Créer" name="submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </main>
<?php
include 'inc/footer.php';
// Madonna2018
?>