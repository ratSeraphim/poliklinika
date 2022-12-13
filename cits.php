<?php 
    $page ="cits";
    require "header.php";
    if(isset($_SESSION['username'])){
 ?>




    <div class="izvelne2">

            <a class="box" href="files/diagnosis/diagnozes.php">
            <i class="fas fa-virus"></i><br> Diagnozes
            </a>
      
            <a class="box" href="files/treatment/pakalpojumi.php">
            <i class="fas fa-clipboard"></i>  <br> Pakalpojumi
            </a>
       
        
            <a class="box" href="files/address/adreses.php">
            <i class="fas fa-map"></i> <p>Adreses</p>
            </a>
      
            <a class="box" href="files/specialty/specialitates.php">
            <i class="fas fa-address-card"></i> <p>Specialitātes</p>
            </a>

    </div>



<?php
    } else {
        echo "<div class='pazinojums sarkans'>TEV ŠEIT NAV PIEEJAS!</div>";
        header("Refresh: 0;url=login.php");
    }
include "footer.php"; ?>