<?php
require '../../connect_db.php';

$id = $_GET['pakalpojums_id']; //saņem vērtību
$dzest = "DELETE FROM pakalpojums WHERE pakalpojums_id = '$id';"; //izdzēš vizīti ar ID, kura sakrīt ar no pogas iegūto ID
$result = mysqli_query($savienojums, $dzest); 
if ($result) {
    //ja vaicājums veiksmīgs, pārlādē vizites.php lapu (var uzreiz redzēt izmaiņas)
    mysqli_close($savienojums);
    header("location: pakalpojumi.php");
    exit();
} else {
    echo "Neizdevās izdzēst!";
}
?>
