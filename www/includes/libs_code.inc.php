<?php 
function generate_code($link_mysql){
    //tableau caractère mot de passe
    $tab_pass = 'ABCDEFGHJKLMNPRSTUVWXYZ23456789';
    $taille_tab_pass = strlen($tab_pass)-1;

    $pass_ok = false;
    while(!$pass_ok){
        //on en génère un
        //$pass = md5(uniqid(mt_rand(), true));
        $pass = $tab_pass[rand(0,$taille_tab_pass)].$tab_pass[rand(0,$taille_tab_pass)].$tab_pass[rand(0,$taille_tab_pass)];
        
        //S'il n'existe pas
        $QryVerifPass = 'SELECT id FROM ProfilsNoel WHERE pass = \''.addslashes($pass).'\'LIMIT 1';
        $QryVerifPassRes = mysql_query($QryVerifPass,$link_mysql);
        if (mysql_num_rows($QryVerifPassRes) == 0){
            
            //on l'enregistre
            $QryUpdatePass = 'UPDATE ProfilsNoel 
            SET pass = \''.addslashes($pass).'\'
            WHERE id = \''.$id_profil.'\' LIMIT 1';
            mysql_query($QryUpdatePass,$link_mysql);
            
            $pass_ok = true;
        }
    }
    if(!$pass_ok) $pass = false;

    return $pass;
}