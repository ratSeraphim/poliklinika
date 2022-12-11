
<?php
$page = "vizites"; #Obligāti jādara pirms izsaucot header
require "editor_header.php";

if(isset($_SESSION['username'])){

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

   
    <body>
        <div id="container">
    <form method="post">
    <h1>Rediģēt vizītes datus</h1>
    <label>Pacienta ID:</label><input type="text" name="id_pacients" placeholder="Pacienta ID" value="<?php echo $row['id_pacients']; ?>" required><br/><br/>
    <label>Daktera ID:</label><input type="text" name="id_arsts" placeholder="Daktera ID" value="<?php echo $row['id_arsts']; ?>" required><br/><br/>
    <label>Laiks:</label><input type="datetime-local" name="laiks" placeholder="Laiks" value="<?php echo $row['laiks']; ?>" required><br/><br/>
    <label>Pakalpojuma ID:</label><input type="text" name="id_pakalpojums" placeholder="Pakalpojuma ID" value="<?php echo $row['id_pakalpojums']; ?>" required><br/><br/>
    <label>Ģimenes ārsta nosūtījums:</label> 
    <select name="gim_arsta_nosutijums">
            <option value=1>Jā</option>
            <option value=0>Nē</option>
            <option value=null>Ģimenes ārsta apmeklējums</option>
    </select><br/><br/>
    <label>Valsts apmaksāts:</label>
    <select name="valsts_apmaksats" required>
            <option value=1>Jā</option>
            <option value=0>Nē</option>
    </select><br/><br/>
    <label>Apdrošināšana:</label>
    <select name="apdrosinasana" required>
            <option value=1>Jā</option>
            <option value=0>Nē</option>
    </select><br/><br/>
    <label>Kabinets:</label><input type="text" name="id_kabinets" placeholder="id_kabinets" value="<?php echo $row['id_kabinets']; ?>" required><br/><br/>
    <button class="btn" type="submit" name="btn-update" id="btn-update" onClick="update()">Izmainīt</button>
    <a href="../vizites.php"><button class="btn-danger" type="button" value="button">Atpakaļ</button></a>


    </form>
        <div class="image">
        <img src="../images/vizites.png">
        </div>  
    </div>

    <!-- Alert for Updating -->
    <script>
    function update(){
    var x;
    if(confirm("Dati tiek rediģēti..") == true){
    x= "update";
    }
    }
    </script>



<?php
    } else {
        echo "<div class='pazinojums sarkans'>TEV ŠEIT NAV PIEEJAS!</div>";
        header("Refresh: 0;url=login.php");
    }
include "../footer.php"; ?>