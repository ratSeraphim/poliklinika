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
                        echo "
                            <table>
                                <tr>
                                    <td rowspan='13'>
                                        <img id='pacientsImg' src='images/pacienti.png'>
                                    </td>
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
                                    <td>Personas kods:</td><td class='value'>{$row['personas_kods']}</td>
                                </tr>   
                                <tr>
                                    <td>Tālrunis:</td><td class='value'>{$row['talrunis']}</td>
                                </tr>
                                <tr>
                                    <td>E-pasts:</td><td class='value'>{$row['epasts']}</td>
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
                }else{
                    echo "<div class='pazinojums sarkans'>Kaut kas nogāja greizi! Atgriezies sākumlapā un mēģini vēlreiz!</div>";
                    header("Refresh:2; url=audzekni.php");
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

    include "footer.php";
?>