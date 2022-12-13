<?php
$page = "cits"; #Obligāti jādara pirms izsaucot header
require "../editor_header.php";

if(isset($_SESSION['username'])){ 
    require '../../connect_db.php';
    //saņem datus priekš dropdown izvēlnes
    $pieejamiepacienti = "SELECT * FROM `pacienti`";
    $pacienti = mysqli_query($savienojums, $pieejamiepacienti);

    $pieejamasdiagnozes = "SELECT * FROM `diagnoze`";
    $diagnozes = mysqli_query($savienojums, $pieejamasdiagnozes);

;?>

<body>
    <div id="container">
        <!-- kad lietotājs nospiež submit pogu, tad atlasītie dati tiek nosūtīti uz kodu,
         kas atrodas norādītajā failā-->
        <form action="insert_diagnose.php" method="post">
            <h1>Ievietot diagnozi</h1>
            <label>Diagnozes kods:</label><input type="text" name="diagnozes_kods" placeholder="diagnozes kods"  required><br/><br/>
            <label>Nosaukums:</label><input type="text" name="nosaukums" placeholder="diagnozes nosaukums" required><br/><br/>
            
            <button class="btn" type="submit" name="submit" id="submit" onClick="update()">Ievietot</button>
            <a href="../../cits.php"><button class="btn-danger" type="button" value="button">Atpakaļ</button></a>


        </form>
        <div class="image">
            <img src="../../images/pakalpojumi.png">
        </div>  
        <form action="patientdiagnosis.php" method="post">
            <h1>Ievietot pacienta diagnozi</h1>
            <label>Diagnozes kods:</label>
            <select name="diagnozes_kods">
                <option hidden>Diagnoze</option>
                <?php 
                while($row = mysqli_fetch_assoc($diagnozes)){
                    ?>
                    <option value="<?=$row['diagnozes_kods']?>"> <?=$row['diagnozes_kods']?>: <?=$row['nosaukums']?></option>
                    <?php
                    } 
                ?>
            </select><br/><br/>
            <label>Pacients:</label>
            <select name="id_pacients">
                <option hidden>Pacients</option>
                <?php 
                while($row = mysqli_fetch_assoc($pacienti)){
                    ?>
                    <option value="<?=$row['pacients_id']?>"> <?=$row['vards']?> <?=$row['uzvards']?></option>
                    <?php
                    } 
                ?>
            </select><br/><br/>
            <label>Statuss:</label>
            <select name="statuss">
                <option hidden>Statuss</option>
                <option value="Aktīvs">Aktīvs</option>
                <option value="Izmeklēšanā">Izmeklēšanā</option>
                <option value="Izārstēts">Izārstēts</option>
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