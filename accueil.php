<?php include 'menu.php'; ?>
<?php  if ($monniveau <= '0') { header("Location: index.php"); } ?>

<?php

    $cblspd = "SELECT COUNT(*) AS total_compte FROM compte_lspd" ;
    $yalspd  = mysqli_query($con, $cblspd);
    $row = mysqli_fetch_array($yalspd);
    $count1 = $row['total_compte'];

    $cbrapport = "SELECT COUNT(*) AS total_rapport FROM rapport" ;
    $yarapport  = mysqli_query($con, $cbrapport);
    $data = mysqli_fetch_array($yarapport);
    $count2 = $data['total_rapport'];

    $cbplainte = "SELECT COUNT(*) AS total_plainte FROM plainte" ;
    $yaplainte  = mysqli_query($con, $cbplainte);
    $info = mysqli_fetch_array($yaplainte);
    $count3 = $info['total_plainte'];

    $cbcasier = "SELECT COUNT(*) AS total_casier FROM casier" ;
    $yacasier  = mysqli_query($con, $cbcasier);
    $dt = mysqli_fetch_array($yacasier);
    $count4 = $dt['total_casier'];

    $cbinfra = "SELECT COUNT(*) AS total_infra FROM infraction" ;
    $yainfra  = mysqli_query($con, $cbinfra);
    $blabla = mysqli_fetch_array($yainfra);
    $count5 = $blabla['total_infra'];

    $cbavis = "SELECT COUNT(*) AS total_avis_recherche FROM avis_de_recherche" ;
    $yaavis  = mysqli_query($con, $cbavis);
    $dsqdsq = mysqli_fetch_array($yaavis);
    $count6 = $dsqdsq['total_avis_recherche'];

?>


<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="css/inter.css" media="screen" type="text/css" />
    <link rel="shortcut icon" type="image/png" href="css/img/favicon.png" >
    <style>
    .column {
        float: left;
        width: 16.3%;
        padding: 0 5px;
    }
    .row {margin: 0 -5px;}
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
    @media screen and (max-width: 600px) {
        .column {
            width: 100%;
            display: block;
            margin-bottom: 10px;
        }
    }
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        padding: 16px;
        text-align: center;
        background-color: #444;
        color: #9ab;
    }
    .fa {font-size:75px;}
    </style>
</head>
<br><br><br><br><br><br><br><br><br>
<body>
    <center>
        <h1>Bienvenue <?php echo $level; ?> - <?php echo $jesuis; ?></h1>
    </center>
    <br><br><br><br><br><br><br><br><br>
    <div class="row">

        <div class="column">
            <div class="card">
                <i class="fa fa-user"></i>
                <h3 style="font-size:20px">Nombre d'agents enregistrés</h3>
                <h3 style="font-size:75px"><?php echo $count1; ?></h3>
            </div>
        </div>

        <div class="column">
            <div class="card">
                <i class="fa fa-copy"></i>
                <h3 style="font-size:20px">Nombre de rapports enregistrés</h3>
                <h3 style="font-size:75px"><?php echo $count2; ?></h3>
            </div>
        </div>

        <div class="column">
            <div class="card">
                <i class="fa fa-folder-open"></i>
                <h3 style="font-size:20px">Nombre de plaintes enregistrées</h3>
                <h3 style="font-size:75px"><?php echo $count3; ?></h3>
            </div>
        </div>

        <div class="column">
            <div class="card">
                <i class="fa fa-archive"></i>
                <h3 style="font-size:20px">Nombre de casiers enregistrés</h3>
                <h3 style="font-size:75px"><?php echo $count4; ?></h3>
            </div>
        </div>

        <div class="column">
            <div class="card">
                <i class="fa fa-hammer"></i>
                <h3 style="font-size:20px">Nombre d'infractions commise</h3>
                <h3 style="font-size:75px"><?php echo $count5; ?></h3>
            </div>
        </div>

        <div class="column">
            <div class="card">
                <i class="fa fa-user-secret"></i>
                <h3 style="font-size:20px">Nombre de personnes recherche</h3>
                <h3 style="font-size:75px"><?php echo $count6; ?></h3>
            </div>
        </div>

    </div>

</body>
</html>