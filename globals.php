<?php 

session_start([
    'cookie_lifetime' => 86400,
    'read_and_close'  => true,
]);

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

function stringFormat($string)
{
    if(isset($string)) {
        return addslashes($string);
    } else {
        return '';
    }
}

function get_grade($niveau)
{
    if 		($niveau  == '1') { return 'Cadet'; }
    else if ($niveau  == '2') { return 'Officier I'; }
    else if ($niveau  == '3') { return 'Officier II'; }
    else if ($niveau  == '4') { return 'Officier III'; }
    else if ($niveau  == '5') { return 'Sergent I'; }
    else if ($niveau  == '6') { return 'Sergent II'; }
    else if ($niveau  == '7') { return 'Sergent Chef'; }
    else if ($niveau  == '8') { return 'Lieutenant I'; }
    else if ($niveau  == '9') { return 'Lieutenant II'; }
    else if ($niveau  == '10') { return 'Lieutenant en Chef'; }
    else if ($niveau  == '11') { return 'Capitaine'; }
    else if ($niveau  == '12') { return 'Capitaine en Chef'; }
    else if ($niveau  == '13') { return 'Commandant Adjoint'; }
    else if ($niveau  == '14') { return 'Commandant'; }
    else if ($niveau  == '15') { return 'Staff'; }
    return 'Aucun grade';
}

?>