<?php
require_once 'inc/header.php';
?>

    <main role="main">
        <div class="jumbotron">
            <div class="container">
                <h2>Recherche</h2>
                <p>Résultat recherche ici :</p>
                <?php
                if (isset($_POST['recherche-bouton'])) {
                    if (!empty($_POST['recherche'])) {
                        $recherche = $_POST['recherche'];
                        $sql_recherche = "SELECT artistes.nom as artnom, artistes.id as artid, chansons.id as chatid, chansons.nom as chanom FROM chansons INNER JOIN artistes ON chansons.id_artist = artistes.id
                                                  WHERE artistes.nom LIKE '%".$recherche."%' OR chansons.nom LIKE '%".$recherche."%'";
                        $result_recherche = mysqli_query($db_connect, $sql_recherche);

                        if (mysqli_num_rows($result_recherche)) {
                            echo "<div class=\"alert alert-success\">";
                            echo "Voici les résultats pour votre recherche.";
                            echo "</div><br>";
                            while($result_valeurs = mysqli_fetch_assoc($result_recherche)) {
                                if ($result_valeurs['chanom']) {
                                    echo "<p><a href='chansons.php?id=".$result_valeurs['chatid']."'>".$result_valeurs['chanom']."</a></p>";
                                } elseif ($result_valeurs['artnom']) {
                                    echo "<p><a href='artistes.php?id=".$result_valeurs['artid']."'>".$result_valeurs['artnom']."</a></p>";
                                }
                            }
                        } else {
                            echo "<div class=\"alert alert-danger\">";
                            echo "Aucun résultat n'a été trouvé pour votre recherche.";
                            echo "</div>";
                        }
                    } else {
                        echo "<div class=\"alert alert-danger\">";
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

<!--
<iframe width="560" height="315" src="https://www.youtube.com/embed/Vzo-EL_62fQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
-->
