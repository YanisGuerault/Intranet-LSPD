<?php include 'config.php'; ?>

<?php

session_start([
    'cookie_lifetime' => 86400,
    'read_and_close'  => true,
]);

$message = "";

if(isset($_POST['motdepasse']))      $motdepasse=$_POST['motdepasse'];
else      $motdepasse="";

$motdepassecryt = hash('sha512', $motdepasse);

if (count($_POST) > 0) 
{
    $result = mysqli_query ($con, " SELECT * FROM compte_lspd WHERE utilisateur ='" . $_POST['utilisateur'] . "' AND motdepasse = '$motdepassecryt' AND grade > 0 AND grade <= 15 ORDER BY id ASC" );
    $row  = mysqli_fetch_array ($result);
    if (is_array($row))
    {
        $_SESSION['id'] = $row['id'];
        $_SESSION['utilisateur'] = $row['utilisateur'];
        $_SESSION['motdepasse'] = $row['motdepasse'];
        $_SESSION['grade'] = $row['grade'];
        $_SESSION['matricule'] = $row['matricule'];
        $_SESSION['rh'] = $row['rh'];
        $_SESSION['isadmin'] = $row['isadmin'];
        $_SESSION['issuperadmin'] = $row['issuperadmin'];
    }
    else {
        $message = "<center><p>Identifiant Incorrect !</p></center>";
    }

    $con = '<script>';
    $con .='console.log("from PHP :'. $_POST['utilisateur'] .'")';
    $con .= '</script>';

    echo $con;
}

if(isset($_SESSION['id'])) {
    header("Location: ./index.php");
}

$con = '<script>';
$con .='console.log("from PHP :'. $_SESSION['id'] .'")';
$con .= '</script>';

echo $con;
?>

<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="css/login.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/png" href="css/img/favicon.png" >
</head>

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
    <div id="container">
        <form method="POST" >
            <h1>Intranet LSPD Osmoze RP</h1>
            <?php if($message!="") { echo $message; } ?> 
            <br>
    
            <div class="input-container">
                <i class="fas fa-user-alt icon"></i>
                <input class="input-field" type="text" placeholder="Entrer le nom d'utilisateur" name="utilisateur" required>
            </div>

            <div class="input-container">
                <i class="fas fa-key icon"></i>
                <input class="input-field" type="password" placeholder="Entrer le mot de passe" name="motdepasse" id="motdepasse" required>
            </div>
            <input type="checkbox" onclick="show_mdp()">Afficher Mot de passe
            <br><br>
            <input type="submit" value="Connexion" name="id">
        </form>
    </div>
    <br> <br> <br> <br> <br> <br> <br> <br> <br>
    <center>
        <h1>Réaliser par <i>@Bollin0</i> & <i>Yanis Forley</i></h1>
    </center>
</body>
</html>