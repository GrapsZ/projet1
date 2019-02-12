<?php
session_start();
// Détruit toutes les variables de session
$_SESSION = array();
setcookie('musicFavorite', 'deconnecte', time() - 42000);
session_destroy();
header('Location: index.php');