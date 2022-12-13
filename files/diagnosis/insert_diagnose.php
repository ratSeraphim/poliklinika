
<link rel="stylesheet" href="../style.css">
<body>
<?php

require '../../connect_db.php';
if(isset($_POST['submit']))
{    
    //saņem datus no ievietošanas laukiem un ievieto mainīgajos
    $diagnozes_kods = $_POST['diagnozes_kods'];
    $nosaukums = $_POST['nosaukums'];

    //mainīgos ievieto SQL vaicājumā, lai ievietotu datubāzē
     $sql = "INSERT INTO diagnoze (diagnozes_kods, nosaukums)
     VALUES ('$diagnozes_kods', '$nosaukums')";
    
    if(mysqli_query($savienojums, $sql)){
        echo "<div class='pazinojums sarkans'>Ieraksts pievienots veiksmīgi</div>
        
        <a href='diagnozes.php'><button class='btn-big' type='button' value='button'>Atpakaļ</button></a>";
        
        
    } else{
        echo "ERROR: Serveris nespēja izpildīt $sql. " . mysqli_error($savienojums);
    }
     mysqli_close($savienojums);
}
?>
</body>