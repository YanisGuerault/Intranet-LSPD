<?php include 'menu.php'; ?>
<?php if ($jesuisrh == '0' && $jesuisadmin == '0' && $jesuissuperadmin == '0') { header("Location: index.php"); } ?>

<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="css/table.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="css/button.css" media="screen" type="text/css" />
</head>

<?php 
if( isset( $_POST['add_user'] ) ) {
    if(isset($_POST['utilisateur']))      $utilisateur=$_POST['utilisateur'];
    else      $utilisateur='';
    if(isset($_POST['motdepasse']))      $motdepasse=$_POST['motdepasse'];
    else      $motdepasse='';
    if(isset($_POST['matricule']))      $matricule=$_POST['matricule'];
    else      $matricule='';
    $motdepasse = hash('sha512', $_POST['motdepasse']);
    $sql = mysqli_query ($con, "INSERT INTO compte_lspd (utilisateur, motdepasse, grade, matricule, rh, isadmin, issuperadmin) VALUES('$utilisateur','$motdepasse','1','$matricule','0','0','0')" ); 
    $sql2 = mysqli_query ($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$jesuis', 'A ajouter a la LSPD ($utilisateur) !', '$now')" );
    header("Refresh: $delay;"); 
    mysql_close();
}
?>
<?php
if( isset( $_POST['addadmin'] ) ) {
    $id = $_POST['id'];
    $utilisateur = $_POST['utilisateur'];
    $sql = mysqli_query($con, "UPDATE compte_lspd SET isadmin = '1' WHERE id = $id ");
    $sql2 = mysqli_query ($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$jesuis', 'A ajouter au admin ($utilisateur) !', '$now')" );
    header("Refresh: $delay;"); 
    mysql_close();
}
if( isset( $_POST['deladmin'] ) ) {
    $id = $_POST['id'];
    $utilisateur = $_POST['utilisateur'];
    $sql = mysqli_query($con, "UPDATE compte_lspd SET isadmin = '0' WHERE id = $id ");
    $sql2 = mysqli_query ($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$jesuis', 'A retirer des admin ($utilisateur) !', '$now')" );
    header("Refresh: $delay;"); 
    mysql_close();
}
if( isset( $_POST['addrh'] ) ) {
    $id = $_POST['id'];
    $utilisateur = $_POST['utilisateur'];
    $sql = mysqli_query($con, "UPDATE compte_lspd SET rh = '1' WHERE id = $id ");
    $sql2 = mysqli_query ($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$jesuis', 'A ajouter au RH ($utilisateur) !', '$now')" );
    header("Refresh: $delay;"); 
    mysql_close();
}
if( isset( $_POST['delrh'] ) ) {
    $id = $_POST['id'];
    $utilisateur = $_POST['utilisateur'];
    $sql = mysqli_query($con, "UPDATE compte_lspd SET rh = '0' WHERE id = $id ");
    $sql2 = mysqli_query ($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$jesuis', 'A retirer des RH ($utilisateur) !', '$now')" );
    header("Refresh: $delay;"); 
    mysql_close();
}
if( isset( $_POST['rst_pass'] ) ) {
    $id = $_POST['id'];
    $utilisateur = $_POST['utilisateur'];
    $sql = mysqli_query($con, "UPDATE compte_lspd SET motdepasse = 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db' WHERE id = $id ");
    $sql2 = mysqli_query ($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$jesuis', 'A reinitialiser le mot de passe de ($utilisateur) !', '$now')" );
    header("Refresh: $delay;"); 
    mysql_close();
}
?>
<?php
if( isset( $_POST['upgrade'] ) ) {
    $id = $_POST['id'];
    $leveluser = $_POST['grade'];
    $utilisateur = $_POST['utilisateur'];
    $sql = mysqli_query($con, "UPDATE compte_lspd SET grade = ' ". ($leveluser + 1) ." ' WHERE id = $id ");
    $sql2 = mysqli_query ($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$jesuis', 'A monter en grade ($utilisateur) !', '$now')" );
    header("Refresh: $delay;"); 
    mysql_close();
}
if( isset( $_POST['downgrade'] ) ) {
    $id = $_POST['id'];
    $leveluser = $_POST['grade'];
    $utilisateur = $_POST['utilisateur'];
    $sql = mysqli_query($con, "UPDATE compte_lspd SET grade = ' ". ($leveluser - 1) ." ' WHERE id = $id ");
    $sql2 = mysqli_query ($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$jesuis', 'A retrograder ($utilisateur) !', '$now')" );
    header("Refresh: $delay;"); 
    mysql_close();
}
if( isset( $_POST['delete'] ) ) {
    $id = $_POST['id'];
    $utilisateur = $_POST['utilisateur'];
    $sql = mysqli_query($con, "DELETE FROM compte_lspd WHERE id = $id ");
    $sql2 = mysqli_query ($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$jesuis', 'A supprimer ($utilisateur) !', '$now')" );
    header("Refresh: $delay;"); 
    mysql_close();
}
?>
<?php
$reqSQL = " SELECT * FROM compte_lspd ORDER BY grade DESC " ;
$resultat  = $con->query($reqSQL);
?>

<script>

function show_mdp() {
    var x = document.getElementById("motdepasse");
        if (x.type === "password") {
            x.type = "text";
        } else {
        x.type = "password";
    }
}

</script>

<body>
    <br><br><br><br><br><br><br><br><br>
    <center><h1>Gestions des Comptes Utilisateurs</h1></center>
    <br><br>
    <button id="myBtn" class="add" style="font-size: 13; float: left;  margin-left:75.5%">
        <i class="fas fa-plus" style="font-size: 13;"></i> Ajouter un utilisateur
    </button>
    <br><br><br><br>
    <center>
        <div id="myModal" class="modal">
        <br><br><br><br><br><br><br><br><br><br>
            <div class="modal-content">
                <span class="close">&times;</span>
                <br><br>
                <form method="POST">
                    <h1>Ajouter un utilisateurs</h1>
        
                    <div class="input-container">
                        <i class="fas fa-user-alt icon" style="font-size: 18;"></i>
                        <input class="input-field" type="text" placeholder="Entrer le nom d'utilisateur" name="utilisateur" maxlength="49" required>
                    </div>

                    <div class="input-container">
                        <i class="fas fa-user-alt icon" style="font-size: 18;"></i>
                        <input class="input-field" type="text" placeholder="Entrer le matricule" name="matricule" maxlength="3" required>
                    </div>

                    <div class="input-container">
                        <i class="fas fa-unlock icon" style="font-size: 18;"></i>
                        <input class="input-field" type="password" placeholder="Entrer le mot de passe" name="motdepasse" id= "motdepasse" required>
                    </div>

                    <br>
                    <input type="checkbox" onclick="show_mdp()">Afficher Mot de passe
                    <br><br>
                    <input type="submit" value="Ajouter" name= "add_user">
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

    <br><br>

    <center>
        <table>
            <tr>
                <td>
                    <center><b><i class='fas fa-user'></i> | Utilisateurs</b></center>
                </td>
                <td>
                    <center><b><i class="fas fa-sort-amount-up"></i> | Grade</b></center>
                </td>
                <td>
                    <center><b><i class="fas fa-id-badge"></i> | Matricule</b></center>
                </td>
                <?php if ($jesuisadmin == '1' OR $jesuissuperadmin == '1') : ?>
                <td>
                    <center><b><i class="fas fa-crown"></i> | Ressource Humaine</b></center>
                </td>
                <?php endif; ?>
                <td>
                    <center><b><i class='fas fa-user-edit'></i> | Action</b></center>
                </td>
            </tr>

            <?php if( $resultat->num_rows > 0 ) : ?>
                <?php while( $row = mysqli_fetch_array($resultat) ) :?>
                    <tr>
                        <td>
                            <center>
                                <?php if ($row['isadmin'] == '1') : ?> 
                                <i class="fas fa-star" style="color: orange"></i>  
                                <?php endif;?>
                                <?php if ($row['issuperadmin'] == '1' && $row['isadmin'] == '0') : ?> 
                                <i class="fas fa-crown" style="color: orange"></i>  
                                <?php endif;?>
                                <?php echo $row['utilisateur']; ?>
                            </center>
                        </td>

                        <!--------------------------------->

                        <?php if ($row['grade'] == '0' ) : ?>
                        <td>
                            <center>Compte Bloqué</center>
                        </td>
                        <?php endif; ?>
                        <?php if ($row['grade'] == '1' ) : ?>
                        <td>
                            <center>Cadet</center>
                        </td>
                        <?php endif; ?>
                        <?php if ($row['grade'] == '2' ) : ?>
                        <td>
                            <center>Officier I</center>
                        </td>
                        <?php endif; ?>
                        <?php if ($row['grade'] == '3' ) : ?>
                        <td>
                            <center>Officier II</center>
                        </td>
                        <?php endif; ?>
                        <?php if ($row['grade'] == '4' ) : ?>
                        <td>
                            <center>Officier III</center>
                        </td>
                        <?php endif; ?>
                        <?php if ($row['grade'] == '5' ) : ?>
                        <td>
                            <center>Sergent I</center>
                        </td>
                        <?php endif; ?>
                        <?php if ($row['grade'] == '6' ) : ?>
                        <td>
                            <center>Sergent II</center>
                        </td>
                        <?php endif; ?>
                        <?php if ($row['grade'] == '7' ) : ?>
                        <td>
                            <center>Sergent Chef</center>
                        </td>
                        <?php endif; ?>
                        <?php if ($row['grade'] == '8' ) : ?>
                        <td>
                            <center>Lieutenant I</center>
                        </td>
                        <?php endif; ?>
                        <?php if ($row['grade'] == '9' ) : ?>
                        <td>
                            <center>Lieutenant II</center>
                        </td>
                        <?php endif; ?>
                        <?php if ($row['grade'] == '10' ) : ?>
                        <td>
                            <center>Lieutenant en Chef</center>
                        </td>
                        <?php endif; ?>
                        <?php if ($row['grade'] == '11' ) : ?>
                        <td>
                            <center>Capitaine</center>
                        </td>
                        <?php endif; ?>
                        <?php if ($row['grade'] == '12' ) : ?>
                        <td>
                            <center>Capitaine en Chef</center>
                        </td>
                        <?php endif; ?>
                        <?php if ($row['grade'] == '13' ) : ?>
                        <td>
                            <center>Commandant Adjoint</center>
                        </td>
                        <?php endif; ?>
                        <?php if ($row['grade'] == '14' ) : ?>
                        <td>
                            <center>Commandant</center>
                        </td>
                        <?php endif; ?>
                        <?php if ($row['grade'] == '15' ) : ?>
                        <td>
                            <center>Staff</center>
                        </td>
                        <?php endif; ?>

                        <!--------------------------------->

                        <td>
                            <center><?php echo $row['matricule']; ?></center>
                        </td>

                        <!--------------------------------->

                        <?php if ($jesuissuperadmin == '1') : ?>
                        <!-----------si pas admin et pas RH ---------------->
                        <?php if ($row['rh'] == '0' && $row['isadmin'] == '0') : ?>
                        <td>
                            <center>
                                <form method='POST'>
                                    <button type='submit' value='addrh' name='addrh' class='upgrade'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button type='submit' value='rst_pass' name='rst_pass' class='rst_pass'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-key"></i>
                                    </button>
                                    <button type='submit' value='addadmin' name='addadmin' class='upgrade'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-star"></i>
                                    </button>
                                </form>
                            <center>
                        </td>
                        <?php endif; ?>
                        <!-----------si pas admin et RH ---------------->
                        <?php if ($row['rh'] == '1' && $row['isadmin'] == '0') : ?>
                        <td>
                            <center>
                                <form method='POST'>
                                    <button type='submit' value='delrh' name='delrh' class='delete'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <button type='submit' value='rst_pass' name='rst_pass' class='rst_pass'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-key"></i>
                                    </button>
                                    <button type='submit' value='addadmin' name='addadmin' class='upgrade'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-star"></i>
                                    </button>
                                </form>
                            <center>
                        </td>
                        <?php endif; ?>

                        <!-----------si admin et pas RH ---------------->

                        <?php if ($row['isadmin'] == '1' && $row['rh'] == '0') : ?>
                        <td>
                            <center>
                                <form method='POST'>
                                    <button type='submit' value='addrh' name='addrh' class='upgrade'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button type='submit' value='rst_pass' name='rst_pass' class='rst_pass'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-key"></i>
                                    </button>
                                    <button type='submit' value='deladmin' name='deladmin' class='delete'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-star"></i>
                                    </button>
                                </form>
                            <center>
                        </td>
                        <?php endif; ?>

                        <!-----------si admin et RH ---------------->

                        <?php if ($row['rh'] == '1' && $row['isadmin'] == '1') : ?>
                        <td>
                            <center>
                                <form method='POST'>
                                    <button type='submit' value='delrh' name='delrh' class='delete'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <button type='submit' value='rst_pass' name='rst_pass' class='rst_pass'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-key"></i>
                                    </button>
                                    <button type='submit' value='deladmin' name='deladmin' class='delete'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-star"></i>
                                    </button>
                                </form>
                            <center>
                        </td>
                        <?php endif; ?>
                        <?php endif; ?>
                        <!-------------------------------------------------------------------------------------------------------------------->
                        <?php if ($jesuisadmin == '1') : ?>
                        <!-----------si pas admin et pas RH ---------------->
                        <?php if ($row['rh'] == '0' && $row['isadmin'] == '0') : ?>
                        <td>
                            <center>
                                <form method='POST'>
                                    <?php if ($row['issuperadmin'] == '0') : ?>
                                    <button type='submit' value='addrh' name='addrh' class='upgrade'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <?php if ($row['isadmin'] == '0') : ?>
                                    <button type='submit' value='rst_pass' name='rst_pass' class='rst_pass'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-key"></i>
                                    </button>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($jesuissuperadmin == '1') : ?>
                                    <button type='submit' value='addadmin' name='addadmin' class='upgrade'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-star"></i>
                                    </button>
                                    <?php endif; ?>
                                </form>
                            <center>
                        </td>
                        <?php endif; ?>
                        <!-----------si pas admin et RH ---------------->
                        <?php if ($row['rh'] == '1' && $row['isadmin'] == '0') : ?>
                        <td>
                            <center>
                                <form method='POST'>
                                    <?php if ($row['issuperadmin'] == '0') : ?>
                                    <button type='submit' value='delrh' name='delrh' class='delete'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <?php if ($row['isadmin'] == '0') : ?>
                                    <button type='submit' value='rst_pass' name='rst_pass' class='rst_pass'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-key"></i>
                                    </button>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($jesuissuperadmin == '1') : ?>
                                    <button type='submit' value='addadmin' name='addadmin' class='upgrade'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-star"></i>
                                    </button>
                                    <?php endif; ?>
                                </form>
                            <center>
                        </td>
                        <?php endif; ?>

                        <!-----------si admin et pas RH ---------------->

                        <?php if ($row['isadmin'] == '1' && $row['rh'] == '0') : ?>
                        <td>
                            <center>
                                <form method='POST'>
                                    <?php if ($row['issuperadmin'] == '0') : ?>
                                    <button type='submit' value='addrh' name='addrh' class='upgrade'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <?php if ($row['isadmin'] == '0') : ?>
                                    <button type='submit' value='rst_pass' name='rst_pass' class='rst_pass'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-key"></i>
                                    </button>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($jesuissuperadmin == '1') : ?>
                                    <button type='submit' value='deladmin' name='deladmin' class='delete'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-star"></i>
                                    </button>
                                    <?php endif; ?>
                                </form>
                            <center>
                        </td>
                        <?php endif; ?>

                        <!-----------si admin et RH ---------------->

                        <?php if ($row['rh'] == '1' && $row['isadmin'] == '1') : ?>
                        <td>
                            <center>
                                <form method='POST'>
                                    <?php if ($row['issuperadmin'] == '0') : ?>
                                    <button type='submit' value='delrh' name='delrh' class='delete'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <?php if ($row['isadmin'] == '0') : ?>
                                    <button type='submit' value='rst_pass' name='rst_pass' class='rst_pass'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-key"></i>
                                    </button>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($jesuissuperadmin == '1') : ?>
                                    <button type='submit' value='deladmin' name='deladmin' class='delete'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class="fas fa-star"></i>
                                    </button>
                                    <?php endif; ?>
                                </form>
                            <center>
                        </td>
                        <?php endif; ?>
                        <?php endif; ?>

                        <!--------------------------------->

                        <td>
                            <center>

                                <!-----------si superadmin ----------------->

                                <?php if ($jesuissuperadmin == '1') : ?>
                                <form method='POST'>
                                <?php if ($row['grade'] < '15') : ?>
                                    <button type='submit' value='upgrade' name='upgrade' class='upgrade'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <input type='hidden' name='grade' value=<?php echo $row['grade']; ?>>
                                        <i class='fas fa-long-arrow-alt-up'></i>
                                    </button>
                                    <?php endif; ?>
                                    <?php if  ($row['grade'] > '0') : ?>
                                    <button type='submit' value='downgrade' name='downgrade' class='downgrade'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <input type='hidden' name='grade' value=<?php echo $row['grade']; ?>>
                                        <i class='fas fa-long-arrow-alt-down'></i>
                                    </button>
                                    <?php endif; ?>
                                    <button type='submit' value='delete' name='delete' class='delete'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <i class='fas fa-trash-alt'></i>
                                    </button>
                                </form>
                                <?php endif; ?>

                                <!-----------si admin et RH ---------------->

                                <?php if ($jesuisadmin == '1' && $jesuisrh == '1') : ?>
                                <form method='POST'>
                                    <?php if ($row['issuperadmin'] == '0') : ?>
                                    <?php if (($row['grade'] + 1 < $monniveau OR $jesuisadmin == '1') && $row['grade'] < '14') : ?>
                                    <button type='submit' value='upgrade' name='upgrade' class='upgrade'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <input type='hidden' name='grade' value=<?php echo $row['grade']; ?>>
                                        <i class='fas fa-long-arrow-alt-up'></i>
                                    </button>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($row['issuperadmin'] == '0') : ?>
                                    <?php if (($row['grade'] < $monniveau OR $jesuisadmin == '1') && $row['grade'] > '0') : ?>
                                    <button type='submit' value='downgrade' name='downgrade' class='downgrade'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <input type='hidden' name='grade' value=<?php echo $row['grade']; ?>>
                                        <i class='fas fa-long-arrow-alt-down'></i>
                                    </button>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($row['issuperadmin'] == '0') : ?>
                                    <?php if ($row['isadmin'] == '0') : ?>
                                    <?php if ($row['grade'] < $monniveau OR $jesuisadmin == '1') : ?>
                                        <button type='submit' value='delete' name='delete' class='delete'>
                                            <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                            <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                            <i class='fas fa-trash-alt'></i>
                                        </button>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </form>
                                <?php endif; ?>

                                <!-----------si admin et pas RH ---------------->

                                <?php if ($jesuisadmin == '1' && $jesuisrh == '0') : ?>
                                <form method='POST'>
                                    <?php if ($row['issuperadmin'] == '0') : ?>
                                    <?php if (($row['grade'] + 1 < $monniveau OR $jesuisadmin == '1') && $row['grade'] < '14') : ?>
                                    <button type='submit' value='upgrade' name='upgrade' class='upgrade'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <input type='hidden' name='grade' value=<?php echo $row['grade']; ?>>
                                        <i class='fas fa-long-arrow-alt-up'></i>
                                    </button>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($row['issuperadmin'] == '0') : ?>
                                    <?php if (($row['grade'] < $monniveau OR $jesuisadmin == '1') && $row['grade'] > '0') : ?>
                                    <button type='submit' value='downgrade' name='downgrade' class='downgrade'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <input type='hidden' name='grade' value=<?php echo $row['grade']; ?>>
                                        <i class='fas fa-long-arrow-alt-down'></i>
                                    </button>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($row['issuperadmin'] == '0') : ?>
                                    <?php if ($row['isadmin'] == '0') : ?>
                                    <?php if ($row['grade'] < $monniveau OR $jesuisadmin == '1') : ?>
                                        <button type='submit' value='delete' name='delete' class='delete'>
                                            <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                            <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                            <i class='fas fa-trash-alt'></i>
                                        </button>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </form>
                                <?php endif; ?>

                                 <!-----------si RH et pas admin ---------------->

                                <?php if ($jesuisadmin == '0' && $jesuisrh == '1') : ?>
                                <form method='POST'>
                                    <?php if ($row['issuperadmin'] == '0') : ?>
                                    <?php if (($row['grade'] + 1 < $monniveau ) && $row['grade'] < '14') : ?>
                                    <button type='submit' value='upgrade' name='upgrade' class='upgrade'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <input type='hidden' name='grade' value=<?php echo $row['grade']; ?>>
                                        <i class='fas fa-long-arrow-alt-up'></i>
                                    </button>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($row['issuperadmin'] == '0') : ?>
                                    <?php if (($row['grade'] < $monniveau) && $row['grade'] > '0') : ?>
                                    <button type='submit' value='downgrade' name='downgrade' class='downgrade'>
                                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                        <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                        <input type='hidden' name='grade' value=<?php echo $row['grade']; ?>>
                                        <i class='fas fa-long-arrow-alt-down'></i>
                                    </button>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($row['issuperadmin'] == '0') : ?>
                                    <?php if ($row['isadmin'] == '0') : ?>
                                    <?php if ($row['grade'] < $monniveau) : ?>
                                        <button type='submit' value='delete' name='delete' class='delete'>
                                            <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                                            <input type='hidden' name='utilisateur' value=<?php echo $row['utilisateur']; ?>>
                                            <i class='fas fa-trash-alt'></i>
                                        </button>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <!------------------------------------------------------------------------------------------------------>
                                </form>
                                <?php endif; ?>

                            </center>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
        </table>
    </center>
    <br><br>
</body>
</html>