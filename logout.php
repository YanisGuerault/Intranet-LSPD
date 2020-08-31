<?php

session_start([
    'cookie_lifetime' => 86400,
    'read_and_close'  => true,
]);
unset($_SESSION['id']);
unset($_SESSION['utilisateur']);
unset($_SESSION['motdepasse']);
unset($_SESSION['grade']);
unset($_SESSION['matricule']);
unset($_SESSION['rh']);
unset($_SESSION['isadmin']);
unset($_SESSION['issuperadmin']);
header('Location: login.php');

?>