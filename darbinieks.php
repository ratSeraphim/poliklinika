<?php 
    $page = "audzekni"; #Obligāti jādara pirms izsaucot header
    require "header.php";

    if(isset($_SESSION['username'])){
        if($_SESSION["isadmin"] == "yes"){
?>

<section id="adminSakums">
    <div class="row">
        <div class="info">
            <!-- Izvada informāciju par darbinieku -->
            <div class="head-info head-color">Apraksts par darbinieku: </div>
            <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    require("connect_db.php"); #Piesaista datubāzi

                    $darbinieksID = $_POST['apskatit'];
                    $darbinieksSQL = "SELECT * FROM darbiniekaInfo WHERE darbinieks_id = $darbinieksID";
                    $atlasaDarbinieku = mysqli_query($savienojums, $darbinieksSQL) or die ("Nekorekts vaicājums!");

                    while($row = mysqli_fetch_assoc($atlasaDarbinieku)){
                        echo "
                            <table>
                                <tr>
                                    <td rowspan='13'>
                                        <i class='fas fa-user user-ico'></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Darbinieks:</td><td class='value'>{$row['vards']} {$row['uzvards']}</td>
                                </tr>
                                <tr>
                                    <td>Darbinieka loma:</td><td class='value'>{$row['tips']}</td>
                                </tr>
                                <tr>
                                    <td>Tālrunis:</td><td class='value'>{$row['talrunis']}</td>
                                </tr>
                                <tr>
                                    <td>E-pasts:</td><td class='value'>{$row['epasts']}</td>
                                </tr>    
                                <tr>
                                    <td>Līguma nr.:</td><td class='value'>{$row['liguma_nr']}</td>
                                </tr>
                                <tr>
                                    <td>Dzīves vietas adrese:</td><td class='value'>{$row['adrese']}</td>
                                </tr>    
                                <tr>
                                    <td>Saites piekļuves lietotājvārds:</td><td class='value'>{$row['lietotajvards']}</td>
                                </tr>    
                                             
                            </table>  	
                        ";
                    }
                }else{
                    echo "<div class='pazinojums sarkans'>Kaut kas nogāja greizi! Atgriezies sākumlapā un mēģini vēlreiz!</div>";
                    header("Refresh:2; url=darbinieki.php");
                }        
                
                // izvada darbinieka specialitātes

                $specialitasu_SQL = "SELECT * FROM darbSpecialitates WHERE darbinieks_id = $darbinieksID;";
                $atlasa_specialitates = mysqli_query($savienojums, $specialitasu_SQL) or die ("Nekorekts vaicājums");


                ?> <table>
                <th> Specialitātes: </th> 
                <?php
                if(mysqli_num_rows($atlasa_specialitates) > 0) {
                    while($row = mysqli_fetch_assoc($atlasa_specialitates)){


                        echo "
                        
                            <tr>
                                <td>{$row['nosaukums']}</td>
                            </tr>
                        
                        ";
                        // $row always contains info about databases
                    }
                }else{
                        echo 
                        "<tr>
                        <td  class=none>Darbiniekam nav specialitāšu!</td>
                        </tr>";
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