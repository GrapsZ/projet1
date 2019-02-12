<?php
require_once 'inc/header.php';
?>

<main role="main">
    <div class="jumbotron">
        <div class="container">
            <div class="alert alert-dismissible alert-secondary">
                <h2 class="text-secondary text-center">Votre recherche</h2>
            </div>
                <?php
                if (isset($_POST['recherche-bouton'])) {
                    if (!empty($_POST['recherche'])) {

                        $recherche = clean($_POST['recherche']);
                        $chansons_recherche = "SELECT chansons.id as chaid, chansons.nom as chanom FROM chansons WHERE chansons.nom LIKE '%".$recherche."%' ORDER BY chanom ASC";
                        $result_chansons = mysqli_query($db_connect, $chansons_recherche);

                        $artistes_recherche = "SELECT artistes.id as artid, artistes.nom as artnom FROM artistes WHERE artistes.nom LIKE '%".$recherche."%' ORDER BY artnom ASC";
                        $result_artistes = mysqli_query($db_connect, $artistes_recherche);

                        if (mysqli_num_rows($result_chansons) > 0 || mysqli_num_rows($result_artistes) > 0) {
                            echo "<div class='alert alert-success'>";
                            echo "Voici les résultats pour votre recherche.";
                            echo "</div><br>";
                            while($artistes_valeurs = mysqli_fetch_assoc($result_artistes)) {
                                echo "<p><span class='badge badge-dark'>Artiste</span> <a href='fiche-artiste.php?id=" . $artistes_valeurs['artid'] . "'>" . $artistes_valeurs['artnom'] . "</a></p>";
                            }
                            while($chansons_valeurs = mysqli_fetch_assoc($result_chansons)) {
                                echo "<p><span class='badge badge-info'>Titre</span> <a href='fiche-chanson.php?id=".$chansons_valeurs['chaid']."'>".$chansons_valeurs['chanom']."</a></p>";
                            }
                        } else {
                            echo "<div class='alert alert-danger'>";
                            echo "Aucun résultat n'a été trouvé pour votre recherche.";
                            echo "</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>";
                        echo "Veuillez renseigner le champs de recherche.";
                        echo "</div>";
                    }
                }
                ?>
        </div>
    </div>
</main>

<?php
include 'inc/footer.php';
?>