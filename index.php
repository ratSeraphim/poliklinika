<?php 
    $page ="sakums";
    require "header.php";
    if(isset($_SESSION['username'])){
 ?>




        <div id="lietotajaIzvade">
                    <h1> Sveiki, 
                    <?php 
                    require ("connect_db.php");

                    $lietv= $_SESSION['username'];

                    $res = mysqli_query($savienojums, "CALL lietotajaVards('$lietv')");
                    while($row=mysqli_fetch_array($res))
                    {
                        echo $row['nosaukums'];
                    }

                     ?>!</h1>
        </div>

    <div class="izvelne">

            <a class="box" href="vizites.php">
            <i class="fas fa-calendar"></i> <br> Vizītes 
            </a>
      
            <a class="box" href="pacienti.php">
            <i class="fas fa-users"></i> <br> Pacienti 
            </a>
       

        <?php IF ($_SESSION["isadmin"] == "yes") { ?> 
            <a class="box" href="darbinieki.php">
            <i class="fas fa-suitcase-medical"></i> <br> Darbinieki
            </a>
        <?php } ?>
            
      
            <a class="box" href="files/logout.php">
            <i class="fas fa-power-off"></i> <p>Izlogoties</p>
            </a>
    </div>


</body>
</html>


<?php
    } else {
        echo "<div class='pazinojums sarkans'>TEV ŠEIT NAV PIEEJAS!</div>";
        header("Refresh: 0;url=login.php");
    }
include "footer.php"; ?>