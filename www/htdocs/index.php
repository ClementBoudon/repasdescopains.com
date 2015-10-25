<?php

  include_once('config.php');

  include_once('includes/libs_logs.inc.php');


  $link_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass) or die("Impossible de se connecter : " . mysql_error());
  mysql_set_charset ( 'utf8',$link_mysql );
  mysql_select_db($mysql_database,$link_mysql);


  log_all($link_mysql);

  mysqli_close($link_mysql);

?><!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="google-site-verification" content="ky3TyHIdwddXeNqauLvCrPoiozRuz_W5DQFFVcs46pA" />

    <meta name="description" content="Repas des Copains - Site pour les Beurris" />
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
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <?php include('includes/analyticstracking.php'); ?>
  </head>

  <body>
	<div id="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<h1>Le repas des copains</h1>
          <?php if (isset($_GET['c']) and $_GET['c'] != ''){ ?>
            <p class="bg-danger text-danger">Tu me vexes en essayant ça, tu sais.</p>
          <?php } ?>
					<h2 class="subtitle">Toi aussi d&eacute;couvre qui tu vas d&eacute;cevoir cette ann&eacute;e.</h2>
					<h2 class="subtitle"><span class="small">(Parce que oui, Pierre, un iPhone 6S sera toujours mieux que tes "d&eacute;lires d'artiste")</span></h3>
					<img src="assets/img/pourri.jpg" class="img_responsive img_shadow">
					<!--
          <h2 class="subtitle">Pour conna&icirc;tre l'heureux-se &eacute;lu-e, reviens dans :</h2>
					<div id="countdown"></div>
          <h2 class="subtitle"><span class="small">(Ou peut-&ecirc;tre avant)</span></h3>
           -->

          <h2 class="subtitle">Pour conna&icirc;tre l'heureux-se &eacute;lu-e, saisis ton code :</h2>
          <br>
          <form class="form-inline signup" role="form" action="noel.php" method="get">
						<div class="form-group">
							<input type="text" class="form-control" id="c" name="c" placeholder="Rentre ton code">
						</div>
						<button type="submit" class="btn btn-theme">Allez, viens.</button>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-lg-offset-3">
						<p class="copyright">Cl&eacute;ment Boudon</p>
                        <p><h6><a href="http://bootstraptaste.com" target="_blank">Th&egrave;me Webuild Bootstraptaste.com</a></h6></p>
				</div>
			</div>
		</div>
	</div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.countdown.min.js"></script>
	<script type="text/javascript">
  $('#countdown').countdown('2015/10/25 20:30:00', function(event) {
    $(this).html(event.strftime('<strong>%-D</strong> jour%!D,<br /> <strong>%-H</strong> heure%!H, <strong>%-M</strong> minute%!M et <strong>%-S</strong> seconde%!S'));
  });
</script>
  </body>
</html>
