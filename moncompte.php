<?php
include 'inc/header.php';

if (!est_connecte()) {
    header('Location: connexion.php');
    exit();
} else {
    $username = clean($_SESSION['pseudo']);
    $id = clean($_SESSION['id']);
}


?>
<main role="main">
    <div class="jumbotron">
        <div class="container">
            <h2>Mon compte</h2>
            <p>Bienvenue <b><?php echo $username; ?></b>,</p>
            <p>Ici vous pourrez créer mais également gérer votre playlist. N'attendez plus, profitez de nos services dès maintenant !</p>
            <h3>Vos informations personnelles</h3>
            <?php
            $sql_infos = "SELECT * FROM utilisateurs WHERE id = '".$id."'";
            $result_infos = mysqli_query($db_connect, $sql_infos);
            if ($result_infos) {
                $utilisateur = mysqli_fetch_array($result_infos);
                echo "<p>Votre Nom d'utilisateur :<input type='text' name='email' placeholder='".$utilisateur['email']."' class='form-control w-25' disabled/></p>";
                echo "<p>Date de votre inscription :<input type='text' name='date-inscription' placeholder='".toHTML($utilisateur['date_inscription'])."' class='form-control w-25' disabled/></p>";
                echo "<p>Votre dernière Ip :<input type='text' name='ip' placeholder='".$utilisateur['ip']."' class='form-control w-25' disabled/></p>";
                }
            ?>
        </div>
    </div>
    <div class="container">
        <h3>Vos playlists : </h3>
        <div class="row">
            <?php
                $sql_playslits = "SELECT id_playlist, p.nom as playNom, p.id as playId, p.date_creation as playDate, c.nom as chanNom, c.id as chanId FROM playlists p LEFt JOIN contenu_playlist cp ON p.id = cp.id_playlist LEFT JOIN chansons c ON cp.id_chanson = c.id WHERE p.id_users = '".$id."' ORDER BY p.id";
                $stmt = mysqli_query($db_connect, $sql_playslits);
                if (mysqli_num_rows($stmt)) {
                    $montour = 0;
                    while($playlists = mysqli_fetch_array($stmt)) {
                        if ($playlists['playId'] != $montour ) {
                            if ($montour != 0) {

                                echo "</div>";
                                echo "<p><a class='btn btn-secondary float-right' href='gestion-playlist.php?id=".$montour."' role='button'>Gérer ma playlist &raquo;</a></p>";
                                echo "</div>";
                                echo "</div>";
                            }
                            $montour = $playlists['playId'];
                            echo "<div class='col-md-4'>";
                            echo "<div class='card border-success mb-3' style='max-width: 20rem;'>";
                            echo "<div class='card-header'>Date de création : ".toHTML($playlists['playDate'])."</div>";
                            echo "<div class='card-body'>";
                            echo "<div class='card-title'>";
                            echo "<h4 class='d-inline'>".forceUpperFirstChar($playlists['playNom'])."</h4> <a href='' class='d-inline float-right ml-1 badge badge-pill badge-dark'>Editer</a>";

                        }
                        echo "<p class='card-text'><a href='fiche-chanson.php?id=".$playlists['chanId']."'>".$playlists['chanNom']."</a></p>";
                    }
                    echo "</div>";
                    echo "</div>";
                    echo "<p><a class='btn btn-secondary float-right' href='gestion-playlist.php?id=".$montour."' role='button'>Gérer ma playlist &raquo;</a></p>";
                    echo "</div>";
                    echo "</div>";

                } else {
                    echo "<p class='col-12'>Vous n'avez pas encore de playlist. Créez en une dès maintenant.</p>";
                    echo "<p><a class='btn btn-info' href='creation_playlist.php' role='button'>Créer une playlist &raquo;</a></p>";
                }
            ?>
        </div>
        <hr>
    </div>
</main>
<?php
include 'inc/footer.php';
?>