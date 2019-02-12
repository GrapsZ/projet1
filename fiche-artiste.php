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
                    $sql_chanteur = "SELECT * FROM artistes WHERE id = '".$id."'";
                    $result_chanteur = mysqli_query($db_connect, $sql_chanteur);
                    if ($result_chanteur){
                        $infos_chanteur = mysqli_fetch_assoc($result_chanteur);
                    }
                    ?>
                <h1 class="display-3"><?php echo strtoupper($infos_chanteur['nom']); ?></h1>
                    <picture>
                        <img src="images/artistes/<?php echo $infos_chanteur['photo']; ?>" class="float-left mr-5 images-artistes" title="<?php echo $infos_chanteur['nom']; ?>" height="150px" width="200px">
                    </picture>
                <p><b>Sexe :</b> <?php
                if (strtolower($infos_chanteur['genre']) == 'm') {
                    echo "Masculin";
                } else
                    echo "Feminin";?>
                </p>
                    <p><b>Age :</b> <?php echo $infos_chanteur['age']; ?> ans.</p>
                    <p><b>Biographie :</b><br> <?php echo $infos_chanteur['description']; ?></p>
            <?php
                }
            } else {
                echo "Aucun renseignement. Veuillez effectuer une recherche";
            }
            ?>
        </div>
    </div>
    <div class="container">
        <div class="row">
    <?php
        if (!empty($id)) {
            if ($db_connect) {
                $sql_single = "SELECT chansons.id as chaid, chansons.nom as chanom, chansons.date_realisation as chadate, chansons.jaquette as chajaq FROM chansons INNER JOIN artistes ON chansons.id_artist = artistes.id WHERE artistes.id = '" . $id . "' ORDER BY chaid DESC LIMIT 3";
                $stmt = mysqli_query($db_connect, $sql_single);
                if (mysqli_num_rows($stmt)) {
                    while ($single = mysqli_fetch_array($stmt)) {
                        echo "<div class='col-md-4'>";
                            echo "<h2>".$single['chanom']."</h2>";
                            echo "<p><img src='images/chansons/".$single['chajaq']."' title='".$single['chanom']."' class='w-50'></p>";
                            echo "<p>Date de sortie : ".$single['chadate']."</p>";
                            echo "<p><a class='btn btn-secondary' href='fiche-chanson.php?id=".$single['chaid']."' role='button'>Voir les détails &raquo;</a></p>";
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