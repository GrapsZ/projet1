<?php
include 'inc/header.php';
 ?>

<main role="main">
    <div class="jumbotron">
        <div class="container">
            <div id="spotifaCaroussel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#spotifaCaroussel" data-slide-to="0" class="active"></li>
                    <li data-target="#spotifaCaroussel" data-slide-to="1"></li>
                    <li data-target="#spotifaCaroussel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images/slide/caroussel1.jpg" class="d-block w-100" alt="Image 1">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>.fdgsdfgfdsfg</h5>
                            <p>dsfgfdgdgdgdsgsdg.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/slide/caroussel2.jpg" class="d-block w-100" alt="Image 2">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>.fdgsdfgfdsfg</h5>
                            <p>dsfgfdgdgdgdsgsdg.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/slide/caroussel3.jpg" class="d-block w-100" alt="Image 3">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>.fdgsdfgfdsfg</h5>
                            <p>dsfgfdgdgdgdsgsdg.</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#spotifaCaroussel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Précédent</span>
                </a>
                <a class="carousel-control-next" href="#spotifaCaroussel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Suivant</span>
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="alert alert-dismissible alert-secondary">
            <h2 class="text-secondary text-center">Découvrez les trois derniers singles ajoutés à <b>SpotIFA</b></h2>
        </div>
        <div class="row">
        <?php
        if ($db_connect) {
            $last_singles = "SELECT chansons.id as chaId, chansons.nom, chansons.jaquette FROM chansons ORDER BY chaId DESC LIMIT 3";
            $result_singles = mysqli_query($db_connect, $last_singles);
            if (mysqli_num_rows($result_singles)) {
                while($chansons = mysqli_fetch_assoc($result_singles)) {
                    echo "<div class='col-md-4'>";
                        echo "<h2>".$chansons['nom']."</h2>";
                        echo"<picture><p><img src='images/chansons/".$chansons['jaquette']."' class='w-50' alt='".$chansons['nom']."'></p></picture>";
                        echo "<p><a class='btn btn-secondary' href='fiche-chanson.php?id=".$chansons['chaId']."' role='button'>Voir les détails &raquo;</a></p>";
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
include 'inc/footer.php';
?>
