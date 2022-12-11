<?php 
    $page = "pacients"; #Obligāti jādara pirms izsaucot header
    require "header.php";

    if(isset($_SESSION['username'])){
?>

<section id="adminSakums">
    <div class="row">
        <div class="info">
            <div class="head-info head-color">Apraksts par pacientu: </div>
            <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    require("connect_db.php"); #Piesaista datubāzi

                    $pacientsID = $_POST['apskatit']; #paņem vērtību no iepriekšējās lapas pogas
                    $pacientsSQL = "SELECT * FROM vissParPacientu WHERE pacients_id = $pacientsID"; #izvēlas skatu, kas sakrīt ar izvēlētā pacienta ID
                    $atlasaPacientu = mysqli_query($savienojums, $pacientsSQL) or die ("Nekorekts vaicājums!"); 

                    while($row = mysqli_fetch_assoc($atlasaPacientu)){
                        if(empty($row['personas_kods'])){
                            $pk = "<i class='fas fa-times'></i>";
                        } else {
                            $pk = $row['personas_kods'];
                        }
                        if(empty($row['talrunis'])){
                            $telnr = "<i class='fas fa-times'></i>";
                        } else {
                            $telnr = $row['talrunis'];
                        }
                        if(empty($row['epasts'])){
                            $eml = "<i class='fas fa-times'></i>";
                        } else {
                            $eml = $row['epasts'];
                        }
                        echo "
                            <table>
                                <tr>
                                    <td rowspan='13'>
                                    <i id='userImg' class='fa-solid fa-clipboard-user></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ID:</td><td class='value'>{$row['pacients_id']}</td>
                                </tr>
                                <tr>
                                    <td>Pacients:</td><td class='value'>{$row['vards']} {$row['uzvards']}</td>
                                </tr>
                                <tr>
                                    <td>Ģimenes ārsts: </td><td class='value'>{$row['gimenesarsts']}</td>
                                </tr>
                                <tr>
                                    <td>Dzimšanas dati:</td><td class='value'>{$row['dzim_datums']}</td>
                                </tr>
                                <tr>
                                    <td>Personas kods:</td><td class='value'>{$pk}</td>
                                </tr>   
                                <tr>
                                    <td>Tālrunis:</td><td class='value'>{$telnr}</td>
                                </tr>
                                <tr>
                                    <td>E-pasts:</td><td class='value'>{$eml}</td>
                                </tr>
                                <tr>
                                    <td>Dzīves vietas adrese:</td><td class='value'>{$row['adrese']}</td>
                                </tr>    
                                <tr>
                                    <td>Nacionalitāte:</td><td class='value'>{$row['nacionalitate']}</td>
                                </tr>   
                                                  
                            </table>  	
                        ";
                    }
                    // Izvada pacienta diagnozes
                $diagnozes_SQL = "SELECT * FROM diagnozes WHERE id_pacients = $pacientsID;";
                $atlasa_diagnozes = mysqli_query($savienojums, $diagnozes_SQL) or die ("Nekorekts vaicājums");


                ?> <table>
                <th> Diagnozes: </th> 
                <?php
                if(mysqli_num_rows($atlasa_diagnozes) > 0) {
                    while($row = mysqli_fetch_assoc($atlasa_diagnozes)){


                        echo "
                        
                            <tr>
                                <td>{$row['id_diagnoze']}</td>
                                <td>{$row['nosaukums']}</td>
                                <td>{$row['statuss']}</td>
                            </tr>
                        
                        
                        ";
                        // $row always contains info about databases
                    }
                }else{
                        echo 
                        "<tr>
                        <td  class=none>Pacientam nav diagnozes!</td>
                        </tr>";
                }
                }else{
                    echo "<div class='pazinojums sarkans'>Kaut kas nogāja greizi! Atgriezies sākumlapā un mēģini vēlreiz!</div>";
                    header("Refresh:2; url=pacienti.php");
                }        
                
                
            ?>
        </div>
    </div>
</section>

<?php 
    }else{
        echo"<div class='pazinojums sarkans'>TEV ŠEIT NAV PIEEJAS!</div>";
        header("Refresh: 0, url=login.php");
    }

?>