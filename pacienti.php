<?php 
    $page ="pacienti";
    require "header.php";

    if(isset($_SESSION['username'])){
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
                    $pacientu_SQL = "SELECT * from gimenesarstsPacientiem";
                    $atlasa_pacientus = mysqli_query($savienojums, $pacientu_SQL) or die ("Nekorekts vaicājums");

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

                                        </form>
                                    </td>
                                </tr>
                            ";
                            // $row always contains info about databases
                        }
                    }else{
                        echo "Tabulā nav datu ko attēlot!";
                    }
                ?>

            </table>
        </div>
    </div>
</section>

<?php
    } else {
        echo "<div class='pazinojums sarkans'>TEV ŠEIT NAV PIEEJAS!</div>";
        header("Refresh: 0;url=login.php");
    }
include "footer.php"; ?>