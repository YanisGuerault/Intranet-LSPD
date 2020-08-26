<?php include 'menu.php'; ?>
<?php  if ($monniveau < '2') { header("Location: index.php"); } ?>

<?php 

$id = $_REQUEST['id'];
$query = "SELECT * FROM plainte WHERE id = $id " ; 
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

$query = "SELECT * FROM plainte WHERE id = $id " ;
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

?>

<?php

if(isset($_POST['jeteup'])) {
    $pqupdate = addslashes($_POST['pqupdate']); 

    $victime =  addslashes($_POST['victime']); 
    $tel_victime = addslashes($_POST['tel_victime']); 

    $suspect = addslashes($_POST['suspect']); 
    $tel_suspect = addslashes($_POST['tel_suspect']); 

    $des_info_suspect = addslashes($_POST['des_info_suspect']); 
    $preuve = addslashes($_POST['preuve']); 

    $vers_victime = addslashes($_POST['vers_victime']); 
    $vers_suspect = addslashes($_POST['vers_suspect']); 

    $etat = $_POST['etat']; 

    $sql1 =  mysqli_query($con, "UPDATE plainte SET victime = '$victime', tel_victime = '$tel_victime' WHERE id = $id");
    $sql2 =  mysqli_query($con, "UPDATE plainte SET suspect = '$suspect', tel_suspect = '$tel_suspect' WHERE id = $id");
    $sql7 =  mysqli_query($con, "UPDATE plainte SET des_info_suspect = '$des_info_suspect', preuve = '$preuve' WHERE id = $id");
    $sql7 =  mysqli_query($con, "UPDATE plainte SET vers_victime = '$vers_victime', vers_suspect = '$vers_suspect' WHERE id = $id");
    $sql8 =  mysqli_query($con, "UPDATE plainte SET etat = '$etat' WHERE id = $id");
    $sql9 =  mysqli_query($con, "INSERT INTO log_panel (utilisateur, historique, quand) VALUES('$jesuis', 'Plainte ($id) Modifier ($pqupdate)', '$now')" );
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
    <h2 style="text-align:center; font-size: 40px;">Plainte - <?php echo $row['id'];?></h2>
    <form name="form" method='POST' action="">
        <?php if ($jesuis == $row['utilisateur'] OR $jesuisadmin == '1' OR $jesuisrh == '1') :?>
        <TEXTAREA type='text' maxlength="100" style="resize:none;  float: left; width: 28%; margin-left:51.3%" name="pqupdate" placeholder="Tapez la raison de la modification" required></TEXTAREA>
        <button type='submit' value='jeteup' name='jeteup' class='up'>
            <i class="fas fa-upload"></i> Modifier
        </button>
        <?php endif;?>
        <br><br><br><br><br>

        <div class="columns">
            <ul class="price">
                <li class="header">Plainte</li>
                <li>
                    <h2 style="text-align:left; font-size: 15px;">Rapport : <?php echo $row['id'];?></h2>
                    <h2 style="text-align:left; font-size: 15px;">Créateur : <?php echo $row['utilisateur'];?></h2>
                    <h2 style="text-align:left; font-size: 15px;">Grade : <?php echo $row['grade'];?></h2>
                    <h2 style="text-align:left; font-size: 15px;">Matricule : <?php echo $row['matri'];?></h2>
                    <h2 style="text-align:left; font-size: 15px;">Date de création : <?php echo $row['quand'];?></h2>
                    <h2 style="text-align:left; font-size: 15px;">Lieu de création : <?php echo $row['lieu'];?></h2>

                    <?php if ($jesuis == $row['utilisateur'] OR $jesuisadmin == '1' OR $jesuisrh == '1') {?>

                    <h2 style="text-align:left; font-size: 15px;">Info Victime :</h2>
                    <div class="input-container">
                        <i class="fas fa-user-alt-slash icon"></i>
                        <input type="text" name='victime' maxlength="99" value="<?php echo $row['victime'];?>" >
                        <i class="fas fa-map-marked-alt icon"></i>
                        <input type="text" name="tel_victime"  maxlength="99" value="<?php echo $row['tel_victime'];?>" >
                    </div>
                    <h2 style="text-align:left; font-size: 15px;">Info Suspect :</h2>
                    <div class="input-container">
                        <i class="fas fa-user-alt-slash icon"></i>
                        <input type="text" name='suspect' maxlength="99" value="<?php echo $row['suspect'];?>" >
                        <i class="fas fa-map-marked-alt icon"></i>
                        <input type="text" name="tel_suspect"  maxlength="99" value="<?php echo $row['tel_suspect'];?>" >
                    </div>
                    <h2 style="text-align:left; font-size: 15px;">Desciption / Info Suspect :</h2>
                    <TEXTAREA style="resize:none; width:100%; height:10%" name="des_info_suspect"><?php echo $row['des_info_suspect'];?></TEXTAREA>
                    <h2 style="text-align:left; font-size: 15px;">Preuve :</h2>
                    <TEXTAREA style="resize:none; width:100%; height:10%" name="preuve"><?php echo $row['preuve'];?></TEXTAREA>
                    <div class="input-container">
                        <i class="fas fa-folder-open icon"></i>
                        <select class="input-field custom-select" name="etat">
                        <option value="<?php echo $row['etat'];?>" hidden><?php if($row['etat'] == '1') { echo "En cours"; } else { echo "Fermée"; } ?></option>
                            <option value='1'>En cours</option>
                            <option value='2'>Fermée</option>
                        </select>
                    </div>
                    
                    <?php } else { ?>

                    <h2 style="text-align:left; font-size: 15px;">Info Victime :</h2>
                    <div class="input-container">
                        <i class="fas fa-address-card icon"></i>
                        <input type="text" maxlength="99" value="<?php echo $row['victime'];?>" readonly>
                        <i class="fas fa-address-card icon"></i>
                        <input type="text" maxlength="99" value="<?php echo $row['tel_victime'];?>" readonly>
                    </div>
                    <h2 style="text-align:left; font-size: 15px;">Info Suspect :</h2>
                    <div class="input-container">
                        <i class="fas fa-address-card icon"></i>
                        <input type="text" maxlength="99" value="<?php echo $row['suspect'];?>" readonly>
                        <i class="fas fa-address-card icon"></i>
                        <input type="text" maxlength="99" value="<?php echo $row['tel_suspect'];?>" readonly>
                    </div>
                    <h2 style="text-align:left; font-size: 15px;">Rapport de Situation :</h2>
                    <TEXTAREA style="resize:none; width:100%; height:15%" readonly><?php echo $row['des_info_suspect'];?></TEXTAREA>
                    <h2 style="text-align:left; font-size: 15px;">Preuve :</h2>
                    <TEXTAREA style="resize:none; width:100%; height:10%" readonly><?php echo $row['preuve'];?></TEXTAREA>
                    <div class="input-container">
                        <i class="fas fa-address-card icon"></i>
                        <input type="text" value="<?php if($row['etat'] == '1') { echo "En cours"; } else { echo "Fermée"; } ?>" readonly>
                    </div>
                    
                    <?php } ?>

                    <h2 style="text-align:left; font-size: 15px;">Signature de la Plainte : <?php echo $row['signa'];?></h2>

                </li>
            </ul>
        </div>

        <div class="columns" style="width:66%">
            <ul class="price">
                <li class="header">Version Victime / Version Suspect</li>
                <li>
                <?php if ($jesuis == $row['utilisateur'] OR $jesuisadmin == '1' OR $jesuisrh == '1') {?>
                    <h2 style="text-align:left; font-size: 15px;">Version de la Victime :</h2>
                    <TEXTAREA style="resize:none; width:100%; height:30.3%" name="vers_victime"><?php echo $row['vers_victime'];?></TEXTAREA>
                    <h2 style="text-align:left; font-size: 15px;">Version du suspect :</h2>
                    <TEXTAREA style="resize:none; width:100%; height:30.3%" name="vers_suspect"><?php echo $row['vers_suspect'];?></TEXTAREA>

                    <?php } else { ?>

                    <h2 style="text-align:left; font-size: 15px;">Version de la Victime :</h2>
                    <TEXTAREA style="resize:none; width:100%; height:25%" readonly><?php echo $row['vers_victime'];?></TEXTAREA>
                    <h2 style="text-align:left; font-size: 15px;">Version du suspect :</h2>
                    <TEXTAREA style="resize:none; width:100%; height:25%" readonly><?php echo $row['vers_suspect'];?></TEXTAREA>

                    <?php } ?>

                </li>
            </ul>
        </div>
    </form>
</body>
</html>