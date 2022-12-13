<?php
require '../../connect_db.php';

$id = $_GET['darbinieka_specialitate_id']; //saņem vērtību
$dzest = "DELETE FROM darbinieka_specialitate WHERE darbinieka_specialitate_id = '$id';"; //izdzēš vizīti ar ID, kura sakrīt ar no pogas iegūto ID
$result = mysqli_query($savienojums, $dzest); 
if ($result) {
    //ja vaicājums veiksmīgs, ielādē darbinieki.php lapu
    mysqli_close($savienojums);
    header("location: ../../darbinieki.php");
    exit();
} else {
    echo "Neizdevās izdzēst!";
}
?>