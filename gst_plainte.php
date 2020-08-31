<?php include 'menu.php'; ?>
<?php  if ($monniveau < '2') { header("Location: index.php"); } ?>

<?php
    $reqSQL = "SELECT * FROM plainte ORDER BY id DESC" ;
    $resultat  = $con->query($reqSQL);
?>

<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="css/table.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="css/button.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="css/joueur.css" media="screen" type="text/css" />
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

$(document).ready(function(){
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>

<?php 
if( isset( $_POST['add_plainte'] ) ) {
    if(isset($_POST['lieu']))      $lieu=addslashes($_POST['lieu']);
    else      $lieu='';
    if(isset($_POST['victime']))      $victime=addslashes($_POST['victime']);
    else      $victime='';
    if(isset($_POST['tel_victime']))      $tel_victime=addslashes($_POST['tel_victime']);
    else      $tel_victime='';
    if(isset($_POST['suspect']))      $suspect=addslashes($_POST['suspect']);
    else      $suspect='';
    if(isset($_POST['tel_suspect']))      $tel_suspect=addslashes($_POST['tel_suspect']);
    else      $tel_suspect='';
    if(isset($_POST['des_info_suspect']))      $des_info_suspect=addslashes($_POST['des_info_suspect']);
    else      $des_info_suspect='';
    if(isset($_POST['vers_victime']))      $vers_victime=addslashes($_POST['vers_victime']);
    else      $vers_victime='';
    if(isset($_POST['preuve']))      $preuve=addslashes($_POST['preuve']);
    else      $preuve='';
    
    $sql = mysqli_query ($con, 
    "INSERT INTO plainte (quand, lieu, utilisateur, victime, tel_victime, suspect, tel_suspect, des_info_suspect, vers_victime, vers_suspect, preuve, etat, signa) 
    VALUES('$now','$lieu','$moi','$victime','$tel_victime','$suspect','$tel_suspect','$des_info_suspect', '$vers_victime','','$preuve','1','$victime & $jesuis')" );
    $sql2 = mysqli_query ($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$moi', 'A ajouter une Plainte !', '$now')" );
    $message = "<h3><p>La plainte à bien été ajouter !</p></h3>";
    header("Refresh: $delay;"); 
    mysql_close();
}
?>
<?php 
if( isset( $_POST['delete_plainte'] ) ) { 
    $id_plainte = $_POST['id_plainte'];
    $delete = mysqli_query($con, "DELETE FROM plainte WHERE id = $id_plainte ");
    $delete_log = mysqli_query ($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$moi', 'A supprimer la Plainte ($id_plainte) !', '$now')" );
    header("Refresh: $delay;"); 
    mysql_close();
}
?>

<body>
<br><br><br><br><br><br><br><br><br>
<center><h1>Liste des Plaintes</h1></center>
<br><br>
<?php if ($monniveau >= '2') : ?>
<input class="mainLoginInput" style="width:30%;  height:3.3%; margin-left:45.3%" type='text' id='myInput' onkeyup='search()' placeholder='&#61442; Tapez votre recherche'/>
<button id="myBtn" class="add">
    <i class="fas fa-plus" style="font-size: 13;"></i> Ajouter une Plainte
</button>
<?php endif; ?>
<br><br>

<center>
    <div style="width:80%; margin-left:12%; margin-top:-10% " id="myModal" class="modal">
    <br><br><br><br><br><br><br><br><br><br>
        <div class="modal-content" >
            <span class="close">&times;</span>
            <form method="POST">
                <h1>Ajouter une Plainte</h1>
        
                <div class="input-container">
                    <i class="far fa-calendar-alt icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" value="<?php echo $now;?>" readonly>
                    <i class="fas fa-user-alt icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" value="<?php echo $jesuis;?>" readonly>
                    <i class="fas fa-sort-amount-up icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" value="<?php echo $level;?>" readonly>
                    <i class="fas fa-id-badge icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" value="<?php echo $monmatricule;?>" readonly>
                </div>

                <div class="input-container">
                    <i class="fas fa-map-marked-alt icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Entrer le lieu" name="lieu" maxlength="99" required>
                    <i class="fas fa-id-card icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Entrer le nom de la victime" name="victime" maxlength="99" required>
                    <i class="fas fa-phone icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Entrer son numéro de téléphone" name="tel_victime" maxlength="99" required>
                </div>

                <div class="input-container">
                    <i class="fas fa-id-card icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Entrer le nom du suspect" name="suspect" maxlength="99">
                    <i class="fas fa-phone icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Entrer le numéro de téléphone du suspect" name="tel_suspect" maxlength="99">
                </div>

                <h2 style="text-align:left; font-size: 15px;">Info / Description Suspect :</h2>
                <TEXTAREA class="input-field" type="text" style="resize:none; height:15%" placeholder="Tapez les informations sur le suspect ainsi que ça description" name="des_info_suspect"></TEXTAREA>

                <h2 style="text-align:left; font-size: 15px;">Version de la victime :</h2>
                <TEXTAREA class="input-field" type="text" style="resize:none; height:15%" placeholder="Tapez la Version de la victime" name="vers_victime" required></TEXTAREA>

                <h2 style="text-align:left; font-size: 15px;">Preuve :</h2>
                <TEXTAREA class="input-field" type="text" style="resize:none; height:15%" placeholder="Merci de mettre les preuves ici ! Pour les photos merci de les mettrent sur un hébergeur !" name="preuve"></TEXTAREA>

                <input type="submit" value="Ajouter la plainte" name= "add_plainte">
            </form>
        </div>
    </div>
</center>

<script>
var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
    modal.style.display = "block";
}
span.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<center>
    <table>
        <thead>
            <tr>
                <th>
                    <center><b><i class="fas fa-copy"></i> | Numéro Plainte</b></center>
                </th>
                <th>
                    <center><b><i class='fas fa-user'></i> | Agent</b></center>
                </th>
                <th>
                    <center><b><i class="fas fa-id-badge"></i> | Matricule</b></center>
                </th>
                <th>
                    <center><b><i class="fas fa-id-card"></i> | Victime</b></center>
                </th>
                <th>
                    <center><b><i class="fas fa-folder-open"></i> | Etat de la Plainte</b></center>
                </th>
                <th>
                    <center><b><i class="fas fa-eye"></i> | Action</b></center>
                </th>
            </tr>
        </thead>
        <?php while( $row = mysqli_fetch_array($resultat) ) :

            $idutil = $row['utilisateur'];
            $query2 = "SELECT * FROM compte_lspd WHERE id = '$idutil' limit 1" ;
            $resultat2 = $con->query($query2);
            $row2 = mysqli_fetch_array($resultat2);
            ?>

            <tbody id="myTable">
                    <td>
                        <?php echo $row['id'];?>
                    </td>
                    <td>
                        <?php echo $row2['utilisateur'];?>
                    </td>
                    <td>
                        <?php echo $row2['matricule'];?>
                    </td>
                    <td>
                        <?php echo $row['victime'];?>
                    </td>
                    <td>
                        <?php if($row['etat'] == '1') :?>
                            En cours
                        <?php endif;?>
                        <?php if($row['etat'] == '2') :?>
                            Fermée
                        <?php endif;?>
                    </td>
                    <td>
                        <center>
                        <form method='POST'>
                            <a href="plainte.php?id=<?php echo $row['id']; ?>" class='edit'><i class="fas fa-eye"></i></a>
                            <?php if ($jesuisadmin == '1' OR $jesuissuperadmin == '1') :?>
                            <button type='submit' value='delete_plainte' name='delete_plainte' class='del'>
                                <input type='hidden' name='id_plainte' value=<?php echo $row['id']; ?>>
                                <i class='fas fa-trash-alt'></i>
                            </button>
                            <?php endif; ?>
                        </form>
                        </center>
                    </td>
                </tr>
            </tbody>
        <?php endwhile;?>
    </table>
<br><br>
</center>

</body>
</html>