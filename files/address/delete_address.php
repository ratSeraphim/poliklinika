<?php
require '../../connect_db.php';

$id = $_GET['adrese_id']; //saņem vērtību
$dzest = "DELETE FROM adrese WHERE adrese_id = '$id';"; //izdzēš vizīti ar ID, kura sakrīt ar no pogas iegūto ID
$result = mysqli_query($savienojums, $dzest); 
if ($result) {
    //ja vaicājums veiksmīgs, pārlādē vizites.php lapu (var uzreiz redzēt izmaiņas)
    mysqli_close($savienojums);
    header("location: adreses.php");
    exit();
} else {
    echo "Neizdevās izdzēst!";
}
?>
