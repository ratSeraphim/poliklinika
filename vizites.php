<?php 
    $page ="vizites";
    require "header.php";

    if(isset($_SESSION['username'])){

        if (isset($_GET['page']))
        {
            $page = $_GET['page'];
        }
        else
        {
            $page = 1;
        }
        

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
                    <th class='check'>Ģim. ārsta nosūtījums</th>
                    <th class='check'>Valsts apmaksāts</th>
                    <th class='check'>Apdrošināts</th>
                    <th>Kabinets</th>
                    <th>
                    </th>

                </tr>

                <?php 
                    require ("connect_db.php");

                    $LimitPerPage = 4;
                    $offset = ($page -1) * $LimitPerPage;
                    $vizisu_SQL = "SELECT * FROM vizites LIMIT $LimitPerPage OFFSET $offset";
                    $atlasa_vizites = mysqli_query($savienojums, $vizisu_SQL) or die ("Nekorekts vaicājums");
//
                    $CountQuery = "SELECT count(*) FROM vizite";
                    $res = mysqli_query($savienojums, $CountQuery);
                    $records = mysqli_fetch_array($res)[0];
                    $totalpages = ceil($records / $LimitPerPage);

                    if(mysqli_num_rows($atlasa_vizites) > 0) {
                        while($row = mysqli_fetch_assoc($atlasa_vizites)){

                            if(empty($row['gim_arsta_nosutijums'])){
                                $nosutijums = "<i class='fas fa-times'></i>";
                            } else {
                                $nosutijums = "<i class='fas fa-check'></i>";
                            }
                            if(empty($row['valsts_apmaksats'])){
                                $apmaksats = "<i class='fas fa-times'></i>";
                            } else {
                                $apmaksats = "<i class='fas fa-check'></i>";
                            }
                            if(empty($row['apdrosinasana'])){
                                $apdrosinats = "<i class='fas fa-times'></i>";
                            } else {
                                $apdrosinats = "<i class='fas fa-check'></i>";
                            }
                                echo "
                                <tr>
                                    <td>{$row['pacients']}</td>
                                    <td>{$row['arsts']}</td>
                                    <td>{$row['laiks']}</td>
                                    <td>{$row['pakNosaukums']}</td>
                                    <td class='check'>{$nosutijums}</td>
                                    <td class='check'>{$apmaksats}</td>
                                    <td class='check'>{$apdrosinats}</td>
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

        <div class=lappuses> 
            <!-- 1 lappuse uz atpakaļu -->
            <a class="lpp <?php if($page <= 1){ echo 'disabled'; } ?>"
                href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>">
                &lt;&lt;
            </a>
            <!-- lappuses numuri -->
            <?php
                for($num = 1; $num<= $totalpages; $num++) { 
                    echo '<a class="lpp" href = "?page=' . $num . '">' . $num . ' </a>';
                }
            ?>
            <!-- 1 lappuse uz priekšu -->
            <a class="lpp <?php if($page >= $totalpages){ echo 'disabled'; } ?>"
                href="<?php if($page >= $totalpages){ echo '#'; } else { echo "?page=".($page + 1); } ?>">
                &gt;&gt;
            </a>
        </div>
<?php
    } else {
        header("Refresh: 0;url=login.php");
    }
include "footer.php"; ?>