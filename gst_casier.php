<?php include 'menu.php'; ?>
<?php  if ($monniveau < '2') { header("Location: index.php"); } ?>

<?php
    $reqSQL = "SELECT * FROM casier ORDER BY id DESC" ;
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
if( isset( $_POST['add_cassier'] ) ) {
    if(isset($_POST['lieu']))      $lieu=addslashes($_POST['lieu']);
    else      $lieu='';
    if(isset($_POST['nom_crim']))      $nom_crim=addslashes($_POST['nom_crim']);
    else      $nom_crim='';
    if(isset($_POST['sexe']))      $sexe=addslashes($_POST['sexe']);
    else      $sexe='';
    if(isset($_POST['taille']))      $taille=addslashes($_POST['taille']);
    else      $taille='';
    if(isset($_POST['date_de_naissance']))      $date_de_naissance=addslashes($_POST['date_de_naissance']);
    else      $date_de_naissance='';
    if(isset($_POST['piece_id']))      $piece_id=addslashes($_POST['piece_id']);
    else      $piece_id='';

    $sql = mysqli_query ($con, "INSERT INTO casier (quand, utilisateur, lieu, nom_crim, date_de_naissance, sexe, taille, piece_id)  VALUES('$now','$moi','$lieu','$nom_crim','$date_de_naissance','$sexe','$taille','$piece_id')" );
    $sql2 = mysqli_query ($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$jesuis', 'A ajouter un casier a ($nom_crim) !', '$now')" );
    header("Refresh: $delay;"); 
    mysql_close();
}
?>

<body>
<br><br><br><br><br><br><br><br><br>
<center><h1>Liste des Casiers Judiciaire</h1></center>
<br><br>
<input class="mainLoginInput" style="width:30%;  height:3.3%; margin-left:45.3%" type='text' id='myInput' onkeyup='search()' placeholder='&#61442; Tapez votre recherche'/>
<button id="myBtn" class="add">
    <i class="fas fa-plus" style="font-size: 13;"></i> Ajouter un casier
</button>
<br><br>

<center>
    <div style="width:80%; margin-left:12%; margin-top:-10% " id="myModal" class="modal">
    <br><br><br><br><br><br><br><br><br><br>
        <div class="modal-content" >
            <span class="close">&times;</span>
            <form method="POST">
                <h1>Ajouter un casier judiciaire</h1>
        
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
                    <input class="input-field" type="text" placeholder="Entrer le nom du criminel" name="nom_crim" maxlength="99" required>
                    <i class="fas fa-transgender-alt icon"></i>
                    <select class="input-field custom-select" name="sexe">
                        <option value="m">Homme</option>
                        <option value="f">Femme</option>
                    </select>
                </div>

                <div class="input-container">
                    <i class="fas fa-long-arrow-alt-up icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Entrer la taille du criminel" name="taille" maxlength="3" required>
                    <i class="fas fa-birthday-cake icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Entrer la date de naissance du criminel" name="date_de_naissance" maxlength="49" required>
                </div>

                <h2 style="text-align:left; font-size: 15px;">Pièce d'identité :</h2>
                <TEXTAREA class="input-field" type="text" style="resize:none; height:15%" placeholder="Pour les photos merci de les mettrent sur un hébergeur !" name="piece_id" required></TEXTAREA>
                <input type="submit" value="Ajouter" name= "add_cassier">
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
                    <center><b><i class="fas fa-user-alt-slash"></i> | Nom Criminel</b></center>
                </th>
                <th>
                    <center><b><i class="fas fa-transgender-alt"></i> | Sexe Criminel</b></center>
                </th>
                <th>
                    <center><b><i class="fas fa-eye"></i> | Action</b></center>
                </th>
            </tr>
        </thead>
        <?php while( $row = mysqli_fetch_array($resultat) ) :?>
            <tbody id="myTable">
                    <td>
                        <?php echo $row['nom_crim'];?>
                    </td>
                    <td>
                        <?php if($row['sexe'] == "m") :?>
                        Homme
                        <?php endif;?>
                        <?php if($row['sexe'] == "f") :?>
                        Femme
                        <?php endif;?>
                    </td>
                    <td>
                        <center>
                            <a href="casier.php?id=<?php echo $row['id']; ?>" class='edit'><i class="fas fa-eye"></i></a>
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