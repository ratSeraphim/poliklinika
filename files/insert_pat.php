
<link rel="stylesheet" href="style.css">
<body>
<?php

require '../connect_db.php';
if(isset($_POST['submit']))
{    
    $vards = $_POST['vards'];
    $uzvards = $_POST['uzvards'];
    $gimenes_arsts = $_POST['gimenes_arsts'];
    $personas_kods = $_POST['personas_kods'];
    $dzim_datums= $_POST['dzim_datums'];
    $talrunis = $_POST['talrunis'];
    $epasts = $_POST['epasts'];
    $nacionalitate = $_POST['nacionalitate'];
    $id_adrese = $_POST['id_adrese'];
     $sql = "INSERT INTO pacienti (vards, uzvards, personas_kods, dzim_datums, talrunis, epasts, nacionalitate, gimenes_arsts, id_adrese)
     VALUES ('$vards','$uzvards', '$personas_kods', '$dzim_datums', '$talrunis', '$epasts', '$nacionalitate','$gimenes_arsts', '$id_adrese')";
    
    if(mysqli_query($savienojums, $sql)){
        echo "<div class='pazinojums sarkans'>Ieraksts pievienots veiksmīgi</div>
        
        <a href='../pacienti.php'><button class='btn-big' type='button' value='button'>Atpakaļ</button></a>";
        
        
    } else{
        echo "ERROR: Serveris nespēja izpildīt $sql. " . mysqli_error($savienojums);
    }
     mysqli_close($savienojums);
}
?>
</body>