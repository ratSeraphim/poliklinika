<?php
//Datubāzes savienojums
require '../connect_db.php';
//Saņem ID no datubāzes
if(isset($_GET['edit_id'])){
 $sql = "SELECT * FROM vizite WHERE vizite_id =" .$_GET['edit_id'];
 $result = mysqli_query($savienojums, $sql);
 $row = mysqli_fetch_array($result);
}
//Update Information
if(isset($_POST['btn-update'])){
 $patientid = $_POST['id_pacients'];
 $doctorid = $_POST['id_arsts'];
 $laiks = $_POST['laiks'];
 $service = $_POST['id_pakalpojums'];
 $gimnosutijums = $_POST['gim_arsta_nosutijums'];
 $valsts_apmaksats = $_POST['valsts_apmaksats'];
 $apdrosinasana = $_POST['apdrosinasana'];
 $id_kabinets = $_POST['id_kabinets'];

 $update = "UPDATE vizite SET id_pacients='$patientid', id_arsts='$doctorid',
                            laiks=' $laiks',id_pakalpojums=' $service',gim_arsta_nosutijums='$gimnosutijums',valsts_apmaksats='$valsts_apmaksats',
                            apdrosinasana='$apdrosinasana', id_kabinets='$id_kabinets' WHERE vizite_id=". $_GET['edit_id'];
 $up = mysqli_query($savienojums, $update);
 if(!isset($sql)){
 die ("Error $sql" .mysqli_connect_error());
 }
 else
 {
 header("location: ../vizites.php");
 }
}
?>
<!--Create Edit form -->
<!doctype html>
<html>
<body>
<form method="post">
<h1>Rediģēt vizītes datus</h1>
<label>Pacienta ID:</label><input type="text" name="id_pacients" placeholder="Pacienta ID" value="<?php echo $row['id_pacients']; ?>"><br/><br/>
<label>Daktera ID:</label><input type="text" name="id_arsts" placeholder="Daktera ID" value="<?php echo $row['id_arsts']; ?>"><br/><br/>
<label>Laiks:</label><input type="datetime" name="laiks" placeholder="Laiks" value="<?php echo $row['laiks']; ?>"><br/><br/>
<label>Pakalpojuma ID:</label><input type="text" name="id_pakalpojums" placeholder="Pakalpojuma ID" value="<?php echo $row['id_pakalpojums']; ?>"><br/><br/>
<label>Ģimenes ārsta nosūtījums:</label><input type="text" name="gim_arsta_nosutijums" placeholder="Jā/Nē" value="<?php echo $row['gim_arsta_nosutijums']; ?>"><br/><br/>
<label>Valsts apmaksāts:</label><input type="text" name="valsts_apmaksats" placeholder="Jā/Nē" value="<?php echo $row['valsts_apmaksats']; ?>"><br/><br/>
<label>Apdrošināšana:</label><input type="text" name="apdrosinasana" placeholder="apdrosinasana" value="<?php echo $row['apdrosinasana']; ?>"><br/><br/>
<label>Kabinets:</label><input type="text" name="id_kabinets" placeholder="id_kabinets" value="<?php echo $row['id_kabinets']; ?>"><br/><br/>
<button type="submit" name="btn-update" id="btn-update" onClick="update()"><strong>Update</strong></button>
<a href="../vizites.php"><button type="button" value="button">Cancel</button></a>
</form>
<!-- Alert for Updating -->
<script>
function update(){
 var x;
 if(confirm("Updated data Sucessfully") == true){
 x= "update";
 }
}
</script>
</body>
</html>