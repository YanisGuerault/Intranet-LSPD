<?php

session_start();
unset($_SESSION['id']);
unset($_SESSION['utilisateur']);
unset($_SESSION['motdepasse']);
unset($_SESSION['grade']);
unset($_SESSION['matricule']);
unset($_SESSION['rh']);
unset($_SESSION['isadmin']);
header('Location: login.php');

?>