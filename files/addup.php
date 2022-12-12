<?php 

$page ="vizites";
require "editor_header.php";
require ("../connect_db.php");

?>

<?php
    if(isset($_GET['edit_id'])){
        $vizite = $_GET['edit_id'];
        $sql = "CALL izmaksas('$vizite')";
        //izmaksas procedūra aprēķina cik pacientam jāmaksā par izvēlēto vizīti.
        $result = mysqli_query($savienojums, $sql);
        $row = mysqli_fetch_array($result);
    }
    {
        echo "<div class='pazinojums zals'> Pacientam par šo pakalpojumu jāmaksā: {$row['samaksa']} EUR</div>
        
        <a href='../vizites.php'><button class='btn-big' type='button' value='button'>Atpakaļ</button></a>";
    }
//skaits mainās atkarībā no pakalpojuma, no tā, vai lietotājam ir ģimenes ārsta nosūtījums,
//apdrošināšana, vai pakalpojums tiek apmaksāts
?>

<?php
    //Pieliek kājeni
include "../footer.php"; ?>