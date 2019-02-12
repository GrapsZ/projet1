<?php
$etape = $_GET['etape'];
if(!$etape){
    $etape = $_POST['etape'];
}
if(count($_POST) == '0' and $etape == ''){
    $etape = 0;
}

$etat = mysql_escape_string($_POST['ok']);
$pseudo = mysql_escape_string($_POST['pseudo']);
$decrypt = mysql_escape_string($_POST['pass']);
$email = mysql_escape_string($_POST['email']);
$pass = mysql_escape_string($_POST['pass']);
$passconf = mysql_escape_string($_POST['pass_confirm']);
$parrain = mysql_escape_string($_POST['parrain']);
$captcha = mysql_escape_string($_POST['captcha']);
$timestamp_expire = time() + 3600;

if ($etat) {
    if (strlen(trim($pseudo)) >= '5') {
        $test = mysql_num_rows(mysql_query("select * from `$site`.`account` WHERE username='$pseudo'"));
        if($test == '0') {
            if( $pass == $passconf ){
                if(strlen($pass) >= '6'){
                    $pass = sha1(strtoupper($pseudo).':'.strtoupper($pass));
                    if(strlen($email) >= '6'){
                        if(preg_match("#[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)){
                            $test = mysql_num_rows(mysql_query("SELECT * FROM `$site`.`account` WHERE email='$email'"));
                            if($test == '0'){
                                if($_POST['captcha'] == $_SESSION['captcha']){

                                    $objet = "Confirmation d'inscription";


                                    $message ="$top_mail<p>Bonjour,</p><br />Vous venez de vous inscrire sur http://www.web-simplicity.fr !<br /> Voici vos identifiants enregistrés :<br><br /><br /><li> Nom de compte : <b>$pseudo</b></li><li>Mot de passe : <b>$passconf</b></li><br /><br />Vous ne pourrez profiter de nos avantages qu'après avoir validé votre compte en <a href=\"http://www.web-simplicity.fr/valide_inscription.php?email=$email&key=$pass\" target=\"_blank\">cliquant ici !</a><br /><br />Si vous souhaitez avoir plus d'informations sur nos offres, <a href=\"http://www.web-simplicity.fr/offres.php\" target=\"_blank\">cliquez ici</a>.<br><br />Vous êtes également inscrit sur notre forum avec ces mêmes identifiants. Nous vous invitons à le consulter pour rester informé des nouveautés et des promotions exceptionnelles <a href=\"http://www.web-simplicity.fr/forum\" target=\"_blank\"> en cliquant ici</a>.<br><br />Toute l'équipe de Web-Simplicity.fr est fière de vous compter parmis ses clients !$end_mail";
                                    $mail = mail("$email", "$objet", "$message","$headers");

                                    $add = mysql_query("INSERT INTO `$site`.`account` (username, sha_pass_hash, email, last_ip, expansion, locked, parrain) values ('$pseudo','$pass','$email', '$ip','2','1','$parrain') ");

                                    if($add){
                                        echo "<meta http-equiv=\"refresh\" content=\"0;url=?module=inscription&etape=1\" />";
                                    }

                                }else{
                                    $error = 9;
                                    echo "<meta http-equiv=\"refresh\" content=\"0;url=inscription.php?error=$error\" />";
                                }
                            }else{
                                $error = 8;
                                echo "<meta http-equiv=\"refresh\" content=\"0;url=inscription.php?error=$error\" />";
                            }
                        }else{
                            $error = 7;
                            echo "<meta http-equiv=\"refresh\" content=\"0;url=inscription.php?error=$error\" />";
                        }
                    }else{
                        $error = 6;
                        echo "<meta http-equiv=\"refresh\" content=\"0;url=inscription.php?error=$error\" />";
                    }
                }else{
                    $error = 5;
                    echo "<meta http-equiv=\"refresh\" content=\"0;url=inscription.php?error=$error\" />";
                }
            }else{
                $error = 4;
                echo "<meta http-equiv=\"refresh\" content=\"0;url=inscription.php?error=$error\" />";
            }
        }else{
            $error = 3;
            echo "<meta http-equiv=\"refresh\" content=\"0;url=inscription.php?error=$error\" />";
        }
    }else{
        $error = 2;
        echo "<meta http-equiv=\"refresh\" content=\"0;url=inscription.php?error=$error\" />";
    }
}
?>
<?php
$error = $_GET['error'];
if($error == '9'){
    echo "<font color='red'>Le code captcha n'est pas bon.</font><br /><br />";
}elseif($error == '8'){
    echo "<font color='red'>L'email entré est déjà utilisé.</font><br /><br />";
}elseif($error == '7'){
    echo "<font color='red'>L'email entré n'est pas valide.</font><br /><br />";
}elseif($error == '6'){
    echo "<font color='red'>Vous n'avez entré aucun email.</font><br /><br />";
}elseif($error == '5'){
    echo "<font color='red'>Le mot de passe choisi est trop court.</font><br /><br />";
}elseif($error == '4'){
    echo "<font color='red'>Les mots de passe entrés ne sont pas identiques.</font><br /><br />";
}elseif($error == '3'){
    echo "<font color='red'>Désolé mais le pseudo est déjà utilisé.</font><br /><br />";
}elseif($error == '2'){
    echo "<font color='red'>Le nom entré est trop court.</font><br /><br />";
}elseif($error == '1'){
    echo "<font color='red'>Votre code de vérification est erroné.</font><br /><br />";
}
if($etape == '0'){?>
<form name="form1" method="post" action="?module=inscription"><div align="center">
        <em><font color="red"><blink>Tous les champs marqués d'un * sont obligatoires !</blink></font></em></div>
    <table width="80%" height="141" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-width:1px;border-style:solid;border-color:black;border-collapse:collapse;"><tbody><tr><td height="21" colspan="2" bgcolor="#6690C5"><div align="left">
                    <strong>&nbsp; Création d'un compte client :&nbsp;</strong></div></td></tr>
        <tr><td width="41%" height="24"><div align="right"><strong>Nom de compte <font color="red">*</font></strong><strong> : &nbsp;</strong></div></td>
            <td width="59%"><div align="left">&nbsp;<input name="pseudo" type="text" class="text" id="email_priver" /></div></td></tr>
        <tr><td width="41%" height="24"><div align="right"><strong>Mot de Passe <font color="red">*</font></strong><strong> : &nbsp;</strong></div></td>
            <td width="59%"><div align="left">&nbsp;<input name="pass" type="password" class="text" id="password" /></div></td></tr>
        <tr><td width="41%" height="24"><div align="right"><strong>Mot de Passe (Confirmation) <font color="red">*</font></strong><strong> : &nbsp;</strong></div></td>
            <td width="59%"><div align="left">&nbsp;<input name="pass_confirm" type="password" class="text" id="password2" /></div></td></tr>
        <tr><td width="41%" height="24"><div align="right"><strong>Email privé <font color="red">*</font></strong><strong> : &nbsp;</strong></div></td>
            <td width="59%"><div align="left">&nbsp;<input name="email" type="text" class="text" id="email" /></div></td></tr>
        <tr><td width="41%" height="24"><div align="right"><strong>Parrain</strong><strong> : &nbsp;</strong></div></td>
            <td width="59%"><div align="left">&nbsp;<input name="parrain" type="text" class="text" id="parrain" /></div></td></tr>
        <tr><td width="41%" height="24"><div align="right"><strong>Code de sécurité <i><?php echo captcha(); ?></i> <font color="red">*</font></strong><strong> : &nbsp;</strong></div></td>
            <td width="59%"><div align="left">&nbsp;<input name="captcha" type="text" class="text" id="captcha" /></div></td></tr>
        <tr><td height="46" colspan="2"><div align="center"><label><input type="submit" class="submit_contact" name="ok" id="button" value="Envoyer" /></label></div></td></tr></tbody></table>
    <?php }elseif($etape == '1'){
        echo "<img src=\"images/butons/valider.png\"/><br /><b>Votre inscription s'est déroulée avec succès !<br />
															Vous devez valider votre compte en cliquant sur le lien envoyé par email !<br />
															Si vous n'avez pas reçu ce mail, pensez à consulter vos indésirables.<br />
															<i><u>En validant votre compte, vous certifiez avoir accepté le réglement de notre site.</u></i></b><br /><br />";} ?>
    <div align="center"><br /><em>L'adresse Email fournie doit être exacte afin de recevoir le mail de validation du compte ! </em><br />
    </div></form>
</div></p>
</div>
<div id="corpsbas"></div>
</div>