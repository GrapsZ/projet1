<?php
require 'private/config.php';
require 'inc/functions.php';

$dbconnect = mysqli_connect(DB_SERVEUR, DB_UTILISATEUR, DB_PASSWORD, DB_DATABASE);
mysqli_set_charset($dbconnect, "utf8");

$action = clean($_POST["action"]);
$idMu = clean($_POST["idMu"]);
$idUs = clean($_POST["idUs"]);

if (isset($idMu) && isset($idUs) && isset($action) && $action == 'like') {
    $requete = "INSERT INTO likes_musiques (id_utilisateur, id_chanson) VALUES ('".$idUs."','".$idMu."')";
    $con = mysqli_query($dbconnect, $requete);

} elseif (isset($idMu) && isset($idUs) && isset($action) && $action == 'dislike') {
    $requetedel = "DELETE FROM likes_musiques WHERE id_utilisateur = '".$idUs."' AND id_chanson = '".$idMu."'";
    $condel = mysqli_query($dbconnect, $requetedel);

}
mysqli_close($dbconnect);