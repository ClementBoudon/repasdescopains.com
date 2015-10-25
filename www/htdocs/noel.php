<?php
include_once('config.php');

include_once('includes/libs_mail.inc.php');
include_once('includes/libs_code.inc.php');
include_once('includes/libs_logs.inc.php');

$link_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass) or die("Impossible de se connecter : " . mysql_error());
mysql_set_charset ( 'utf8',$link_mysql );
//$link_mysql = mysql_connect("localhost","root","Kma65Gtu") or die("Impossible de se connecter : " . mysql_error($link_mysql));
mysql_select_db($mysql_database,$link_mysql);

log_all($link_mysql);

$messsage_erreur='';
$messsage_erreur_code='';
$affichage_recup = 'none';
$affichage = 'normal';

if (isset($_GET['c']) and $_GET['c'] != ''){
	//récupération du cadeau


	//Vérification du mot de passe
	$QrySelect = 'SELECT id, nom, email, used FROM ProfilsNoel where pass =\''.mysql_real_escape_string(addslashes(strtoupper($_GET['c'])),$link_mysql).'\'';
	$QrySelectRes = mysql_query($QrySelect,$link_mysql);
	if (mysql_num_rows($QrySelectRes) == 1){
		$RowSelect = mysql_fetch_assoc($QrySelectRes);

		$id = stripslashes($RowSelect['id']);
		$nom = stripslashes($RowSelect['nom']);
		$email = stripslashes($RowSelect['email']);

		if($RowSelect['used'] == '1'){

			//Le code a déjà été utilisé, on en regénère un nouveau qu'on envoi par mail et on en informe la personne

			$pass = generate_code($link_mysql);

			//On marque le code comme utilisé
			$QryUsed = 'UPDATE ProfilsNoel SET pass = \''.$pass.'\', used = 0 WHERE id = \''.$RowSelect['id'].'\'';
			mysql_query($QryUsed,$link_mysql);

			envoi_mail_code($email,$nom,$pass);

			$messsage_erreur.='Ce code a déjà été utilisé, c\'est triste.<br>
			Mais heureusement tu vas en recevoir un nouveau par email dans quelques minutes. C\'est cool, hein ?
			<br>
			<p>Ton code personnel a été envoyé par mail à <strong>'.$email.'</strong>.</p>';
			$affichage = 'normal';

		}else{

			//récupération du profil
			$QryProfil = 'SELECT id, nom, genre, commentaire FROM ProfilsNoel WHERE id_profil_recoit = \''.$RowSelect['id'].'\'';
			$QryProfilRes = mysql_query($QryProfil,$link_mysql);
			$RowProfil = mysql_fetch_assoc($QryProfilRes);
				$id_gagnant = $RowProfil['id'];
				$genre_gagnant = $RowProfil['genre'];
				$nom_gagnant = stripslashes($RowProfil['nom']);
				$commentaire_gagnant = stripslashes($RowProfil['commentaire']);
			mysql_free_result($QryProfilRes);

			$genre_txt = array();
			if($genre_gagnant=='f'){
				$genre_txt['lui']='elle';
			}else{
				$genre_txt['lui']='lui';
			}

			//récupération des images droles
			$tab_humour = array();
			$QryLOL = 'SELECT id, nom, commentaire FROM ProfilsLOLNoel';
			$QryLOLRes = mysql_query($QryLOL,$link_mysql);
			while($RowLOL = mysql_fetch_assoc($QryLOLRes)){
				$id_lol = $RowLOL['id'];
				$nom_lol = stripslashes($RowLOL['nom']);
				$commentaire_lol = stripslashes($RowLOL['commentaire']);
				$tab_humour[] = array('id'=>$id_lol,'nom'=>$nom_lol,'commentaire'=>$commentaire_lol);
			}
			mysql_free_result($QryLOLRes);


			//On récupère la liste des participants
			$liste_participants = '';
			$QryParticipant = 'SELECT id, commentaire FROM ProfilsNoel ORDER BY id ASC';
			$QryParticipantRes = mysql_query($QryParticipant,$link_mysql);
			while($RowParticipant = mysql_fetch_assoc($QryParticipantRes)){
				$id_participant = $RowParticipant['id'];
				$commentaire_participant = stripslashes($RowParticipant['commentaire']);
				$liste_participants .= '<li id="li_'.$id_participant.'">';
				$liste_participants .= '<img id="profil'.$id_participant.'" src="assets/img/profils/'.$id_participant.'.jpg" alt="" width="320" class="img_responsive img_shadow" />';
				$liste_participants .= '<p class="texts_res com_part" style="display:none;">';
				$liste_participants .= $commentaire_participant;
				$liste_participants .= '</p>';
				$liste_participants .= '</li>';
			}
			mysql_free_result($QryParticipantRes);

			//On marque le code comme utilisé
			$QryUsed = 'UPDATE ProfilsNoel SET used = 1 WHERE id = \''.$RowSelect['id'].'\'';
			mysql_query($QryUsed,$link_mysql);



			$affichage = 'cadeau';
		}


	}else{
		//erreur identification
		$messsage_erreur.='Tu t\'es planté de code, bolosse.<br><br>';
		$affichage = 'normal';

	}
}

$messsage_erreur .= '
		<form class="form-inline signup" role="form" action="noel.php" method="get">
				<div class="form-group">
					<input type="text" class="form-control" id="c" name="c" placeholder="Rentre ton code">
				</div>
				<button type="submit" class="btn btn-theme">Allez, viens.</button>
			</form>';

mysql_close($link_mysql);
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
        <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	    <meta name="google-site-verification" content="ky3TyHIdwddXeNqauLvCrPoiozRuz_W5DQFFVcs46pA" />

	    <meta name="description" content="Repas des Copains - site pour les beurris" />
	    <meta name="keywords" content="" />

	    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="/favicon-192x192.png" sizes="192x192">
		<link rel="icon" type="image/png" href="/favicon-160x160.png" sizes="160x160">
		<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
		<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
		<meta name="msapplication-TileColor" content="#333e52">
		<meta name="msapplication-TileImage" content="/mstile-144x144.png">

	    <title>Repas des Copains</title>

	    <!-- Bootstrap -->
	    <link href="assets/css/bootstrap.css" rel="stylesheet">
		<link href="assets/css/bootstrap-theme.css" rel="stylesheet">

	    <!-- siimple style -->
	    <link href="assets/css/style.css" rel="stylesheet">

	    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
	      <script src="assets/js/html5shiv.js"></script>
	      <script src="assets/js/respond.min.js"></script>
	    <![endif]-->

	    <link rel="stylesheet" href="assets/css/jquery-ui.css">

	    <?php include('includes/analyticstracking.php'); ?>
    </head>
    <body>
		<div id="wrapper">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12">
						<h1>Le repas des copains</h1>

						<?php  if ($affichage=='normal'){ ?>


							<?=$messsage_erreur?>


						<?php }elseif($affichage=='cadeau'){?>

							<!-- Affichage résultat -->

								<span id="vitesse"></span>
								<h2 class="subtitle texts_tirage"><span class="small">Tirage en cours, ne bougez pas.</span></h2>

								<p class="texts_res" style="display:none;" id="text_resultat"><strong><?=$nom?></strong>, tu dois offrir un cadeau &agrave; <strong><?=$nom_gagnant?></strong>. <br><br>
								<?=$nom_gagnant?> c'est <?php echo $genre_txt['lui']; ?> : <br></p>

								<p style="display:none;" id="text_resultat_humour"></p>

								<div class="slideshow" id="slideshow">
								    <ul>
								    <?php echo $liste_participants; ?>
								    </ul>
								</div>

								<script type="text/javascript">
									var tab_humour = <?php echo json_encode($tab_humour); ?>;
									var id_gagnant = <?php echo $id_gagnant;?>;
								</script>


							<!-- Fin Affichage résultat -->


						<?php }?>
					</div>
				</div>
			</div>
		</div>
		<script src="assets/js/jquery-1.10.2.min.js"></script>
  		<script src="assets/js/jquery-ui.js"></script>
  		<script src="assets/js/jquery.cookie.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>

		<script src="assets/js/script.js"></script>
	</body>
</html>
