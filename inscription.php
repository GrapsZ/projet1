<?php
require_once 'inc/header.php';
//require_once 'inc/functions.php';
if (est_connecte()) {
    header('Location: moncompte.php');
    exit();
}

if (isset($_POST['submit'])) {
    if (empty($_POST['pseudo'])) {
        $erreur = "Veuillez saisir un Pseudo.";
    } elseif (empty($_POST['email'])) {
        $erreur = "Veuillez saisir une adresse email.";
    } elseif (empty($_POST['motdepasse'])) {
        $erreur = "Veuillez saisir un mot de passe.";
    } else {
        if (($_POST['motdepasse']) != $_POST['motdepasse-confirm']) {
            $erreur = "Les deux mots de passe ne correspondent pas.";
        } elseif (!checkPass($_POST['motdepasse'])) {
            $erreur = "Votre mot de passe doit faire entre 6 et 12 caractères, et ne doit pas contenir de caractères spéciaux.";
        } elseif (!checkEmail($_POST['email'])) {
            $erreur = "Votre adresse email est invalide.";
        } else {
            $sql_search = "SELECT username, email FROM utilisateurs WHERE username = '".clean($_POST['pseudo'])."' OR email = '".clean($_POST['email'])."'";
            $result_search = mysqli_query($db_connect, $sql_search);
            $result_valeurs = mysqli_fetch_assoc($result_search);
            if ($result_valeurs['username'] == $_POST['pseudo']) {
                $erreur = "Le nom de compte <b>".clean($_POST['pseudo'])."</b> est déjà utilisé.";
            } elseif ($result_valeurs['email'] == $_POST['email']) {
                $erreur = "L'adresse email <b>".clean($_POST['email'])."</b> est déjà utilisée.";
            } else {
                if ($result_search)
                    $ip = get_ip();
                    $token = '';
                    $sql = "INSERT INTO utilisateurs (username, password, email, ip) VALUES ('".clean($_POST["pseudo"])."', '".md5($_POST["motdepasse"])."', '".clean($_POST["email"])."', '".$ip."')";
                    $result = mysqli_query($db_connect, $sql);
                if ($result) {
                    $succes = "Votre inscription est validée. Vous pouvez vous connecter.";
                } else {
                    $erreur = "Une erreur est survenue lors de la validation du formulaire. Veuillez contacter un administrateurs du site.";
                }
            }
        }
    }
}

?>
    <main role="main">

        <div class="jumbotron">
            <div class="container">
                <h2>Inscription</h2>

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
                <form action="" method="POST" name="inscription">
                    <div class="form-group">
                        <label for="pseudo">Pseudo</label>
                        <input type="text" name="pseudo" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="">Mot de passe</label>
                        <input type="password" name="motdepasse" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="motdepasse-confirm">Confirmation Mot de passe</label>
                        <input type="password" name="motdepasse-confirm" class="form-control"/>
                    </div>
                    <input type="submit" value="Inscription" name="submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </main>
<?php
include 'inc/footer.php';
// Madonna2018
?>