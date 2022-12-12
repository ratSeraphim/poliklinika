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
                // saņem lietotāja vārdu un uzvārdu, lai to varētu izvadīt sākumlapā
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
       
        <!-- darbinieku sadaļu redz tikai cilvēki ar administratora piekļuvi -->
        <?php IF ($_SESSION["isadmin"] == "yes") { ?> 
            <a class="box" href="darbinieki.php">
            <i class="fas fa-suitcase-medical"></i> <br> Darbinieki
            </a>
        <?php } ?>
            
      
            <a class="box" href="files/logout.php">
            <i class="fas fa-power-off"></i> <p>Izlogoties</p>
            </a>
    </div>

    <?php 
    // saņemam datus par dažādajiem skaitiem/statistiku
    require ("connect_db.php");

    //pacientu skaits
    $pacSkSQL = "SELECT COUNT(pacients_id) AS pacSk FROM pacienti limit 1;";
    $pacResult = mysqli_query($savienojums, $pacSkSQL);
    if ($pacResult !== false){
        $row = mysqli_fetch_assoc($pacResult);
        $pacSk = $row['pacSk'];
    }
    //Vizīšu skaits
    $vizSkSQL = "SELECT COUNT(vizite_id) AS vizSk FROM vizite limit 1;";
    $vizResult = mysqli_query($savienojums, $vizSkSQL);
    if ($vizResult !== false){
        $row = mysqli_fetch_assoc($vizResult);
        $vizSk = $row['vizSk'];
    }

    //Pagājušo vizīšu skaits
    $pagvizSkSQL = "SELECT count(laiks) AS pagvizSk FROM vizites WHERE laiks < CURDATE();";
    $pagvizResult = mysqli_query($savienojums, $pagvizSkSQL);
    if ($pagvizResult !== false){
        $row = mysqli_fetch_assoc($pagvizResult);
        $pagvizSk = $row['pagvizSk'];
    }

    //Vēl aktuālo vizīšu skaits
    $nakvizSkSQL = "SELECT count(laiks) AS nakvizSk FROM vizites WHERE laiks >= CURDATE();";
    $nakvizResult = mysqli_query($savienojums, $nakvizSkSQL);
    if ($nakvizResult !== false){
        $row = mysqli_fetch_assoc($nakvizResult);
        $nakvizSk = $row['nakvizSk'];
    }


    ?>
    <!-- Izvada saņemtos datus -->
    <div class="izvelne">
        <div class="skaits">
            Pacientu skaits 
            <h1> <?php echo $pacSk; ?></h1>
            <a href='pacienti.php'><button class='btn-danger' type='button' value='button'>Pie pacientiem</button></a>
        </div>
        <div class="skaits">
             Vizīšu skaits 
             <h1><?php echo $vizSk; ?></h1>
            <a href='vizites.php'><button class='btn-danger' type='button' value='button'>Uz vizītēm</button></a>
        </div>
        <div class="skaits">
            Izpildītās vizītes 
            <h1><?php echo $pagvizSk; ?></h1>
        </div>
        <div class="skaits">
            Nākotnes vizītes 
            <h1>  <?php echo $nakvizSk; ?></h1>
        </div>

</body>



<?php
    } else {
        echo "<div class='pazinojums sarkans'>TEV ŠEIT NAV PIEEJAS!</div>";
        header("Refresh: 0;url=login.php");
    }
include "footer.php"; ?>