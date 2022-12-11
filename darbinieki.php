<?php 
    $page ="darbinieki";
    require "header.php";

    if(isset($_SESSION['username'])){
        if($_SESSION["isadmin"] == "yes"){
 ?>

<section id="adminSakums">
<div class="row">
        <div class="info">
            <div class="head-info">Poliklīnikas darbinieku administrēšana</div>
            <table>
                <tr>
                    <th>Vārds</th>
                    <th>Uzvārds</th>
                    <th>Tips</th>
                    <th>Tālrunis</th>
                    <th></th>
                </tr>


                    
                <?php 
                    require ("connect_db.php");
                    $darbinieku_SQL = "SELECT * from darbinieki";
                    $atlasa_darbiniekus = mysqli_query($savienojums, $darbinieku_SQL) or die ("Nekorekts vaicājums");

                    if(mysqli_num_rows($atlasa_darbiniekus) > 0) {
                        while($row = mysqli_fetch_assoc($atlasa_darbiniekus)){


                            echo "
                                <tr>
                                    <td>{$row['vards']}</td>
                                    <td>{$row['uzvards']}</td>
                                    <td>{$row['tips']}</td>
                                    <td>{$row['talrunis']}</td>
                                    <td>
                                        <form action='darbinieks.php' method='post'>
                                            
                                        <button type='submit' class='btn2' name='apskatit' value='{$row['darbinieks_id']}'>
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
            header("Refresh: 0;url=index.php");
        }
    } else {
        echo "<div class='pazinojums sarkans'>TEV ŠEIT NAV PIEEJAS!</div>";
        header("Refresh: 0;url=login.php");
    }
include "footer.php"; ?>