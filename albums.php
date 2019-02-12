<?php
include 'inc/header.php';

?>

    <main role="main">
        <div class="jumbotron">
            <div class="container">
                <div class="alert alert-dismissible alert-secondary">
                    <h2 class="text-secondary text-center">Liste des albums enregistrées sur <b>SpotIFA</b></h2>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <?php
                $sql_albums = "SELECT * FROM albums ORDER BY nom ASC";
                $result_albums = mysqli_query($db_connect, $sql_albums);
                if (mysqli_num_rows($result_albums)) {
                    while($albums = mysqli_fetch_assoc($result_albums)) {
                        echo "<div class='col-md-5'>";
                        echo "<h2>".$albums['nom']."</h2> <img src='images/albums/".$albums['jaquette']."' class='float-right' width='50%' height='50%'>";
                        echo "<p><b>Date de publication :</b> ".toHTML($albums['date'])."</p>";
                        echo "<p><a class='btn btn-secondary' href='fiche-album.php?id=".$albums['id']."' role='button'>Voir les détails &raquo;</a></p>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Aucun album n'est actuellement enregistré sur ce site</div>";
                }
                ?>
            </div>
            <hr>
        </div>
    </main>

<?php
include 'inc/footer.php';
?>