<?php

/* UPDATE `ProfilsNoel` SET offre=0, id_profil_recoit = 0, pass='', mail_envoye=0 WHERE 1 */

exit();
/*
include_once('includes/libs_mail.inc.php');
include_once('includes/libs_code.inc.php');

echo "Tirage au sort :<br /><br />";
$link_mysql = mysql_connect("repasdesodsql.mysql.db","repasdesodsql","Pth89SFt32") or die("Impossible de se connecter : " . mysql_error($link_mysql));
//$link_mysql = mysql_connect("localhost","root","Kma65Gtu") or die("Impossible de se connecter : " . mysql_error($link_mysql));
mysql_select_db("repasdesodsql",$link_mysql);




//on parcours chaque profil non traité
$QryProfils = 'SELECT id, email, pass, nom, id_profils_exclus FROM ProfilsNoel WHERE offre =\'0\' ORDER BY id_profils_exclus DESC,  RAND() ';
$QryProfilsRes = mysql_query($QryProfils,$link_mysql) or die("Erreur : " . mysql_error($link_mysql));
while($RowProfils = mysql_fetch_assoc($QryProfilsRes)){
	
	$id_profil = $RowProfils['id'];
	$email = stripslashes($RowProfils['email']);
	$nom = stripslashes($RowProfils['nom']);
	(empty($RowProfils['id_profils_exclus'])) ? $id_profil_exclus = '0' : $id_profil_exclus = $RowProfils['id_profils_exclus'];
	
	echo '<br />Traitement de <strong>'.$nom.'</strong> ('.$email.')<br />';
	$pass = stripslashes($RowProfils['pass']);
	
	//Si pas de mot de passe généré
	if ($pass == ''){
		$pass = generate_code($link_mysql);
	}
	
	
	 
	//on séléctionne un profil qui n'a rien reçu et qui n'est pas le profil courant
	$QryGagnant = 'SELECT id, nom FROM ProfilsNoel 
	WHERE id_profil_recoit =\'0\' 
	AND id != \''.$id_profil.'\'
	AND id NOT IN ('.$id_profil_exclus.') 
	ORDER BY RAND() LIMIT 1';
	$QryGagnantRes = mysql_query($QryGagnant,$link_mysql);
	if(mysql_num_rows($QryGagnantRes) > 0){
		$RowGagnant = mysql_fetch_assoc($QryGagnantRes);
		
		$id_profil_gagnant = $RowGagnant['id'];
		$nom_gagnant = stripslashes($RowGagnant['nom']);
		
		$QryUpdateGagnant = 'UPDATE ProfilsNoel 
		SET id_profil_recoit=\''.$id_profil.'\' 
		WHERE id = \''.$id_profil_gagnant.'\' LIMIT 1';
		mysql_query($QryUpdateGagnant,$link_mysql);
		
		
		
		echo '<strong>'.$nom.'</strong> offre un merveilleux cadeau à  <strong><!--'.$nom_gagnant.'-->***</strong><br />';
		
		
		$retour_mail='0';
		if ($email != ''){
			
			$retour_mail = envoi_mail_code($email,$nom,$pass);

			($retour_mail) ? $retour_mail='1' : $retour_mail='0'; 
			
			echo 'Envoi d\'un mail à '.$email.'<br />'; 
		}
		$QryUpdate = 'UPDATE ProfilsNoel SET offre = \'1\',mail_envoye = \''.$retour_mail.'\',pass = \''.$pass.'\' WHERE id = \''.$id_profil.'\'';
		mysql_query($QryUpdate,$link_mysql);
		
	}else{
		
		echo '<strong>'.$nom.'</strong> n\'a personne à  qui offrir un cadeau, c\'est triste :(<br />';
			
	}
	mysql_free_result($QryGagnantRes);
		
}



mysql_close($link_mysql);*/
?>