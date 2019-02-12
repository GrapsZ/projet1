<?php
include 'inc/header.php';

if (isset($_GET['id']) && !isset($_POST['submit'])) {
    $id = clean($_GET['id']);
} elseif (isset($_GET['id']) && isset($_POST['submit'])) {
    $id = clean($_GET['id']);
    if (!empty($_POST['playlistId']) && $_POST['playlistId'] != 'noplaylist') {
        $playId = intval($_POST['playlistId']);
        $checkExist = "SELECT * FROM contenu_playlist WHERE id_playlist = '".$playId."' AND id_chanson = '".$id."' ";
        $checkRepons = mysqli_query($db_connect, $checkExist);
        if (!mysqli_num_rows($checkRepons)) {
            $connect = "INSERT INTO contenu_playlist (id_playlist, id_chanson) VALUES ('".$playId."', '".$id."')";
            $query = mysqli_query($db_connect, $connect);
            if ($query) {
                $succes = "<p class='text-center'><b>Super ! La chanson a bien été ajoutée à votre playlist. Pour la consulter, <a href='gestion-playlist.php?id=$playId' >cliquez ici</b></a>.";
            } else {
                $erreur = "<p class='text-center'><b>Erreur. Requête non enregistrée. Contactez un administrateur.</b></p>";
            }
        } else {
            $erreur = "<p class='text-center'><b>Cette chanson est déjà présente dans cette playlist.</b></p>";
        }

    } elseif (!empty($_POST['playlistId']) && $_POST['playlistId'] == 'noplaylist') {
        $erreur = "<p class='text-center'><b>Vous n'avez pas de playlist !!</b></p>";
    }else {
        $erreur = "<p class='text-center'><b>Erreur. Contactez un administrateur.</b></p>";
    }
}
?>

    <main role="main">
        <div class="jumbotron">
            <div class="container">
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
                <?php
                if (!empty($id)) {
                    if ($db_connect) {
                        $sql_chanson = "SELECT * FROM chansons WHERE id = '".$id."'";
                        $result_chanson = mysqli_query($db_connect, $sql_chanson);
                        if ($result_chanson){
                            $chansons = mysqli_fetch_assoc($result_chanson);
                            }
                        ?>
                        <h1 class="display-3"><?php echo strtoupper($chansons['nom']); ?></h1>
                        <picture>
                            <img src="images/chansons/<?php echo $chansons['jaquette']; ?>" class="float-left mr-5 images-artistes" title="<?php echo $chansons['nom']; ?>" height="150px" width="200px">
                        </picture>
                        <p><b>Date de sortie :</b> <?php echo toHTMLviaDate($chansons['date_realisation']); ?></p>

                        <?php
                        if (est_connecte()) {
                            $conlike = "SELECT lm.id_utilisateur, lm.id_chanson, u.id, c.id FROM likes_musiques lm INNER JOIN utilisateurs u ON u.id = lm.id_utilisateur INNER JOIN chansons c ON c.id = lm.id_chanson WHERE u.id = '".$_SESSION['id']."' AND c.id = '".$id."'";
                            $retour = mysqli_query($db_connect, $conlike);
                            if (mysqli_num_rows($retour)) {
                                echo "<p id='contentcoeur'><b>Vous aimez cette chanson:</b> <i class='far fa-heart coeurliked'  onclick='onClickDislike(\"".$id."\", \"".$_SESSION['id']."\")'></i></p>";
                            } else {
                                echo "<p id='contentcoeur'><b>Aimer cette chanson:</b> <i class='far fa-heart coeurlike' onclick='onClickChange(\"".$id."\", \"".$_SESSION['id']."\")'></i></p>";
                            }
                            echo "<form action='' method='POST' class='form-group w-25'>";
                            echo "<label for='playlistId'>Ajouter à la playlist :</label>";
                            echo "<select class='form-control' id='playlistId' name='playlistId'>";
                            $connectpl = "SELECT id, nom FROM playlists WHERE id_users = '".$_SESSION['id']."'";
                            $resultat = mysqli_query($db_connect, $connectpl);
                            if (mysqli_num_rows($resultat)) {
                                while ($playlists = mysqli_fetch_array($resultat)) {
                                    echo "<option value='".$playlists['id']."'>".$playlists['nom']."</option>";
                                }
                            } else {
                                echo "<option value='noplaylist'>Vous n'avez pas de playlist</option>";
                            }
                            echo "</select>";
                            echo "<p><input type='submit' value='Ajouter à cette playlist' name='submit' class='btn btn-primary'></p>";
                            echo "</form>";
                        }
                    }
                } else {
                    echo "<p>Aucun renseignement. Veuillez effectuer une recherche</p>";
                }
                ?>
            </div>
        </div>
        <div class="container">
            <h2>Auteur de cette chanson :</h2>
            <div class="row">
                <?php
                if (!empty($id)) {
                    if ($db_connect) {
                        $sql_artiste = "SELECT artistes.id as artid, artistes.nom as artnom, artistes.age as artage, artistes.photo as artpho FROM artistes INNER JOIN chansons ON chansons.id_artist = artistes.id WHERE chansons.id = '" . $id . "'";
                        $stmt = mysqli_query($db_connect, $sql_artiste);
                        if (mysqli_num_rows($stmt)) {
                            $artiste = mysqli_fetch_array($stmt);
                            echo "<div class='col-md-4'>";
                                echo "<h2>".$artiste['artnom']."</h2>";
                                echo "<p><img src='images/artistes/".$artiste['artpho']."' title='".$artiste['artnom']."' class='w-50'></p>";
                                echo "<p><a class='btn btn-secondary' href='fiche-artiste.php?id=".$artiste['artid']."' role='button'>Voir les détails &raquo;</a></p>";
                            echo "</div>";
                        }
                    }
                }
                ?>
            </div>
            <hr>
        </div>
    </main>
<?php
include 'inc/footer.php'
?>