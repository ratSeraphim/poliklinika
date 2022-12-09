<?php 
    $page ="vizites";
    require "header.php";

 ?>
<section id="adminSakums">
<div class="row">
        <div class="info">
            <div class="head-info">Vizīšu administrēšana</div>
            <table>
                <tr>
                    <th>Vārds</th>
                    <th>Uzvārds</th>
                    <th>Personas kods</th>
                    <th>Dzimšanas dati</th>
                    <th>Tālrunis</th>
                    <th>E-pasts</th>
                    <th>Nacionalitāte</th>
                    <th>Ģimenes ārsts</th>
                    <th>Adrese</th>
                    <th></th>
                </tr>

                <?php 
                    require ("connect_db.php");
                    $vizisu_SQL = "SELECT * FROM pacienti";
                    $atlasa_vizites = mysqli_query($savienojums, $vizisu_SQL) or die ("Nekorekts vaicājums");

                    if(mysqli_num_rows($atlasa_vizites) > 0) {
                        while($row = mysqli_fetch_assoc($atlasa_vizites)){


                            echo "
                                <tr>
                                    <td>{$row['vards']}</td>
                                    <td>{$row['uzvards']}</td>
                                    <td>{$row['personas_kods']}</td>
                                    <td>{$row['dzim_datums']}</td>
                                    <td>{$row['talrunis']}</td>
                                    <td>{$row['epasts']}</td>
                                    <td>{$row['nacionalitate']}</td>
                                    <td>{$row['gimenes_arsts']}</td>
                                    <td>{$row['id_adrese']}</td>
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