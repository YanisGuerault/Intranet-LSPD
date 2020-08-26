<?php 

session_start(); 

?>

<?php 

date_default_timezone_set('Europe/Paris');
$now = date('d-m-Y H:i:s');
$delay = 0.1;
$message = "";
$moi = $_SESSION['id'];
$jesuis = $_SESSION['utilisateur']; 
$monmdp = $_SESSION['motdepasse']; 
$monniveau = $_SESSION['grade'];
$monmatricule = $_SESSION['matricule'];
$jesuisrh = $_SESSION['rh'];
$jesuisadmin = $_SESSION['isadmin'];
$jesuissuperadmin = $_SESSION['issuperadmin'];

$level = "";

if 		($monniveau  == '1') { $level = 'Cadet'; } 
else if ($monniveau  == '2') { $level = 'Officier I'; } 
else if ($monniveau  == '3') { $level = 'Officier II'; }
else if ($monniveau  == '4') { $level = 'Officier III'; }
else if ($monniveau  == '5') { $level = 'Sergent I'; }
else if ($monniveau  == '6') { $level = 'Sergent II'; }
else if ($monniveau  == '7') { $level = 'Sergent Chef'; }
else if ($monniveau  == '8') { $level = 'Lieutenant I'; }
else if ($monniveau  == '9') { $level = 'Lieutenant II'; }
else if ($monniveau  == '10') { $level = 'Lieutenant en Chef'; }
else if ($monniveau  == '11') { $level = 'Capitaine'; }
else if ($monniveau  == '12') { $level = 'Capitaine en Chef'; }
else if ($monniveau  == '13') { $level = 'Commandant Adjoint'; }
else if ($monniveau  == '14') { $level = 'Commandant'; }
else if ($monniveau  == '15') { $level = 'Staff'; }

?>