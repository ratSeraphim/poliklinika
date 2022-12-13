
<link rel="stylesheet" href="../style.css">
<body>
<?php

require '../../connect_db.php';
if(isset($_POST['submit']))
{    
    //saņem datus no ievietošanas laukiem un ievieto mainīgajos
    $valsts = $_POST['valsts'];
    $regions = $_POST['regions'];
    $pilseta = $_POST['pilseta'];
    $iela = $_POST['iela'];
    $maja = $_POST['maja'];
    $pasta_indekss = $_POST['pasta_indekss'];

    //mainīgos ievieto SQL vaicājumā, lai ievietotu datubāzē
     $sql = "INSERT INTO adrese (valsts, regions, pilseta, iela, maja, pasta_indekss)
     VALUES ('$valsts', '$regions', '$pilseta', '$iela', '$maja', '$pasta_indekss')";
    
    if(mysqli_query($savienojums, $sql)){
        echo "<div class='pazinojums sarkans'>Ieraksts pievienots veiksmīgi</div>
        
        <a href='adreses.php'><button class='btn-big' type='button' value='button'>Atpakaļ</button></a>";
        
        
    } else{
        echo "ERROR: Serveris nespēja izpildīt $sql. " . mysqli_error($savienojums);
    }
     mysqli_close($savienojums);
}
?>
</body>