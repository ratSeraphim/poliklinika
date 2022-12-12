<link rel="stylesheet" href="style.css">
<?php
session_start();
require '../connect_db.php';

// add function to prevent admin and owner deletion !! 

    $id = $_GET['darbinieks_id']; //saņem vērtību
    $parbaudit = mysqli_query($savienojums, "CALL vaiAdmins('$id')");
    while($row=mysqli_fetch_assoc($parbaudit))
        {
            if($row['output'] == 1){
                $output = 1;
                
            } else if($row['output'] == 0){
                $output = 0;
            }
            mysqli_close($savienojums);
        }
        
        require '../connect_db.php';
        if($output == 1){
            echo "<div class='pazinojums sarkans'>Šo lietotāju nevar izdzēst!</div>
    
            <a href='../darbinieki.php'><button class='btn-danger' type='button' value='button'>Atpakaļ</button></a>";
            
        } else if($output == 0){
            mysqli_free_result($parbaudit);
            $dzest = "DELETE FROM darbinieki WHERE darbinieks_id = '$id';"; //izdzēš darbinieku ar ID, kurš sakrīt ar no pogas iegūto ID
            $result = mysqli_query($savienojums, $dzest); 
            if ($result) {
                //ja vaicājums veiksmīgs, pārlādē vizites.php lapu (var uzreiz redzēt izmaiņas)
                mysqli_close($savienojums);
                header("location: ../darbinieki.php");
                exit();
            } else {
                echo "Neizdevās izdzēst!";
            }
        }
    
    
?>