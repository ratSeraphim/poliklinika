<?php
$page = "cits"; #Obligāti jādara pirms izsaucot header
require "../editor_header.php";

if(isset($_SESSION['username'])){ 
    require '../../connect_db.php';
    //saņem datus priekš dropdown izvēlnes
    $pieejamiearsti = "SELECT * FROM `arsti`";
    $arsti = mysqli_query($savienojums, $pieejamiearsti);

    $pieejamasspec = "SELECT * FROM `specialitate`";
    $specialitates = mysqli_query($savienojums, $pieejamasspec);

;?>

<body>
    <div id="container">
        <!-- kad lietotājs nospiež submit pogu, tad atlasītie dati tiek nosūtīti uz kodu,
         kas atrodas norādītajā failā-->
        <form action="insert_specialty.php" method="post">
            <h1>Ievietot specialitāti</h1>
            <label>Specialitātes nosaukums:</label><input type="text" name="nosaukums" placeholder="Nosaukums"  required><br/><br/>
            
            
            <button class="btn" type="submit" name="submit" id="submit" onClick="update()">Ievietot</button>
            <a href="../../cits.php"><button class="btn-danger" type="button" value="button">Atpakaļ</button></a>


        </form>
        <div class="image">
            <img src="../../images/editor.png">
        </div>  
        <form action="doctorspecialty.php" method="post">
            <h1>Ievietot darbinieka specialitāti</h1>
            <label>Ārsts:</label>
            <select name="darbinieks_id">
                <option hidden>Ārsts</option>
                <?php 
                while($row = mysqli_fetch_assoc($arsti)){
                    ?>
                    <option value="<?=$row['darbinieks_id']?>"><?=$row['vards']?> <?=$row['uzvards']?></option>
                    <?php
                    } 
                ?>
            </select><br/><br/>
            <label>Specialitāte:</label>
            <select name="specialitate_id">
                <option hidden>Specialitāte</option>
                <?php 
                while($row = mysqli_fetch_assoc($specialitates)){
                    ?>
                    <option value="<?=$row['specialitate_id']?>"> <?=$row['nosaukums']?></option>
                    <?php
                    } 
                ?>
            </select><br/><br/>
            
            <button class="btn" type="submit" name="submit" id="submit" onClick="update()">Izmainīt</button>
            <a href="../../cits.php"><button class="btn-danger" type="button" value="button">Atpakaļ</button></a>


        </form>

        
    </div>
    <?php
    } else {
        echo "<div class='pazinojums sarkans'>TEV ŠEIT NAV PIEEJAS!</div>";
        header("Refresh: 0;url=../../login.php");
    }
include "../../footer.php"; ?>