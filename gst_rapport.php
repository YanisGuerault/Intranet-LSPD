<?php include 'menu.php'; ?>
<?php  if ($monniveau < '2') { header("Location: index.php"); } ?>

<?php
    $reqSQL = "SELECT * FROM rapport ORDER BY id DESC" ;
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
if( isset( $_POST['add_rapport'] ) ) {
    if(isset($_POST['lieu']))      $lieu=addslashes($_POST['lieu']); 
    else      $lieu='';
    if(isset($_POST['nom_crim']))      $nom_crim=addslashes($_POST['nom_crim']); 
    else      $nom_crim='';
    if(isset($_POST['maison_crim']))      $maison_crim=addslashes($_POST['maison_crim']); 
    else      $maison_crim='';
    if(isset($_POST['qst_1']))      $qst_1=addslashes($_POST['qst_1']); 
    else      $qst_1='';
    if(isset($_POST['rep_1']))      $rep_1=addslashes($_POST['rep_1']); 
    else      $rep_1='';
    if(isset($_POST['qst_2']))      $qst_2=addslashes($_POST['qst_2']); 
    else      $qst_2='';
    if(isset($_POST['rep_2']))      $rep_2=addslashes($_POST['rep_2']); 
    else      $rep_2='';
    if(isset($_POST['qst_3']))      $qst_3=addslashes($_POST['qst_3']); 
    else      $qst_3='';
    if(isset($_POST['rep_3']))      $rep_3=addslashes($_POST['rep_3']); 
    else      $rep_3='';
    if(isset($_POST['qst_4']))      $qst_4=addslashes($_POST['qst_4']); 
    else      $qst_4='';
    if(isset($_POST['rep_4']))      $rep_4=addslashes($_POST['rep_4']); 
    else      $rep_4='';
    if(isset($_POST['qst_5']))      $qst_5=addslashes($_POST['qst_5']); 
    else      $qst_5='';
    if(isset($_POST['rep_5']))      $rep_5=addslashes($_POST['rep_5']); 
    else      $rep_5='';
    if(isset($_POST['rap_situ']))      $rap_situ=addslashes($_POST['rap_situ']); 
    else      $rap_situ='';
    if(isset($_POST['preuve']))      $preuve=addslashes($_POST['preuve']); 
    else      $preuve='';

    $sql = mysqli_query ($con, 
    "INSERT INTO rapport (quand, lieu, utilisateur, matri, grade, nom_crim, maison_crim, qst_1, rep_1, qst_2, rep_2, qst_3, rep_3, qst_4, rep_4, qst_5, rep_5, rap_situ, preuve, etat, signa) 
    VALUES('$now','$lieu','$jesuis','$monmatricule','$level','$nom_crim','$maison_crim','$qst_1','$rep_1','$qst_2','$rep_2','$qst_3','$rep_3','$qst_4','$rep_4','$qst_5','$rep_5','$rap_situ','$preuve','1','$level - $jesuis')" ); 
    $sql2 = mysqli_query ($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$jesuis', 'A ajouter un Rapport !', '$now')" );
    $message = "<h3><p>Le rapport à bien été ajouter !</p></h3>";
    header("Refresh: $delay;"); 
    mysql_close();
}
?>
<?php 
if( isset( $_POST['delete_rapport'] ) ) { 
    $id_rapport = $_POST['id_rapport'];
    $delete = mysqli_query($con, "DELETE FROM rapport WHERE id = $id_rapport ");
    $delete_log = mysqli_query ($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$jesuis', 'A supprimer le  Rapport ($id_rapport) !', '$now')" );
    header("Refresh: $delay;"); 
    mysql_close();
}
?>

<body>
<br><br><br><br><br><br><br><br><br>
<center><h1>Liste des Rapports</h1></center>
<br><br>
<?php if ($monniveau >= '2') : ?>
<input class="mainLoginInput" style="width:30%;  height:3.3%; margin-left:45.3%" type='text' id='myInput' onkeyup='search()' placeholder='&#61442; Tapez votre recherche'/>
<button id="myBtn" class="add">
    <i class="fas fa-plus" style="font-size: 13;"></i> Ajouter un Rapport
</button>
<?php endif; ?>
<br><br>

<center>
    <div style="width:80%; margin-left:12%; margin-top:-10% " id="myModal" class="modal">
    <br><br><br><br><br><br><br><br><br><br>
        <div class="modal-content" >
            <span class="close">&times;</span>
            <form method="POST">
                <h1>Ajouter un Rapport</h1>
                <?php if($message!="") { echo $message; } ?><br>

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
                    <i class="fas fa-user-alt-slash icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Entrer le nom du suspect" name="nom_crim" maxlength="99" required>
                    <i class="fas fa-reply icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Entrer le lieu de résidence du suspect" name="maison_crim" maxlength="99">
                </div>

                <div class="input-container">
                    <i class="fas fa-question icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Question 1" name="qst_1">
                    <i class="fas fa-reply icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Réponse 1" name="rep_1">
                </div>

                <div class="input-container">
                    <i class="fas fa-question icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Question 2" name="qst_2">
                    <i class="fas fa-reply icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Réponse 2" name="rep_2">
                </div>

                <div class="input-container">
                    <i class="fas fa-question icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Question 3" name="qst_3">
                    <i class="fas fa-reply icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Réponse 3" name="rep_3">
                </div>

                <div class="input-container">
                    <i class="fas fa-question icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Question 4" name="qst_4">
                    <i class="fas fa-reply icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Réponse 4" name="rep_4">
                </div>

                <div class="input-container">
                    <i class="fas fa-question icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Question 5" name="qst_5">
                    <i class="fas fa-reply icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Réponse 5" name="rep_5">
                </div>

                <h2 style="text-align:left; font-size: 15px;">Rapport de Situation :</h2>
                <TEXTAREA class="input-field" type="text" style="resize:none; height:15%" placeholder="Tapez le Rapport de situation" name="rap_situ"></TEXTAREA>

                <h2 style="text-align:left; font-size: 15px;">Preuve :</h2>
                <TEXTAREA class="input-field" type="text" style="resize:none; height:15%" placeholder="Merci de mettre les preuves ici ! Pour les photos merci de les mettrent sur un hébergeur !" name="preuve"></TEXTAREA>
                <input type="submit" value="Signature" name= "add_rapport">
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
                    <center><b><i class="fas fa-copy"></i> | Numéro Rapport</b></center>
                </th>
                <th>
                    <center><b><i class='fas fa-user'></i> | Agent</b></center>
                </th>
                <th>
                    <center><b><i class="fas fa-id-badge"></i> | Matricule</b></center>
                </th>
                <th>
                    <center><b><i class="fas fa-user-alt-slash"></i> | Agresseur</b></center>
                </th>
                <th>
                    <center><b><i class="fas fa-folder-open"></i> | Etat du Rapport</b></center>
                </th>
                <th>
                    <center><b><i class="fas fa-eye"></i> | Action</b></center>
                </th>
            </tr>
        </thead>
        <?php while( $row = mysqli_fetch_array($resultat) ) :?>
            <tbody id="myTable">
                    <td>
                        <?php echo $row['id'];?>
                    </td>
                    <td>
                        <?php echo $row['utilisateur'];?>
                    </td>
                    <td>
                        <?php echo $row['matri'];?>
                    </td>
                    <td>
                        <?php echo $row['nom_crim'];?>
                    </td>
                    <td>
                        <?php if($row['etat'] == '1') :?>
                            Ouvert
                        <?php endif;?>
                        <?php if($row['etat'] == '2') :?>
                            Fermée
                        <?php endif;?>
                    </td>
                    <td>
                        <center>
                        <form method='POST'>
                            <a href="rapport.php?id=<?php echo $row['id']; ?>" class='edit'><i class="fas fa-eye"></i></a>
                            <?php if ($jesuisadmin == '1') :?>
                            <button type='submit' value='delete_rapport' name='delete_rapport' class='del'>
                                <input type='hidden' name='id_rapport' value=<?php echo $row['id']; ?>>
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