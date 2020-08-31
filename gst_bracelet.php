<?php include 'menu.php'; ?>
<?php  if ($monniveau < '2') { header("Location: index.php"); } ?>

<?php
    $reqSQL = "SELECT * FROM bracelet ORDER BY id DESC" ;
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
if( isset( $_POST['add_bracelet'] ) ) {
    $nom_crim = stringFormat($_POST['criminel']);
    $pourquoi = stringFormat($_POST['pourquoi']);
    $date_fin = stringFormat($_POST['date_fin']);

    $row18 = get_casier_info($nom_crim);
    $crim = $row18["$nom_crim"];

    $sql = mysqli_query ($con, "INSERT INTO bracelet (date_pose, date_fin_pose, utilisateur, criminel, raison)  VALUES('$now', '$date_fin','$moi','$nom_crim','$pourquoi')" );
    $sql2 = mysqli_query ($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$moi', 'A ajouter ($crim) à la liste des bracelets !', '$now')" );
    header("Refresh: $delay;"); 
    mysql_close();
}
?>
<?php
if( isset( $_POST['delete'] ) ) {
    $id = $_POST['id'];
    $nom_crim = $_POST['nom_crim'];
    $sql = mysqli_query($con, "DELETE FROM bracelet WHERE id = $id ");
    $sql2 = mysqli_query ($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$moi', 'A suprimer ($nom_crim) des personnes rechercher !', '$now')" );
    header("Refresh: $delay;"); 
    mysql_close();
}
?>

<body>
<br><br><br><br><br><br><br><br><br>
<center><h1>Liste des bracelets</h1></center>
<br><br>
<input class="mainLoginInput" style="width:30%;  height:3.3%; margin-left:45.3%" type='text' id='myInput' onkeyup='search()' placeholder='&#61442; Tapez votre recherche'/>
<button id="myBtn" class="add">
    <i class="fas fa-plus" style="font-size: 13;"></i> Ajouter un bracelet
</button>
<br><br>

<center>
    <div style="width:80%; margin-left:12%; margin-top:-10% " id="myModal" class="modal">
    <br><br><br><br><br><br><br><br><br><br>
        <div class="modal-content" >
            <span class="close">&times;</span>
            <form method="POST" id="form">
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
                    <input type="text" list="brow" class="input-field custom-select" name="criminel" id="criminel" required>
                    <datalist id="brow">
                        <?php

                        $reqCasier = "SELECT * FROM casier ORDER BY id DESC" ;
                        $result  = $con->query($reqCasier);
                        while( $row2 = mysqli_fetch_array($result) ) :
                            print "<option value=\"{$row2['id']}\"> {$row2['nom_crim']} </option>";
                        endwhile;
                        ?>
                    </datalist>
                    <i class="fas fa-user-alt-slash icon" style="font-size: 18;"></i>
                    <input type="date" class="input-field custom-select" name="date_fin" id="date_fin" required>
                </div>

                <div class="input-container">
                    <i class="fas fa-exclamation icon" style="font-size: 18;"></i>
                    <input class="input-field" type="text" placeholder="Entrer la raison" name="pourquoi" maxlength="99" required>
                </div>

                <input class="submit" value="Ajouter" name= "add_bracelet" onclick="valider()">
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

function valider() {
    var val = $("#criminel").val();

    var obj = $("#brow").find("option[value='" + val + "']");

    if(obj != null && obj.length > 0)
        $("#form").submit();
    else
        alert("La selection du criminel est incorrect"); // don't allow form submission
}
</script>

<center>
    <table>
        <thead>
            <tr>
                <th>
                    <center><b><i class="fas fa-calendar-alt"></i> | Date de pose</b></center>
                </th>
                <th>
                    <center><b><i class="fas fa-calendar-alt"></i> | Date fin</b></center>
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
        <?php while( $row = mysqli_fetch_array($resultat) ) :

            $row2 = get_lspd_account_info($row["utilisateur"]);
            $row3 = get_casier_info($row['criminel']);

            ?>
            <tbody id="myTable">
                    <td>
                        <center>
                            <?php echo $row['date_pose'];?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php echo $row['date_fin_pose'];?>
                        </center>
                    </td>
                    <td>
                        <?php echo $row2['utilisateur'];?>
                    </td>
                    <td>
                        <?php echo $row2['matricule'];?>
                    </td>
                    <td>
                        <?php echo $row3['nom_crim'];?>
                    </td>
                    <td>
                        <?php echo $row['raison'];?>
                    </td>
                    <td>
                        <center>
                            <form method = "POST">
                                <a href="casier.php?id=<?php echo $row['criminel']; ?>" class='edit'><i class="fas fa-eye"></i></a>
                                <?php if ($moi == $row['utilisateur'] OR $jesuisadmin == '1' OR $jesuissuperadmin == '1' OR $jesuisrh == '1') :?>
                                <button type='submit' value='delete' name='delete' class='del'>
                                    <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                    <input type='hidden' name='nom_crim' value=<?php echo $row['id']; ?>>
                                    <i class='fas fa-trash-alt' ></i>
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