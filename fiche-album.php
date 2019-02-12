<?php
include 'inc/header.php';

if (isset($_GET['id'])) {
    $id = clean($_GET['id']);
}
?>
    <main role="main">
        <div class="jumbotron">
            <div class="container">
                <?php
                if (!empty($id)) {
                    if ($db_connect) {
                        $sql_albums = "SELECT * FROM albums WHERE id = '".$id."'";
                        $result_albums = mysqli_query($db_connect, $sql_albums);
                        if ($result_albums){
                            $albums = mysqli_fetch_assoc($result_albums);
                        }
                        ?>
                        <h1 class="display-3"><?php echo strtoupper($albums['nom']); ?></h1>
                        <picture>
                            <img src="images/albums/<?php echo $albums['jaquette']; ?>" class="float-left mr-5 images-artistes" title="<?php echo $albums['nom']; ?>" height="150px" width="200px">
                        </picture>
                        <p><b>Date de publication :</b> <?php echo toHTML($albums['date']); ?></p>
                        <?php
                    }
                } else {
                    echo "Aucun renseignement. Veuillez effectuer une recherche";
                }
                ?>
            </div>
        </div>
        <div class="container ">
            <h2>Les sons présents sur cet album :</h2>
            <div class="row">
                <?php
                if (!empty($id)) {
                    if ($db_connect) {
                        $sql_sons = "SELECT chansons.id as chaId, chansons.nom as chaNom, chansons.jaquette as chaJaq FROM chansons INNER JOIN albums ON chansons.id_album = albums.id WHERE albums.id = '" . $id . "'";
                        $stmt = mysqli_query($db_connect, $sql_sons);
                        if (mysqli_num_rows($stmt)) {
                            while ($songs = mysqli_fetch_array($stmt)) {
                                echo "<div class='col-md-4'>";
                                    echo "<p><h4>".$songs['chaNom']."</h4></p>";
                                    echo "<p><img src='images/chansons/".$songs['chaJaq']."' title='".$songs['chaNom']."' class='w-50'></p>";
                                    echo "<p><a class='btn btn-secondary' href='fiche-chanson.php?id=".$songs['chaId']."' role='button'>Voir les détails &raquo;</a></p>";
                                echo "</div>";
                            }
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