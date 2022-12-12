<?php
$page = "vizites"; #Obligāti jādara pirms izsaucot header
require "editor_header.php";

if(isset($_SESSION['username'])){ 
    
    require '../connect_db.php';
    //saņem datus priekš dropdown izvēlnes
    $pieejamiepakalpojumi = "SELECT * FROM `pakalpojums`";
    $pakalpojumi = mysqli_query($savienojums,$pieejamiepakalpojumi);

    $pieejamiearsti = "SELECT * FROM `arsti`";
    $arsti = mysqli_query($savienojums, $pieejamiearsti);

    $pieejamiepacienti = "SELECT * FROM `pacienti`";
    $pacienti = mysqli_query($savienojums, $pieejamiepacienti);

    $pieejamikabineti = "SELECT * FROM `kabinets`";
    $kabineti = mysqli_query($savienojums, $pieejamikabineti);
    ?>

<body>
    <div id="container">
        <!-- kad lietotājs nospiež submit pogu, tad atlasītie dati tiek nosūtīti uz kodu,
         kas atrodas norādītajā failā-->
        <form action="insert_appt.php" method="post">
            <h1>Ievietot vizītes datus</h1>
            <label>Pacients:</label>
            <!-- Paņem ierakstus no datubāzes un attēlo kā dropdown opcijas-->
    <select name="id_pacients">
        <option hidden>Pacients</option>
        <?php 
        while($row = mysqli_fetch_assoc($pacienti)){
            ?>
            <option value="<?=$row['pacients_id']?>"><?=$row['vards']?> <?=$row['uzvards']?></option>
             <?php
            } 
        ?>
    </select><br/><br/>
            <label>Ārsts:</label>
    <select name="id_arsts">
        <option hidden>Ārsts</option>
        <?php 
        while($row = mysqli_fetch_assoc($arsti)){
            ?>
            <option value="<?=$row['darbinieks_id']?>"><?=$row['vards']?> <?=$row['uzvards']?></option>
             <?php
            } 
        ?>
    </select><br/><br/>

            <label>Laiks:</label><input type="datetime-local" name="laiks" placeholder="Laiks" required><br/><br/>
            <label>Pakalpojums:</label>

    <select name="id_pakalpojums">
       <option hidden>Pakalpojums</option>
       <?php 
        while($row = mysqli_fetch_assoc($pakalpojumi)){
            ?>
            <option value="<?=$row['pakalpojums_id']?>"><?=$row['nosaukums']?></option>
             <?php
            } 
        ?>
    </select><br/><br/>
            
            <label>Ģimenes ārsta nosūtījums:</label> 
    <select name="gim_arsta_nosutijums">
    <option hidden>Vai pacientam ir nosūtījums?</option>
            <option value=1>Jā</option>
            <option value=0>Nē</option>
            <option value=null>Ģimenes ārsta apmeklējums</option>
    </select><br/><br/>
    <label>Valsts apmaksāts:</label>
    <select name="valsts_apmaksats" required>
    <option hidden>Vai vizīte ir valsts apmaksāta?</option>
            <option value=1>Jā</option>
            <option value=0>Nē</option>
    </select><br/><br/>
    <label>Apdrošināšana:</label>
    <select name="apdrosinasana" required>
    <option hidden>Vai pacientam ir apdrošināšana?</option>
            <option value=1>Jā</option>
            <option value=0>Nē</option>
    </select><br/><br/>
            <label>Kabinets:</label>
    <select name="id_kabinets">
            <?php 
        while($row = mysqli_fetch_assoc($kabineti)){
            ?>
            <option value="<?=$row['kabinets_id']?>"><?=$row['kabinets_id']?></option>
             <?php
            } 
        ?>
        </select> <br> <br>
            <button class="btn" type="submit" name="submit" id="submit" onClick="update()">Iesūtīt</button>
            <a href="../vizites.php"><button class="btn-danger" type="button" value="button">Atpakaļ</button></a>


        </form>
        <div class="image">
            <img src="../images/pacienti.png">
        </div>  
    </div>
<?php

    } else {
        echo "<div class='pazinojums sarkans'>TEV ŠEIT NAV PIEEJAS!</div>";
        header("Refresh: 0;url=login.php");
    }
include "../footer.php"; ?>