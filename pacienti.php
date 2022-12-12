<?php 
    $page ="pacienti";
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
            <div class="head-info">Pacientu administrēšana</div>
            <table>
                <tr>
                    <th>Vārds</th>
                    <th>Uzvārds</th>
                    <th>Dzimšanas dati</th>
                    <th>Ģimenes ārsts</th>
                    <th></th>
                </tr>


                    
                <?php 
                    require ("connect_db.php");
            // vietnes lappušu kods
                    $LimitPerPage = 4;
                    $offset = ($page -1) * $LimitPerPage;

                    $CountQuery = "SELECT count(*) FROM pacienti";
                    $res = mysqli_query($savienojums, $CountQuery);
                    $records = mysqli_fetch_array($res)[0];
                    $totalpages = ceil($records / $LimitPerPage);

                    $pacientu_SQL = "SELECT * from gimenesarstsPacientiem LIMIT $LimitPerPage OFFSET $offset";
                    $atlasa_pacientus = mysqli_query($savienojums, $pacientu_SQL) or die ("Nekorekts vaicājums");

                    //ja vaicājuma rindu skaits ir augstāks par 0 (tātad nav tukšs), tad izvada vērtības
                    if(mysqli_num_rows($atlasa_pacientus) > 0) {
                        while($row = mysqli_fetch_assoc($atlasa_pacientus)){


                            echo "
                                <tr>
                                    <td>{$row['vards']}</td>
                                    <td>{$row['uzvards']}</td>
                                    <td>{$row['dzim_datums']}</td>
                                    <td>{$row['gimenesarsts']}</td>
                                    <td>
                                        <form action='pacients.php' method='post'>
                                            
                                        <button type='submit' class='btn2' name='apskatit' value='{$row['pacients_id']}'>
                                        <i class='fa-solid fa-magnifying-glass'></i>
                                        </button>
                                        ";
                                        ?>
                                        <!-- pogas, kas pārved uz kodu kas nodrošina datu rediģēšanu vai dzēšanu -->
                                        <td>
                                        <a class="btn-danger" onclick="DeleteConfirm()" href="files\delete_patient.php?pacients_id=<?php echo $row['pacients_id']; ?>">
                                            Dzēst
                                        </a>
                                        <a class="btn" href="files\edit_patient.php?edit_id=<?php echo $row['pacients_id']; ?>" alt="edit" >Edit</a>
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

        
<a class="btn-big" href="files\add_patient.php" alt="edit" >Pievienot jaunu</a>
<script>
    //pabrīdina lietotāju, ka tiek veikts dzēšanas mēģinājus
        function DeleteConfirm() {
        confirm("Tu dzēs ierakstu!");
        }
</script>
<?php
    } else {
        echo "<div class='pazinojums sarkans'>TEV ŠEIT NAV PIEEJAS!</div>";
        header("Refresh: 0;url=login.php");
    }
include "footer.php"; ?>