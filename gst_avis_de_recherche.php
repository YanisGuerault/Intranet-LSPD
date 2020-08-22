<?php include 'menu.php'; ?>
<?php  if ($monniveau < '2') { header("Location: index.php"); } ?>

<?php
    $reqSQL = "SELECT * FROM avis_de_recherche ORDER BY id DESC" ;
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
if( isset( $_POST['add_avis'] ) ) {
    if(isset($_POST['nom_crim']))      $nom_crim=addslashes($_POST['nom_crim']);
    else      $nom_crim='';
    if(isset($_POST['sexe']))      $sexe=addslashes($_POST['sexe']);
    else      $sexe='';
    if(isset($_POST['pourquoi']))      $pourquoi=addslashes($_POST['pourquoi']);
    else      $pourquoi='';

    $sql = mysqli_query ($con, "INSERT INTO avis_de_recherche (quand, utilisateur, matri, grade, nom_crim, sexe, pourquoi)  VALUES('$now','$jesuis','$monmatricule','$level','$nom_crim','$sexe','$pourquoi')" ); 
    $sql2 = mysqli_query ($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$jesuis', 'A ajouter ($nom_crim) a la liste des personnes rechercher !', '$now')" );
    header("Refresh: $delay;"); 
    mysql_close();
}
?>
<?php
if( isset( $_POST['delete'] ) ) {
    $id = $_POST['id'];
    $nom_crim = $_POST['nom_crim'];
    $sql = mysqli_query($con, "DELETE FROM avis_de_recherche WHERE id = $id ");
    $sql2 = mysqli_query ($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$jesuis', 'A suprimer ($nom_crim) des personnes rechercher !', '$now')" );
    header("Refresh: $delay;"); 
    mysql_close();
}
?>

<body>
<br><br><br><br><br><br><br><br><br>
<center><h1>Liste des Personnes Recherché</h1></center>
<br><br>
<input class="mainLoginInput" style="width:30%;  height:3.3%; margin-left:45.3%" type='text' id='myInput' onkeyup='search()' placeholder='&#61442; Tapez votre recherche'/>
<button id="myBtn" class="add">
    <i class="fas fa-plus" style="font-size: 13;"></i> Ajouter une personne
</button>
<br><br>

<center>
    <div style="width:80%; margin-left:12%; margin-top:-10% " id="myModal" class="modal">
    <br><br><br><br><br><br><br><br><br><br>
        <div class="modal-content" >
            <span class="close">&times;</span>
            <form method="POST">
                <h1>Ajouter une personne</h1>
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
                    <i class="fas fa-user-alt-slash icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Entrer le nom du criminel" name="nom_crim" maxlength="99" required>
                    <i class="fas fa-transgender-alt icon"></i>
                    <select class="input-field custom-select" name="sexe">
                        <option value="m">Homme</option>
                        <option value="f">Femme</option>
                    </select>
                </div>

                <div class="input-container">
                    <i class="fas fa-exclamation icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Entrer la raison" name="pourquoi" maxlength="99" required>
                </div>

                <input type="submit" value="Ajouter" name= "add_avis">
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
                    <center><b><i class="fas fa-calendar-alt"></i> | Date d'ajout</b></center>
                </th>
                <th>
                    <center><b><i class="fas fa-user"></i> | Agent</b></center>
                </th>
                <th>
                    <center><b><i class="fas fa-id-badge"></i> | Matricule</b></center>
                </th>
                <th>
                    <center><b><i class="fas fa-user-alt-slash"></i> | Nom Criminel</b></center>
                </th>
                <th>
                    <center><b><i class="fas fa-exclamation"></i> | Raison</b></center>
                </th>
                <th>
                    <center><b><i class="fas fa-eye"></i> | Action</b></center>
                </th>
            </tr>
        </thead>
        <?php while( $row = mysqli_fetch_array($resultat) ) :?>
            <tbody id="myTable">
                    <td>
                        <center>
                            <?php echo $row['quand'];?>
                        </center>
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
                        <?php echo $row['pourquoi'];?>
                    </td>
                    <td>
                        <center>
                            <form method = "POST">
                                <?php if ($jesuis == $row['utilisateur'] OR $jesuisadmin == '1' OR $jesuisrh == '1') :?>
                                <button type='submit' value='delete' name='delete' class='delete'>
                                    <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                    <input type='hidden' name='nom_crim' value=<?php echo $row['nom_crim']; ?>>
                                    <i class='fas fa-trash-alt'></i>
                                </button>
                                <?php endif;?>
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