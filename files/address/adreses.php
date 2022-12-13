<?php
$page = "cits"; #Obligāti jādara pirms izsaucot header
require "../editor_header.php";

if(isset($_SESSION['username'])){ 
    require '../../connect_db.php';
    //saņem datus priekš dropdown izvēlnes


;?>

<body>
    <div id="container">
        <!-- kad lietotājs nospiež submit pogu, tad atlasītie dati tiek nosūtīti uz kodu,
         kas atrodas norādītajā failā-->
        <form action="insert_address.php" method="post">
            <h1>Ievietot adresi</h1>
            <label>Valsts:</label><input type="text" name="valsts" placeholder="Valsts"  required><br/><br/>
            <label>Reģions:</label><input type="text" name="regions" placeholder="Reģions"  required><br/><br/>
            <label>Pilsēta:</label><input type="text" name="pilseta" placeholder="Pilsēta" required><br/><br/>
            <label>Iela:</label><input type="text" name="iela" placeholder="Iela" required><br/><br/>
            <label>Māja, dzīvoklis:</label><input type="text" name="maja" placeholder="Māja, dzīvoklis" required><br/><br/>
            <label>Pasta indekss:</label><input type="text" name="pasta_indekss" placeholder="LV-####" required><br/><br/>

            
            <button class="btn" type="submit" name="submit" id="submit" onClick="update()">Ievietot</button>
            <a href="../../cits.php"><button class="btn-danger" type="button" value="button">Atpakaļ</button></a>




<section id="adminSakums">
<div class="row">
        <div class="info">
            <div class="head-info">Adreses</div>
            <table>
                <tr>
                    <th>Valsts</th>
                    <th>Reģions</th>
                    <th>Pilsēta</th>
                    <th>Iela</th>
                    <th>Māja, dzīvoklis</th>
                    <th>Pasta indekss</th>

                </tr>


                    
                <?php 
                    require ("../../connect_db.php");
            // vietnes lappušu kods


                    $adresu_SQL = "SELECT * from adrese";
                    $atlasa_adreses = mysqli_query($savienojums, $adresu_SQL) or die ("Nekorekts vaicājums");

                    //ja vaicājuma rindu skaits ir augstāks par 0 (tātad nav tukšs), tad izvada vērtības
                    if(mysqli_num_rows($atlasa_adreses) > 0) {
                        while($row = mysqli_fetch_assoc($atlasa_adreses)){


                            echo "
                                <tr>
                                    <td>{$row['valsts']}</td>
                                    <td>{$row['regions']}</td>
                                    <td>{$row['pilseta']}</td>
                                    <td>{$row['iela']}</td>
                                    <td>{$row['maja']}</td>
                                    <td>{$row['pasta_indekss']}</td>
                                    <td>

                                        ";
                                        ?>
                                        <!-- pogas, kas pārved uz kodu kas nodrošina datu rediģēšanu vai dzēšanu -->
                                    <td>
                                        <a class="btn-danger" onclick="DeleteConfirm()" href="delete_address.php?adrese_id=<?php echo $row['adrese_id']; ?>">
                                            Dzēst
                                        </a>
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