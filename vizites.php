<?php 
    $page ="vizites";
    require "header.php";

    if(isset($_SESSION['username'])){
 ?>
<section id="adminSakums">
<div class="row">
        <div class="info">
            <div class="head-info">Vizīšu administrēšana</div>
            <table>
                <tr>
                    <th>Pacients</th>
                    <th>Ārsts</th>
                    <th>Laiks</th>
                    <th>Veicamais Pakalpojums</th>
                    <th>Ģim. ārsta nosūtījums</th>
                    <th>Valsts apmaksāts</th>
                    <th>Apdrošināts</th>
                    <th>Kabinets</th>
                    <th>
                    </th>

                </tr>

                <?php 
                    require ("connect_db.php");
                    $vizisu_SQL = "SELECT * FROM vizites";
                    $atlasa_vizites = mysqli_query($savienojums, $vizisu_SQL) or die ("Nekorekts vaicājums");
//

                    if(mysqli_num_rows($atlasa_vizites) > 0) {
                        while($row = mysqli_fetch_assoc($atlasa_vizites)){

                           
                                echo "
                                <tr>
                                    <td>{$row['pacients']}</td>
                                    <td>{$row['arsts']}</td>
                                    <td>{$row['laiks']}</td>
                                    <td>{$row['pakNosaukums']}</td>
                                    <td>{$row['gim_arsta_nosutijums']}</td>
                                    <td>{$row['valsts_apmaksats']}</td>
                                    <td>{$row['apdrosinasana']}</td>
                                    <td>{$row['kabinets']}</td>
                                    ";
                                ?>
                                    <td>
                                    <a class="btn" onclick="DeleteConfirm()" href="files\delete_appt.php?vizite_id=<?php echo $row['vizite_id']; ?>">
                                        Dzēst
                                    </a>
                                    <a class="btn" href="files\edit_appt.php?vizite_id=<?php echo $row['vizite_id']; ?>">Rediģēt</a>
                                    </td>
                                    
                                </tr>
                           <?php
                            
                         //   }
                            
                            // $row always contains info about databases
                           
                            
                            
                        }
                    }else{
                        echo "Tabulā nav datu ko attēlot!";
                    }

                    
                ?>

            </table>
                
            <script>
                function DeleteConfirm() {
                confirm("Vai esi pārliecināts, ka vēlies dzēst ierakstu?");
                }
                function value(){
                confirm("Pacientam jāmaksā ")
                }
            </script>
        </div>
    </div>
</section>
<?php
    } else {
        echo "<div class='pazinojums sarkans'>TEV ŠEIT NAV PIEEJAS!</div>";
        header("Refresh: 0;url=login.php");
    }
include "footer.php"; ?>