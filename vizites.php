<?php 
    $page ="vizites";
    require "header.php";

    if(isset($_SESSION['username'])){

        //pārbauda, kurā lappusē atrodies. Ja nav jau noteikta lappuse, tevi atgriež uz pirmo lappusi
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

                    // vietnes lappušu kods
                    $LimitPerPage = 4;
                    $offset = ($page -1) * $LimitPerPage;
                    $vizisu_SQL = "SELECT * FROM vizites LIMIT $LimitPerPage OFFSET $offset";
                    $atlasa_vizites = mysqli_query($savienojums, $vizisu_SQL) or die ("Nekorekts vaicājums");
//
                    $CountQuery = "SELECT count(*) FROM vizite";
                    $res = mysqli_query($savienojums, $CountQuery);
                    $records = mysqli_fetch_array($res)[0];
                    $totalpages = ceil($records / $LimitPerPage);

                    //ja vaicājuma rindu skaits ir augstāks par 0 (tātad nav tukšs), tad izvada vērtības
                    if(mysqli_num_rows($atlasa_vizites) > 0) {
                        while($row = mysqli_fetch_assoc($atlasa_vizites)){

                            //ja pacientam nav ģimenes ārsta nosūtījums > nav valsts apmaksāts pakalpojums > pacientam nav apdrošināšana, izvada X, savādāk izvada ķeksi
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

                           
                            if( strtotime($row['laiks']) > strtotime('now')){
                                 // Ja vizītes laiks ir nākotnē, tad tiek iekrāsots sarkans
                                $apmeklejumaLaiks = "<td class='velak'> {$row['laiks']} </td>";
                            } else {
                                // Ja vizītes laiks ir pagājis, tad tiek iekrāsots pelēcīgs
                                $apmeklejumaLaiks = "<td class='pagajis'> {$row['laiks']} </td>";
                            }
                                echo "
                                <tr>
                                    <td>{$row['pacients']}</td>
                                    <td>{$row['arsts']}</td>
                                    {$apmeklejumaLaiks}
                                    <td>{$row['pakNosaukums']}</td>
                                    <td class='check'>{$nosutijums}</td>
                                    <td class='check'>{$apmaksats}</td>
                                    <td class='check'>{$apdrosinats}</td>
                                    <td>{$row['kabinets']}</td>
                                    ";
                                ?>
                                    <td>
                                    <a class="btn-danger" onclick="DeleteConfirm()" href="files\appointment\delete_appt.php?vizite_id=<?php echo $row['vizite_id']; ?>">
                                        Dzēst
                                    </a>
                                    <a class="btn" href="files\appointment\edit_appt.php?edit_id=<?php echo $row['vizite_id']; ?>" alt="edit" >Rediģēt</a>
                                    <a class="btn" href="files\appointment\addup.php?edit_id=<?php echo $row['vizite_id']; ?>" alt="edit" >Aprēķins</a>
                                    </td>
                                    
                                </tr>
                           <?php
                            
                           
                            
                            
                        }
                    }else{
                        echo "Tabulā nav datu ko attēlot!";
                    }

                ?>

            </table>
                
            
            <script>
                //pabrīdina lietotāju, ka tiek veikts dzēšanas mēģinājus
                function DeleteConfirm() {
                confirm("Tu dzēs ierakstu!");
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
        <a class="btn-big" href="files\appointment\add_appt.php" alt="edit" >Pievienot jaunu</a>
<?php
    // Ja lietotājs nav ielogojies/nav sesijas, tad atgriež uz logina lapas
    } else {
        header("Refresh: 0;url=login.php");
    }
    //Pieliek kājeni
include "footer.php"; ?>