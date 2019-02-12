<?php
include 'inc/header.php';
if (!est_connecte()) {
    header('Location: connexion.php');
    exit();
} else {
    if (isset($_GET['id'])) {
        $idPlaylist = clean($_GET['id']);
        $con = "SELECT nom FROM playlists WHERE id = '".$idPlaylist."'";
        $resultcon = mysqli_query($db_connect, $con);
        $titre = mysqli_fetch_assoc($resultcon);
    }  else {
        header('Location: index.php');
        exit();
    }
}
 ?>

<main role="main">
    <div class="jumbotron">
        <div class="container">
            <div class="alert alert-dismissible alert-secondary">
                <h2 class="text-secondary text-center">Gestion de la playlist : <b><?php echo ucfirst($titre['nom']); ?></b></h2>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php
            $connexion = "SELECT id_playlist, p.id, c.nom as chanNom, c.id as chanId, c.jaquette as chanJaq FROM playlists p INNER JOIN contenu_playlist cp ON p.id = cp.id_playlist INNER JOIN chansons c ON cp.id_chanson = c.id WHERE p.id = '".$idPlaylist."' ORDER BY p.id";
            $resultat = mysqli_query($db_connect, $connexion);
            if (mysqli_num_rows($resultat)) {
                    while($chansons = mysqli_fetch_assoc($resultat)) {
                        echo "<div class='col-md-4'>";
                        echo "<h2>".$chansons['chanNom']."</h2> <p><img src='images/chansons/".$chansons['chanJaq']."' width='50%' height='50%'></p>";
                        echo "<p><a class='btn btn-danger' href='suppression.php?id=".$idPlaylist."&songId=".$chansons['chanId']."&action=zicSuppression' role='button'>Supprimer la musique</a></p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p class='alert alert-warning text-center'>Aucune chanson n'est présente dans votre playlist.</p>";
                }
            ?>
        </div>
        <div class='col-md-4'>
            <p><a class='btn btn-danger' href='suppression.php?id=<?php echo $idPlaylist; ?>&action=playSuppression' role='button'>Supprimer cette playlist</a></p>
        </div>
        <hr>
    </div>
</main>

<?php
include 'inc/footer.php';
?>
