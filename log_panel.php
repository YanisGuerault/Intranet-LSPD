<?php include 'menu.php'; ?>
<?php if ($jesuisrh == '0' && $jesuisadmin == '0') { header("Location: index.php"); } ?>

<?php $resultat = mysqli_query($con, "SELECT * FROM log_panel ORDER BY id DESC"); ?>

<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="css/table.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="css/button.css" media="screen" type="text/css" />
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


<body>

<br><br><br><br><br><br><br><br><br>

<center>
    <h1>Log Panel</h1>
    <br><br>
    <input class="mainLoginInput" type='text' id='myInput' onkeyup='search()' placeholder='&#61442; Tapez votre recherche'/>
</center>

<center>
    <table>
        <thead>
            <tr>
                <th>
                    <center><b><i class='fas fa-user'></i> | Utilisateur</b></center>
                </th>
                <th>
                    <center><b><i class='fas fa-magic'></i> | Action Effectuer</b></center>
                </th>
                <th>
                    <center><b><i class='fas fa-calendar-alt'></i> | Date</b></center>
                </th>
            </tr>
        </thead>
        <?php while( $row = mysqli_fetch_array($resultat) ) :?>
        <tbody id="myTable">
            <tr>
                <td>
                    <center><?php echo $row['utilisateur'];?></center>
                </td>
                <td>
                    <?php echo $row['historique'];?>
                </td>
                <td>
                    <center><?php echo $row['quand'];?></center>
                </td>
            </tr>
        </tbody>
        <?php endwhile;?>
    </table>
<br><br>
</center>

</body>
</html>