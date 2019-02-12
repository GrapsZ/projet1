<?php
require_once 'inc/header.php';

if (est_connecte()) {
    header('Location: moncompte.php');
    exit();
}

if (isset($_POST['connexion'])) {
    if (!empty($_POST['user-mail']) && !empty($_POST['motdepasse'])) {
        $sql_connexion = "SELECT id, username, email, password FROM utilisateurs WHERE username = '" . clean($_POST['user-mail']) . "' OR email = '" . clean($_POST['user-mail']) . "'";
        $result_connexion = mysqli_query($db_connect, $sql_connexion);

        if (mysqli_num_rows($result_connexion)) {
            $result_valeurs = mysqli_fetch_assoc($result_connexion);
            if (md5($_POST['motdepasse']) == $result_valeurs['password']) {
                $succes = "Félicitations, vous êtes connecté. Redirection dans quelques secondes...";

                $_SESSION['connecte'] = 1;
                $_SESSION['id'] = $result_valeurs['id'];
                $_SESSION['pseudo'] = $result_valeurs['username'];
                if (isset($_POST['remember'])){
                    setcookie('musicFavorite', md5($_SESSION['pseudo']), time() + 86400);
                }
                header("Refresh: 1;url=moncompte.php");
            } else {
                $erreur = "Les identifiants saisis sont incorrects.";
            }
        } else {
            $erreur = "Les identifiants saisis sont incorrects.";
        }
    } else {
        $erreur = "Les identifiants saisis sont incorrects.";
    }
}
?>
<main role="main">

    <div class="jumbotron">
        <div class="container">
            <h2>Connexion à votre compte</h2>

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
            <form action="" method="POST">
                <div class="form-group">
                    <label for="">Pseudo ou email</label>
                    <input type="text" name="user-mail" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="">Mot de passe</label>
                    <input type="password" name="motdepasse" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="remember" value="1"/> Se souvenir de moi
                    </label>
                </div>
                <button type="submit" name="connexion" class="btn btn-primary">Se connecter</button>
            </form>
            <a href="" title="mot de passe oublié">Mot de passe perdu</a>
        </div>
    </div>

</main>
<?php
include 'inc/footer.php';
?>