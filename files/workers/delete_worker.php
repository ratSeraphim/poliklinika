<link rel="stylesheet" href="../style.css">
<?php
session_start();
require '../../connect_db.php';


    $id = $_GET['darbinieks_id']; //saņem vērtību
    $parbaudit = mysqli_query($savienojums, "CALL vaiAdmins('$id')");
    //pārbauda, vai izvēlētais darbinieks ir lietotājs ar administratora piekļuvi
    while($row=mysqli_fetch_assoc($parbaudit))
        {
            if($row['output'] == 1){
                $output = 1;
                
            } else if($row['output'] == 0){
                $output = 0;
            }
            mysqli_close($savienojums);
        }
        
        require '../../connect_db.php';
        if($output == 1){
            //ja lietotājam ir administratora piekļuve, tad to var dzēst tikai caur datubāzi. šādi pasargā no iespējas, ka 
            //lietotājs nejauši izdzēš sevi!
            echo "<div class='pazinojums sarkans'>Šo lietotāju nevar izdzēst!</div>
    
            <a href='../../darbinieki.php'><button class='btn-big' type='button' value='button'>Atpakaļ</button></a>";
            
        } else if($output == 0){
            mysqli_free_result($parbaudit);
            $dzest = "DELETE FROM darbinieki WHERE darbinieks_id = '$id';"; //izdzēš darbinieku ar ID, kurš sakrīt ar no pogas iegūto ID
            $result = mysqli_query($savienojums, $dzest); 
            if ($result) {
                //ja vaicājums veiksmīgs, pārlādē vizites.php lapu (var uzreiz redzēt izmaiņas)
                mysqli_close($savienojums);
                header("location: ../../darbinieki.php");
                exit();
            } else {
                echo "Neizdevās izdzēst!";
            }
        }
    
    
?>