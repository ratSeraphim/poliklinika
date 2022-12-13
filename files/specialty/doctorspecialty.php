
<link rel="stylesheet" href="../style.css">
<body>
<?php

require '../../connect_db.php';
if(isset($_POST['submit']))
{    
    //saņem datus no ievietošanas laukiem un ievieto mainīgajos
    $darbinieks_id = $_POST['darbinieks_id'];
    $specialitate_id = $_POST['specialitate_id'];

    //mainīgos ievieto SQL vaicājumā, lai ievietotu datubāzē
     $sql = "INSERT INTO darbinieka_specialitate (id_darbinieks, id_specialitate)
     VALUES ('$darbinieks_id','$specialitate_id')";
    
    if(mysqli_query($savienojums, $sql)){
        echo "<div class='pazinojums sarkans'>Ieraksts pievienots veiksmīgi</div>
        
        <a href='specialitates.php'><button class='btn-big' type='button' value='button'>Atpakaļ</button></a>";
        
        
    } else{
        echo "ERROR: Serveris nespēja izpildīt $sql. " . mysqli_error($savienojums);
    }
     mysqli_close($savienojums);
}
?>
</body>