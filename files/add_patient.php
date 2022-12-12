<?php
$page = "pacienti"; #Obligāti jādara pirms izsaucot header
require "editor_header.php";

if(isset($_SESSION['username'])){ 
    require '../connect_db.php';
    //saņem datus priekš dropdown izvēlnes
    $pieejamiearsti = "SELECT * FROM `gimenesarsti`";
    $arsti = mysqli_query($savienojums, $pieejamiearsti);

    $pieejamasadreses = "SELECT * FROM `adreseOneLine`";
    $adreses = mysqli_query($savienojums, $pieejamasadreses);?>

<body>
    <div id="container">
        <!-- kad lietotājs nospiež submit pogu, tad atlasītie dati tiek nosūtīti uz kodu,
         kas atrodas norādītajā failā-->
        <form action="insert_pat.php" method="post">
            <h1>Ievietot pacienta datus</h1>
            <label>Pacienta vārds:</label><input type="text" name="vards" placeholder="Vārds"  required><br/><br/>
            <label>Pacienta uzvārds:</label><input type="text" name="uzvards" placeholder="Uzvārds" required><br/><br/>
            <label>Ģimenes ārsts:</label>
             <!-- Paņem ierakstus no datubāzes un attēlo kā dropdown opcijas-->
            <select name="gimenes_arsts">
                <option hidden>Ģimenes ārsts</option>
                <?php 
                while($row2 = mysqli_fetch_assoc($arsti)){
                    ?>
                    <option value="<?=$row2['darbinieks_id']?>"> <?=$row2['vards']?> <?=$row2['uzvards']?></option>
                    <?php
                    } 
                ?>
            </select><br/><br/>
    
            <label>Personas kods:</label><input type="text" name="personas_kods" placeholder="Personas kods" required><br/><br/>
            <label>Dzimšanas datums:</label><input type="date" name="dzim_datums" placeholder="yyyy-mm-dd" required><br/><br/>
            <label>Tālrunis:</label><input type="text" maxlength="12" name="talrunis" required><br/><br/>
            <label>E-pasts:</label><input type="email" name="epasts" placeholder="email@email.com" required><br/><br/>
            <label>Nacionalitāte:</label><input type="text" name="nacionalitate" placeholder="Latvietis" required><br/><br/>

            <label>Adrese:</label>
            <select name="id_adrese">
                <option hidden>Adrese</option>
                <?php 
                while($row2 = mysqli_fetch_assoc($adreses)){
                    ?>
                    <option value="<?=$row2['adrese_id']?>"> <?=$row2['adrese']?></option>
                    <?php
                    } 
                ?>
            </select><br/><br/>
            <button class="btn" type="submit" name="submit" id="submit" onClick="update()">Izmainīt</button>
            <a href="../pacienti.php"><button class="btn-danger" type="button" value="button">Atpakaļ</button></a>


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