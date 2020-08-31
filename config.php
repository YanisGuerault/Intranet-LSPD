<?php 


function get_lspd_account_info($id)
{
    $query2 = "SELECT * FROM compte_lspd WHERE id = '$id' limit 1" ;
    $resultat2 = $GLOBALS["con"]->query($query2);
    return mysqli_fetch_array($resultat2);
}

function get_lspd_account_all()
{
    $query2 = "SELECT * FROM compte_lspd" ;
    $resultat2 = $GLOBALS["con"]->query($query2);
    return mysqli_fetch_array($resultat2);
}

function get_casier_info($id)
{
    $query2 = "SELECT * FROM casier WHERE id = '$id' limit 1" ;
    $resultat2 = $GLOBALS["con"]->query($query2);
    return mysqli_fetch_array($resultat2);
}

function get_casier_all()
{
    $query2 = "SELECT * FROM casier" ;
    $resultat2 = $GLOBALS["con"]->query($query2);
    return mysqli_fetch_array($resultat2);
}

function get_avis_recherche_info($id)
{
    $query2 = "SELECT * FROM avis_de_recherche WHERE id = '$id' limit 1" ;
    $resultat2 = $GLOBALS["con"]->query($query2);
    return mysqli_fetch_array($resultat2);
}

function get_avis_recherche_all()
{
    $query2 = "SELECT * FROM avis_de_recherche" ;
    $resultat2 = $GLOBALS["con"]->query($query2);
    return mysqli_fetch_array($resultat2);
}

function get_bracelet_info($id)
{
    $query2 = "SELECT * FROM bracelet WHERE id = '$id' limit 1" ;
    $resultat2 = $GLOBALS["con"]->query($query2);
    return mysqli_fetch_array($resultat2);
}

function get_bracelet_all()
{
    $query2 = "SELECT * FROM bracelet" ;
    $resultat2 = $GLOBALS["con"]->query($query2);
    return mysqli_fetch_array($resultat2);
}

function get_plainte_info($id)
{
    $query2 = "SELECT * FROM plainte WHERE id = '$id' limit 1" ;
    $resultat2 = $GLOBALS["con"]->query($query2);
    return mysqli_fetch_array($resultat2);
}

function get_plainte_all()
{
    $query2 = "SELECT * FROM plainte" ;
    $resultat2 = $GLOBALS["con"]->query($query2);
    return mysqli_fetch_array($resultat2);
}

function get_rapport_info($id)
{
    $query2 = "SELECT * FROM rapport WHERE id = '$id' limit 1" ;
    $resultat2 = $GLOBALS["con"]->query($query2);
    return mysqli_fetch_array($resultat2);
}

function get_rapport_all()
{
    $query2 = "SELECT * FROM rapport" ;
    $resultat2 = $GLOBALS["con"]->query($query2);
    return mysqli_fetch_array($resultat2);
}

$con = mysqli_connect ('192.168.0.25','yanis','585652yanis','LSPD_Osmoze_RP') or die ('Impossible de ce connecter');
mysqli_set_charset($con, 'utf8');

?>