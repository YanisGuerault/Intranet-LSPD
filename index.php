<?php 

session_start([
    'cookie_lifetime' => 86400,
    'read_and_close'  => true,
]);

?>

<?php 

if($_SESSION['utilisateur']) 
{
    header('Location: accueil.php');
} 
else  
{
    header('Location: login.php'); 
}

?>