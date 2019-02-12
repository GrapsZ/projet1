<?php
include 'inc/header.php';

?>

    <main role="main">
        <div class="jumbotron">
            <div class="container">
                <div class="alert alert-dismissible alert-secondary">
                    <h2 class="text-secondary text-center">Liste des artistes enregistrés sur <b>SpotIFA</b></h2>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <?php
                $sql_lesartistes = "SELECT * FROM artistes ORDER BY nom ASC";
                $result_lesartistes = mysqli_query($db_connect, $sql_lesartistes);
                if (mysqli_num_rows($result_lesartistes)) {
                    while($artistes = mysqli_fetch_assoc($result_lesartistes)) {
                        echo "<div class='col-md-5'>";
                            echo "<h2>".$artistes['nom']."</h2> <img src='images/artistes/".$artistes['photo']."' class='float-right' width='25%' height='25%'>";
                            echo "<p>".$artistes['description']."</p>";
                            echo "<p><a class='btn btn-secondary' href='fiche-artiste.php?id=".$artistes['id']."' role='button'>Voir les détails &raquo;</a></p>";
                        echo "</div>";
                    }
                } else {
                    echo "Aucun artiste enregistré sur ce site";
                } ?>
            </div>
            <hr>
        </div>
    </main>

<?php
include 'inc/footer.php';
?>