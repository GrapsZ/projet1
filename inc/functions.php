<?php

function est_connecte (): bool {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return !empty($_SESSION['connecte']);
}
function checkPass($password) {
    if (preg_match('/[A-Za-z0-9_]/', $password)) { // Chiffres, minuscules et majuscules et underscore mini 6 caracteres et maxi 12.
        return true;
    } else {
        return false;
    }
}
function checkEmail($mail){
    if (strpos($mail,'@')){
        return true;
    } else {
        return false;
    }
}
function forceUpperFirstChar($string){
    $final = strtoupper($string[0]).substr($string,1);
    return $final; // ucfirst()
}
function clean($valeur) {
    $valeur = addslashes($valeur); // Ajoute des antislashs
    $valeur = strip_tags($valeur); // supprime les balises html
    $valeur = mb_convert_encoding($valeur, 'UTF-8'); // encode en utf8 $valeur car les deux premières remettent $valeur en latin 1.
    return $valeur;
}
function alter($date, $before, $after) {
    return DateTime::createFromFormat($before, $date)->format($after);
}
function toSQL($date, $before = 'd/m/Y') {
    return alter($date, $before, 'Y-m-d H:i:s');
}
function toHTML($date, $before = 'Y-m-d H:i:s') {
    return alter($date, $before, 'd/m/Y');
}
function toHTMLviaDate($date, $before = 'Y-m-d') {
    return alter($date, $before, 'd/m/Y');
}
function get_ip(){
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    elseif(isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}