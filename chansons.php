<?php
include 'inc/header.php';


?>

    <main role="main">
        <div class="jumbotron">
            <div class="container">
                <div class="alert alert-dismissible alert-secondary">
                    <h2 class="text-secondary text-center">Liste des chansons enregistrées sur <b>SpotIFA</b></h2>
                </div>
                <!-- TEST -->
               <div class="row">
                   <ul class="nav nav-tabs" role="tablist">
                       <li class="nav-item">
                           <a href="#chanson" class="btn btn-secondary nav-link active" role="tab" data-toggle="tab">Liste de chansons</a>
                       </li>
                       <li class="nav-item">
                           <a href="#chanson_like" class="btn btn-secondary nav-link" role="tab" data-toggle="tab">Chansons aimées</a>
                       </li>
                   </ul>
               </div>
                <!-- TEST -->
        </div>

        <div class="container">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade show active" id="chanson">
                    <div class="row">
                        <?php
                        $sql_leschansons = "SELECT * FROM chansons ORDER BY nom ASC";
                        $result_leschansons = mysqli_query($db_connect, $sql_leschansons);
                        if (mysqli_num_rows($result_leschansons)) {
                            while($chansons = mysqli_fetch_assoc($result_leschansons)) {
                                echo "<div class='col-md-4'>";
                                echo "<h2>".$chansons['nom']."</h2> <img src='images/chansons/".$chansons['jaquette']."' class='float-right' width='50%' height='50%'>";
                                echo "<p>Date de réalisation : ".toHTMLviaDate($chansons['date_realisation'])."</p>";
                                echo "<p><a class='btn btn-secondary' href='fiche-chanson.php?id=".$chansons['id']."' role='button'>Voir les détails &raquo;</a></p>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p class='alert alert-danger text-center'>Aucune chanson enregistrée sur ce site</p>";
                        }
                        ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade hide " id="chanson_like">
                    <div class="row">
                        <?php
                        if (est_connecte()) {
                            $sql_likedsongs = "SELECT lm.id_utilisateur, lm.id_chanson, c.id, c.nom as nom, c.jaquette as jaq, c.date_realisation as date FROM likes_musiques lm INNER JOIN chansons c ON c.id = lm.id_chanson INNER JOIN utilisateurs u ON u.id = lm.id_utilisateur WHERE u.id = '".$_SESSION['id']."'";
                            $result_likedsongs = mysqli_query($db_connect, $sql_likedsongs);
                            if (mysqli_num_rows($result_likedsongs)) {
                                while($chansonsliked = mysqli_fetch_assoc($result_likedsongs)) {
                                    echo "<div class='col-md-4'>";
                                    echo "<h2>".$chansonsliked['nom']."</h2> <img src='images/chansons/".$chansonsliked['jaq']."' class='float-right' width='50%' height='50%'>";
                                    echo "<p>Date de réalisation : ".toHTMLviaDate($chansonsliked['date'])."</p>";
                                    echo "<p><a class='btn btn-secondary' href='fiche-chanson.php?id=".$chansonsliked['id']."' role='button'>Voir les détails &raquo;</a></p>";
                                    echo "</div>";
                                }
                            } else {
                                echo "<p class='alert alert-danger text-center'>Vous n'avez liké aucune chanson. Bougez vous !</p>";
                            }
                        } else {
                            echo "<p class='alert alert-danger text-center'>Veuillez vous connecter pour afficher vos musiques likées</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <hr>
        </div>
    </main>

<?php
include 'inc/footer.php';
?>