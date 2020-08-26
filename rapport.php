<?php include 'menu.php'; ?>
<?php  if ($monniveau < '2') { header("Location: index.php"); } ?>

<?php 

$id = $_REQUEST['id'];
$query = "SELECT * FROM rapport WHERE id = $id " ; 
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

?>

<?php

if(isset($_POST['jeteup'])) {
    $pqupdate = addslashes($_POST['pqupdate']); 

    $nom_crim = addslashes($_POST['nom_crim']); 
    $maison_crim = addslashes($_POST['maison_crim']); 

    $qst_1 = addslashes($_POST['qst_1']); 
    $qst_2 = addslashes($_POST['qst_2']); 
    $qst_3 = addslashes($_POST['qst_3']); 
    $qst_4 = addslashes($_POST['qst_4']); 
    $qst_5 = addslashes($_POST['qst_5']); 

    $rep_1 = addslashes($_POST['rep_1']); 
    $rep_2 = addslashes($_POST['rep_2']); 
    $rep_3 = addslashes($_POST['rep_3']); 
    $rep_4 = addslashes($_POST['rep_4']); 
    $rep_5 = addslashes($_POST['rep_5']); 

    $rap_situ = addslashes($_POST['rap_situ']); 
    $preuve = addslashes($_POST['preuve']); 

    $etat = addslashes($_POST['etat']); 

    $sql1 =  mysqli_query($con, "UPDATE rapport SET nom_crim = '$nom_crim', maison_crim = '$maison_crim' WHERE id = $id");
    $sql2 =  mysqli_query($con, "UPDATE rapport SET qst_1 = '$qst_1', rep_1 = '$rep_1' WHERE id = $id");
    $sql3 =  mysqli_query($con, "UPDATE rapport SET qst_2 = '$qst_2', rep_2 = '$rep_2' WHERE id = $id");
    $sql4 =  mysqli_query($con, "UPDATE rapport SET qst_3 = '$qst_3', rep_3 = '$rep_3' WHERE id = $id");
    $sql5 =  mysqli_query($con, "UPDATE rapport SET qst_4 = '$qst_4', rep_4 = '$rep_4' WHERE id = $id");
    $sql6 =  mysqli_query($con, "UPDATE rapport SET qst_5 = '$qst_5', rep_5 = '$rep_5' WHERE id = $id");
    $sql7 =  mysqli_query($con, "UPDATE rapport SET rap_situ = '$rap_situ', preuve = '$preuve' WHERE id = $id");
    $sql8 =  mysqli_query($con, "UPDATE rapport SET etat = '$etat' WHERE id = $id");
    $sql9 =  mysqli_query($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$jesuis', 'Rapport ($id) Modifier ($pqupdate)', '$now')" );
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
    <br><br><br><br><br><br>
    <h2 style="text-align:center; font-size: 40px;">Rapport - <?php echo $row['id'];?></h2>
    <form name="form" method='POST' action="">
        <?php if ($jesuis == $row['utilisateur'] OR $jesuisadmin == '1' OR $jesuisrh == '1' OR $jesuissuperadmin == '1') :?>
        <TEXTAREA type='text' maxlength="100" style="resize:none;  float: left; width: 28%; margin-left:51.3%" name="pqupdate" placeholder="Tapez la raison de la modification" required></TEXTAREA>
        <button type='submit' value='jeteup' name='jeteup' class='up'>
            <i class="fas fa-upload"></i> Modifier
        </button>
        <?php endif;?>
        <br><br><br><br><br>

        <div class="columns">
            <ul class="price">
                <li class="header">Rapport</li>
                <li>
                    <h2 style="text-align:left; font-size: 15px;">Rapport : <?php echo $row['id'];?></h2>
                    <h2 style="text-align:left; font-size: 15px;">Créateur : <?php echo $row['utilisateur'];?></h2>
                    <h2 style="text-align:left; font-size: 15px;">Grade : <?php echo $row['grade'];?></h2>
                    <h2 style="text-align:left; font-size: 15px;">Matricule : <?php echo $row['matri'];?></h2>
                    <h2 style="text-align:left; font-size: 15px;">Date de création : <?php echo $row['quand'];?></h2>
                    <h2 style="text-align:left; font-size: 15px;">Lieu de création : <?php echo $row['lieu'];?></h2>
                    <?php if ($jesuis == $row['utilisateur'] OR $jesuisadmin == '1' OR $jesuisrh == '1' OR $jesuissuperadmin == '1') {?>

                    <div class="input-container">
                        <i class="fas fa-user-alt-slash icon"></i>
                        <input type="text" name='nom_crim' maxlength="99" value="<?php echo $row['nom_crim'];?>" >
                        <i class="fas fa-map-marked-alt icon"></i>
                        <input type="text" name="maison_crim"  maxlength="99" value="<?php echo $row['maison_crim'];?>" >
                    </div>
                    <h2 style="text-align:left; font-size: 15px;">Rapport de Situation :</h2>
                    <TEXTAREA style="resize:none; width:100%; height:15%" name="rap_situ"><?php echo $row['rap_situ'];?></TEXTAREA>
                    <h2 style="text-align:left; font-size: 15px;">Preuve :</h2>
                    <TEXTAREA style="resize:none; width:100%; height:15%" name="preuve"><?php echo $row['preuve'];?></TEXTAREA>

                    <div class="input-container">
                        <i class="fas fa-folder-open icon"></i>
                        <select class="input-field custom-select" name="etat">
                        <option value="<?php echo $row['etat'];?>" hidden><?php if($row['etat'] == '1') { echo "Ouvert"; } else { echo "Fermée"; } ?></option>
                            <option value='1'>Ouvert</option>
                            <option value='2'>Fermée</option>
                        </select>
                    </div>
                    
                    <?php } else { ?>

                    <div class="input-container">
                        <i class="fas fa-address-card icon"></i>
                        <input type="text" name='firstname' maxlength="99" value="<?php echo $row['nom_crim'];?>" readonly>
                        <i class="fas fa-address-card icon"></i>
                        <input type="text" name="lastname"  maxlength="99" value="<?php echo $row['maison_crim'];?>" readonly>
                    </div>
                    <h2 style="text-align:left; font-size: 15px;">Rapport de Situation :</h2>
                    <TEXTAREA style="resize:none; width:100%; height:15%" readonly><?php echo $row['rap_situ'];?></TEXTAREA>
                    <h2 style="text-align:left; font-size: 15px;">Preuve :</h2>
                    <TEXTAREA style="resize:none; width:100%; height:10%" readonly><?php echo $row['preuve'];?></TEXTAREA>

                    <div class="input-container">
                        <i class="fas fa-address-card icon"></i>
                        <input type="text" value="<?php if($row['etat'] == '1') { echo "Ouvert"; } else { echo "Fermée"; } ?>" readonly>
                    </div>
                    
                    <?php } ?>

                    <h2 style="text-align:left; font-size: 15px;">Signature du Rapport : <?php echo $row['signa'];?></h2>

                </li>
            </ul>
        </div>

        <div class="columns" style="width:66%">
            <ul class="price">
                <li class="header">Question / Réponse</li>
                <li>
                <?php if ($jesuis == $row['utilisateur'] OR $jesuisadmin == '1' OR $jesuisrh == '1' OR $jesuissuperadmin == '1') {?>
                    <div class="input-container">
                        <i class="fas fa-question icon"></i>
                        <input type="text" name='qst_1' value="<?php echo $row['qst_1'];?>" >
                        <i class="fas fa-reply icon"></i>
                        <input type="text" name="rep_1"  value="<?php echo $row['rep_1'];?>" >
                    </div>

                    <div class="input-container">
                        <i class="fas fa-question icon"></i>
                        <input type="text" name='qst_2' value="<?php echo $row['qst_2'];?>" >
                        <i class="fas fa-reply icon"></i>
                        <input type="text" name="rep_2"  value="<?php echo $row['rep_2'];?>" >
                    </div>

                    <div class="input-container">
                        <i class="fas fa-question icon"></i>
                        <input type="text" name='qst_3' value="<?php echo $row['qst_3'];?>" >
                        <i class="fas fa-reply icon"></i>
                        <input type="text" name="rep_3"  value="<?php echo $row['rep_3'];?>" >
                    </div>

                    <div class="input-container">
                        <i class="fas fa-question icon"></i>
                        <input type="text" name='qst_4' value="<?php echo $row['qst_4'];?>" >
                        <i class="fas fa-reply icon"></i>
                        <input type="text" name="rep_4"  value="<?php echo $row['rep_4'];?>" >
                    </div>

                    <div class="input-container">
                        <i class="fas fa-question icon"></i>
                        <input type="text" name='qst_5' value="<?php echo $row['qst_5'];?>" >
                        <i class="fas fa-reply icon"></i>
                        <input type="text" name="rep_5"  value="<?php echo $row['rep_5'];?>" >
                    </div>
                    <?php } else { ?>

                    <div class="input-container">
                        <i class="fas fa-question icon"></i>
                        <input type="text" value="<?php echo $row['qst_1'];?>" readonly>
                        <i class="fas fa-reply icon"></i>
                        <input type="text" value="<?php echo $row['rep_1'];?>" readonly>
                    </div>

                    <div class="input-container">
                        <i class="fas fa-question icon"></i>
                        <input type="text" value="<?php echo $row['qst_2'];?>" readonly>
                        <i class="fas fa-reply icon"></i>
                        <input type="text"  value="<?php echo $row['rep_2'];?>" readonly>
                    </div>

                    <div class="input-container">
                        <i class="fas fa-question icon"></i>
                        <input type="text" value="<?php echo $row['qst_3'];?>" readonly>
                        <i class="fas fa-reply icon"></i>
                        <input type="text" value="<?php echo $row['rep_3'];?>" readonly>
                    </div>

                    <div class="input-container">
                        <i class="fas fa-question icon"></i>
                        <input type="text" value="<?php echo $row['qst_4'];?>" readonly>
                        <i class="fas fa-reply icon"></i>
                        <input type="text" value="<?php echo $row['rep_4'];?>" readonly>
                    </div>

                    <div class="input-container">
                        <i class="fas fa-question icon"></i>
                        <input type="text" value="<?php echo $row['qst_5'];?>" readonly>
                        <i class="fas fa-reply icon"></i>
                        <input type="text" value="<?php echo $row['rep_5'];?>" readonly>
                    </div>

                    <?php } ?>

                </li>
            </ul>
        </div>
    </form>
</body>
</html>