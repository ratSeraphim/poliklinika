
<link rel="stylesheet" href="../style.css">
<body>
<?php

require '../../connect_db.php';
if(isset($_POST['submit']))
{    
    //saņem datus no ievietošanas laukiem un ievieto mainīgajos
    $id_pacients = $_POST['id_pacients'];
    $id_arsts = $_POST['id_arsts'];
    $laiks = $_POST['laiks'];
    $id_pakalpojums = $_POST['id_pakalpojums'];
    $gim_arsta_nosutijums= $_POST['gim_arsta_nosutijums'];
    $valsts_apmaksats = $_POST['valsts_apmaksats'];
    $apdrosinasana = $_POST['apdrosinasana'];
    $id_kabinets = $_POST['id_kabinets'];
      //mainīgos ievieto SQL vaicājumā, lai ievietotu datubāzē
     $sql = "INSERT INTO vizite (id_pacients, id_arsts, id_pakalpojums, gim_arsta_nosutijums, valsts_apmaksats, apdrosinasana, id_kabinets, laiks)
     VALUES ('$id_pacients','$id_arsts', '$id_pakalpojums', '$gim_arsta_nosutijums', '$valsts_apmaksats', '$apdrosinasana', '$id_kabinets','$laiks')";
    
    // ja vaicājums izdodas, tad izrāda paziņojumu, ka ieraksts ir pievienots
    if(mysqli_query($savienojums, $sql)){
        echo "<div class='pazinojums sarkans'>Ieraksts pievienots veiksmīgi</div>
        
        <a href='../../vizites.php'><button class='btn-big' type='button' value='button'>Atpakaļ</button></a>";
        
        
    } else{
        echo "ERROR: Serveris nespēja izpildīt $sql. " . mysqli_error($savienojums);
    }
     mysqli_close($savienojums);
}
?>
</body>