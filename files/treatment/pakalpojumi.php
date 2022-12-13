<?php
$page = "cits"; #Obligāti jādara pirms izsaucot header
require "../editor_header.php";

if(isset($_SESSION['username'])){ 
    require '../../connect_db.php';
    //saņem datus priekš dropdown izvēlnes
    $pieejamiepacienti = "SELECT * FROM `pacienti`";
    $pacienti = mysqli_query($savienojums, $pieejamiepacienti);

    $pieejamiepakalpojumi = "SELECT * FROM `pakalpojums`";
    $pakalpojumi = mysqli_query($savienojums, $pieejamiepakalpojumi);

;?>

<body>
    <div id="container">
        <!-- kad lietotājs nospiež submit pogu, tad atlasītie dati tiek nosūtīti uz kodu,
         kas atrodas norādītajā failā-->
        <form action="insert_treatment.php" method="post">
            <h1>Ievietot pakalpojumu</h1>
            <label>Nosaukums:</label><input type="text" name="nosaukums" placeholder="Pakalpojuma nosaukums"  required><br/><br/>
            <label>Apraksts:</label><input type="text" name="apraksts" placeholder="Pakalpojuma apraksts" required><br/><br/>
            <label>Cena:</label><input type="number" name="cena" placeholder="0.00" min="1" step="any"  required><br/><br/>
            
            <button class="btn" type="submit" name="submit" id="submit" onClick="update()">Ievietot</button>
            <a href="../../cits.php"><button class="btn-danger" type="button" value="button">Atpakaļ</button></a>




<section id="adminSakums">
<div class="row">
        <div class="info">
            <div class="head-info">Pacientu administrēšana</div>
            <table>
                <tr>
                    <th>Pakalpojums</th>
                    <th>Apraksts</th>
                    <th>Cena</th>
                    <th></th>

                </tr>


                    
                <?php 
                    require ("../../connect_db.php");
            // vietnes lappušu kods


                    $pakalpojumu_SQL = "SELECT * from pakalpojums";
                    $atlasa_pakalpojumus = mysqli_query($savienojums, $pakalpojumu_SQL) or die ("Nekorekts vaicājums");

                    //ja vaicājuma rindu skaits ir augstāks par 0 (tātad nav tukšs), tad izvada vērtības
                    if(mysqli_num_rows($atlasa_pakalpojumus) > 0) {
                        while($row = mysqli_fetch_assoc($atlasa_pakalpojumus)){


                            echo "
                                <tr>
                                    <td>{$row['nosaukums']}</td>
                                    <td>{$row['apraksts']}</td>
                                    <td>{$row['cena']}</td>
                                    <td>

                                        ";
                                        ?>
                                        <!-- pogas, kas pārved uz kodu kas nodrošina datu rediģēšanu vai dzēšanu -->
                                    <td>
                                        <a class="btn-danger" onclick="DeleteConfirm()" href="delete_treatment.php?pakalpojums_id=<?php echo $row['pakalpojums_id']; ?>">
                                            Dzēst
                                        </a>
                                        <a class="btn" href="edit_treatment.php?edit_id=<?php echo $row['pakalpojums_id']; ?>" alt="edit" >Rediģēt</a>
                                        </form>
                                    </td>
                                        
                                </tr>
                                <?php
                                        

                        }
                    }else{
                        echo "Tabulā nav datu ko attēlot!";
                    }
                ?>

            </table>

        </div>
    </div>
</section>

    </div>
    <?php
    } else {
        echo "<div class='pazinojums sarkans'>TEV ŠEIT NAV PIEEJAS!</div>";
        header("Refresh: 0;url=../../login.php");
    }
include "../../footer.php"; ?>