<?php include 'menu.php'; ?>
<?php  if ($monniveau < '2') { header("Location: index.php"); } ?>

<?php

$id = $_REQUEST['id'];

$query = "SELECT * FROM casier WHERE id = '$id' " ;
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

$idu = $row["utilisateur"];
$query2 = "SELECT * FROM compte_lspd WHERE id = '$idu' " ;
$result2 = mysqli_query($con, $query2);
$row2 = mysqli_fetch_assoc($result2);

$nom_crim = $row['nom_crim'];

$query1 = "SELECT * FROM infraction WHERE casier = '$id' ORDER BY id DESC" ;
$resultat = $con->query($query1);

?>
<?php 
if( isset( $_POST['add_infraction'] ) ) {
    if(isset($_POST['infraction']))      $infraction=addslashes($_POST['infraction']);
    else      $infraction='';
    $sql = mysqli_query ($con, "INSERT INTO infraction (casier, utilisateur, quand, infra)  VALUES('$id','$moi','$now','$infraction')" );
    $sql2 = mysqli_query ($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$moi', 'A ajouter une infraction a ($nom_crim) !', '$now')" );
    header("Refresh: $delay;"); 
    mysql_close();
}
?>
<?php 
if( isset( $_POST['delete_infration'] ) ) { 
    $id_infration = $_POST['id_infration'];
    $delete_permis = mysqli_query($con, "DELETE FROM infraction WHERE id = $id_infration ");
    $delete_permis_log = mysqli_query ($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$moi', ' A supprimer une infraction a ($nom_crim) !', '$now')" );
    header("Refresh: $delay;"); 
    mysql_close();
}
?>
<?php 
if( isset( $_POST['delete_casier'] ) ) { 
    $delete_from_casier = mysqli_query($con, "DELETE FROM casier WHERE id = '$id' ");
    $delete_from_infraction = mysqli_query($con, "DELETE FROM infraction WHERE casier = '$id' ");
    $delete_casier_log = mysqli_query ($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$moi', ' A supprimer le casier de ($nom_crim) !', '$now')" );
    header('Location: gst_casier.php');
    mysql_close();
}
?>
<?php
if(isset($_POST['maj_casier'])) {
    $piece_id = addslashes($_POST['piece_id']);
    $maj_casier =  mysqli_query($con, "UPDATE casier SET piece_id = '$piece_id' WHERE id = '$id' ");
    $maj_casier_log =  mysqli_query($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$moi', 'A mit a jour le casier de ($nom_crim)', '$now')" );
    header("Refresh: $delay;");
    mysql_close();
}
?>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="css/table.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="css/joueur.css" media="screen" type="text/css" />
</head>

<body>
    <br><br><br><br><br><br><br><br><br>
    <h2 style="text-align:center; font-size: 40px;">Casier Judiciaire - <?php echo $row['nom_crim'];?></h2>
    <form method='POST'>
        <button class="edit" style="width:15%;  margin-left:68.3%; font-size: 15px" name ="maj_casier">
            <i class="fas fa-upload" style="font-size: 20px;"></i> MAJ la pièce d'identité
        </button>
        <?php if ($jesuisadmin == '1') :?>
        <button class="del" style="width:15%; font-size: 15px" name ="delete_casier">
            <i class="fas fa-trash-alt" style="font-size: 20px;"></i> Suprimer le casier
        </button>
        <?php endif;?>
        <div class="columns">
            <ul class="price">
                <li class="header">Créateur Casier</li>
                <li>
                    <h2 style="text-align:left; font-size: 15px;">Casier : <?php echo $row['id'];?></h2>
                    <h2 style="text-align:left; font-size: 15px;">Créateur : <?php echo $row2['utilisateur'];?></h2>
                    <h2 style="text-align:left; font-size: 15px;">Grade : <?php echo $row2['grade'];?></h2>
                    <h2 style="text-align:left; font-size: 15px;">Matricule : <?php echo $row2['matricule'];?></h2>
                    <h2 style="text-align:left; font-size: 15px;">Date de création : <?php echo $row['quand'];?></h2>
                    <h2 style="text-align:left; font-size: 15px;">Lieu de création : <?php echo $row['lieu'];?></h2>
                </li>
            </ul>
            <ul class="price">
                <li class="header">Casier - <?php echo $row['nom_crim'];?></li>
                <li>
                    <h2 style="text-align:left; font-size: 15px;">Nom du criminel : <?php echo $row['nom_crim'];?></h2>
                    <h2 style="text-align:left; font-size: 15px;">Date de naissance : <?php echo $row['date_de_naissance'];?></h2>
                    <h2 style="text-align:left; font-size: 15px;">Sexe : <?php if($row['sexe'] == "m") { echo "Homme"; } else { echo "Femme"; }?></h2>
                    <h2 style="text-align:left; font-size: 15px;">Taille : <?php echo $row['taille'];?> cm</h2>
                    <div class="input-container">
                        <i class="fas fa-id-card icon"></i>
                        <input type="text" name="piece_id" value="<?php echo $row['piece_id'];?>" >
                    </div>
                </li>
            </ul>
        </div>
        <div class="columns" style="width:66%">
        <ul class="price">
                <li class="header">Infraction Relevée</li>
                <li>
                    <input class="input-field " style="resize:none; float: left; width: 90%" name='infraction' placeholder="Infraction relevée">
                    <button type='submit' value='add_infraction' name='add_infraction' class='add_permis'>
                        <i class="fas fa-plus"></i>
                    </button>
                    <br><br><br><br><br>
                    <div class="input-container">
                        <table style="width:100%">
                            <tr>
                                <td>
                                    <center><b><i class="far fa-calendar-alt"></i> | Date</b></center>
                                </td>
                                <td>
                                    <center><b><i class="fas fa-id-badge"></i> | Agent </b></center>
                                </td>
                                <td>
                                    <center><b><i class="fas fa-info"></i> | Infraction </b></center>
                                </td>
                                <?php if ($jesuisadmin == '1' OR $jesuisrh == '1') :?>
                                <td>
                                    <center><b><i class='fas fa-user-edit'></i> | Action</b></center>
                                </td>
                                <?php endif; ?>
                            </tr>
                            <?php while($data = mysqli_fetch_array($resultat)) :

                                $idutil = $data['utilisateur'];
                                $query2 = "SELECT * FROM compte_lspd WHERE id = '$idutil' limit 1" ;
                                $resultat2 = $con->query($query2);
                                $data2 = mysqli_fetch_array($resultat2);

                                ?>
                            <tr>
                                <td>
                                    <center><?php echo $data['quand']; ?></center>
                                </td>
                                <td>
                                    <center><?php echo $data2['grade'];?> - <?php echo $data2['utilisateur'];?> (<?php echo $data2['matricule'];?>)</center>
                                </td>
                                <td>
                                    <center><?php echo $data['infra'];?></center>
                                </td>
                                <?php if ($jesuisadmin == '1' OR $jesuisrh == '1') :?>
                                <td>
                                    <center>
                                        <form method='POST'>
                                            <button type='submit' value='delete_infration' name='delete_infration' class='del'>
                                                <input type='hidden' name='id_infration' value=<?php echo $data['id']; ?>>
                                                <i class='fas fa-trash-alt'></i>
                                            </button>
                                        </form>
                                    </center>
                                </td>
                                <?php endif; ?>
                            </tr>
                            <?php endwhile; ?>
                        </table>
                    </div>
                </li>
            </ul>
        </div>
    </form>
</body>
</html>