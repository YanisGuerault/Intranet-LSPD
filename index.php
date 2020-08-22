<?php 

session_start(); 

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