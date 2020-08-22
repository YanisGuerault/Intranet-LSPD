<?php include 'menu.php'; ?>
<?php  if ($monniveau <= '0') { header("Location: index.php"); } ?>

<?php 

if( isset( $_POST['change_password'] ) ) 
{
    if(isset($_POST['ancienmotdepasse']))      $ancienmotdepasse= $_POST['ancienmotdepasse'];
    else      $ancienmotdepasse="";

    if(isset($_POST['newmotdepasse']))      $newmotdepasse=$_POST['newmotdepasse'];
    else      $newmotdepasse="";
    
    $oldmotdepasse = hash('sha512', $ancienmotdepasse);
    
    if($oldmotdepasse == $monmdp) 
    {
        $password = hash('sha512', $newmotdepasse);
        $sql2 = mysqli_query ($con, "UPDATE compte_lspd SET motdepasse = '$password' WHERE id ='$moi'" ); 
        $message = "<h3><p>Votre mot de passe à bien été modifié !</p></h3>";
        mysql_close();
    } 
    else 
    {
        $message = "<h3><font color='red'> Il y'a une erreur ! </font></h3>";
    }
}

?>

<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="css/inter.css" media="screen" type="text/css" />
</head>

<script>

function show_mdp() {
    var x = document.getElementById("ancienmotdepasse");
    var y = document.getElementById("newmotdepasse");
    if (x.type === "password" && y.type === "password") {
      x.type = "text";
      y.type = "text";
    } else {
      x.type = "password";
      y.type = "password";
    }
}

</script>

<body>
    <br><br><br><br><br><br><br><br><br>
    <center>
        <h1>Gestion de mon compte</h1>
        <div id="container">
            <form method="POST">
                <h1>Modifier votre mot de passe</h1>
                <?php if($message!="") { echo $message; } ?><br>

                <div class="input-container">
                    <i class="fas fa-user-lock icon " style="font-size: 18;"></i>
                    <input class="input-field" type="password" placeholder="Entrer votre mot de passe actuelle" name="ancienmotdepasse" id="ancienmotdepasse" required>
                </div>

                <div class="input-container">
                    <i class="fas fa-key icon" style="font-size: 18;"></i>
                    <input class="input-field" type="password" placeholder="Entrer votre nouveau mot de passe" name="newmotdepasse" id="newmotdepasse" required>
                </div>

                <input type="checkbox" onclick="show_mdp()">Afficher Mot de passe
			    <br><br>
                <input type="submit"  value="Modifier" name="change_password">
            </form>
        </div>
    </center>
</body>
</html>