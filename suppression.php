<?php
include 'inc/header.php';
if (!est_connecte()) {
    header('Location: connexion.php');
    exit();
} else {
    if (isset($_GET['id']) && isset($_GET['songId']) && isset($_GET['action']) && $_GET['action'] == 'zicSuppression'){
        $idPlaylist = clean($_GET['id']);
        $idSongToDelete = clean($_GET['songId']);
        $connect = "DELETE FROM contenu_playlist WHERE id_chanson = '".$idSongToDelete."' AND id_playlist = '".$idPlaylist."'";
        $retour = mysqli_query($db_connect, $connect);
        header("Location: gestion-playlist.php?id=$idPlaylist");
        exit();
    } elseif (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'playSuppression') {
        $idPlaylist = clean($_GET['id']);
        $connect = "DELETE FROM contenu_playlist WHERE id_playlist = '".$idPlaylist."'";
        $retour = mysqli_query($db_connect, $connect);
        $connectDeux = "DELETE FROM playlists WHERE id = '".$idPlaylist."'";
        $retourDeux = mysqli_query($db_connect, $connectDeux);
        header("Location: moncompte.php");
        exit();
    } else {
        header('Location: index.php');
        exit();
    }
}
?>