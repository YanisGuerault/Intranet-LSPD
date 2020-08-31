<?php include 'config.php'; ?>
<?php include 'globals.php'; ?>
<?php  if ($monniveau <= '0') { header("Location: index.php"); } ?>


<html lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  	<link rel="stylesheet" href="css/menu.css" media="screen">
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="shortcut icon" type="image/png" href="css/img/favicon.png" >
</head>

<body>
	<header id="header">
		<!----------si tout les acces --------------->

		<?php if ($jesuisrh == '1' && $jesuisadmin == '1' && $jesuissuperadmin == '1' && $monniveau >= '2') { ?>
			<nav class="links" style="--items: 10;">
		<?php } ?>

		<!----------si deux acces --------------->

		<?php if ($jesuisrh == '1'  && $jesuisadmin == '1' && $jesuissuperadmin == '0' && $monniveau >= '2') { ?>
			<nav class="links" style="--items: 10;">
		<?php } ?>
		<?php if ($jesuisrh == '1'  && $jesuisadmin == '0' && $jesuissuperadmin == '1' && $monniveau >= '2') { ?>
			<nav class="links" style="--items: 10;">
		<?php } ?>
		<?php if ($jesuisrh == '0'  && $jesuisadmin == '1' && $jesuissuperadmin == '1' && $monniveau >= '2') { ?>
			<nav class="links" style="--items: 10;">
		<?php } ?>


		<!----------si seulement un acces --------------->

		<?php if ($jesuisrh == '0' && $jesuisadmin == '0' && $jesuissuperadmin == '1' && $monniveau >= '2') { ?>
			<nav class="links" style="--items: 10;">
		<?php } ?>
		<?php if ($jesuisrh == '1' && $jesuisadmin == '0' && $jesuissuperadmin == '0' && $monniveau >= '2') { ?>
			<nav class="links" style="--items: 10;">
		<?php } ?>
		<?php if ($jesuisrh == '0' && $jesuisadmin == '1' && $jesuissuperadmin == '0' && $monniveau >= '2') { ?>
			<nav class="links" style="--items: 10;">
		<?php } ?>

		<!----------si simple utilisateur ---------------->

		<?php if ($jesuisrh == '0' && $jesuisadmin == '0' && $jesuissuperadmin == '0' && $monniveau >= '2') { ?>
			<nav class="links" style="--items: 8;">
		<?php } ?>
		<?php if ($jesuisrh == '0' && $jesuisadmin == '0' && $jesuissuperadmin == '0' && $monniveau == '1') { ?>
			<nav class="links" style="--items: 3;">
		<?php } ?>

			<a href="accueil.php"><i class="fas fa-home"></i> Accueil</a>

		<?php if ($monniveau >= '2') : ?>
			<a href="gst_rapport.php"><i class="fas fa-copy"></i> Rapport</a>
			<a href="gst_plainte.php"><i class="fas fa-folder-open"></i> Plainte</a>
			<a href="gst_casier.php"><i class="fas fa-archive"></i> Casier Judiciaire</a>
			<a href="gst_avis_de_recherche.php"><i class="fas fa-thumbtack"></i> Personnes Recherché</a>
            <a href="gst_bracelet.php"><i class="fas fa-link"></i></i> Bracelet</a>
		<?php endif; ?>

		<?php if ($jesuisrh == '1' OR $jesuisadmin == '1' OR $jesuissuperadmin == '1') : ?>
			<a href="log_panel.php"><i class="fas fa-history"></i> Log Panel</a>
			<a href="gst_users.php"><i class="fas fa-users-cog"></i></i> Gestion Compte</a>
		<?php endif; ?>
		
			<a href="my_account.php"><i class="fas fa-user-alt"></i> <?php echo $jesuis; ?> | <?php echo $level; ?></a>
			<a href="logout.php"><i class="fas fa-sign-out-alt"></i> Se Déconnecter</a>
			
	</header>
</body>
</html>