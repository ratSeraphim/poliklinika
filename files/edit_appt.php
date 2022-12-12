
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
     //Atjauno informāciju (ievieto saņemtos datus mainīgajos)
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

    require '../connect_db.php';
    //saņem datus priekš dropdown izvēlnes
    $pieejamiepakalpojumi = "SELECT * FROM `pakalpojums`";
    $pakalpojumi = mysqli_query($savienojums,$pieejamiepakalpojumi);

    $pieejamiearsti = "SELECT * FROM `arsti`";
    $arsti = mysqli_query($savienojums, $pieejamiearsti);

    $pieejamiepacienti = "SELECT * FROM `pacienti`";
    $pacienti = mysqli_query($savienojums, $pieejamiepacienti);

    $pieejamikabineti = "SELECT * FROM `kabinets`";
    $kabineti = mysqli_query($savienojums, $pieejamikabineti);
    ?>
    <!--Rediģēšanas saskarsne -->
    <!-- value="php.." attēlo ieraksta jau esošos datus -->

   
    <body>
        <div id="container">
    <form method="post">
    <h1>Rediģēt vizītes datus</h1>
    <!-- Paņem ierakstus no datubāzes un attēlo kā dropdown opcijas-->
    <label>Pacients:</label>
    <select name="id_pacients">
        <option><?php echo $row['id_pacients']; ?></option>
        <?php 
        while($row2 = mysqli_fetch_assoc($pacienti)){
            ?>
            <option value="<?=$row2['pacients_id']?>"><?=$row2['pacients_id']?> - <?=$row2['vards']?> <?=$row2['uzvards']?></option>
             <?php
            } 
        ?>
    </select><br/><br/>
    
    <label>Ārsts:</label>
    <select name="id_arsts">
        <option ><?php echo $row['id_arsts']; ?></option>
        <?php 
        while($row2 = mysqli_fetch_assoc($arsti)){
            ?>
            <option value="<?=$row2['darbinieks_id']?>"><?=$row2['darbinieks_id']?> - <?=$row2['vards']?> <?=$row2['uzvards']?></option>
             <?php
            } 
        ?>
    </select><br/><br/>
    
    <label>Laiks:</label><input type="datetime-local" name="laiks" placeholder="Laiks" value="<?php echo $row['laiks']; ?>" required><br/><br/>

    <label>Pakalpojums:</label>

<select name="id_pakalpojums">
   <option><?php echo $row['id_pakalpojums']; ?></option>
   <?php 
    while($row2 = mysqli_fetch_assoc($pakalpojumi)){
        ?>
        <option value="<?=$row2['pakalpojums_id']?>"><?=$row2['pakalpojums_id']?> - <?=$row2['nosaukums']?></option>
         <?php
        } 
    ?>
</select><br/><br/>

    <label>Ģimenes ārsta nosūtījums:</label> 
    <select name="gim_arsta_nosutijums">
            <option><?php echo $row['gim_arsta_nosutijums']; ?></option>
            <option value=1>1- Jā</option>
            <option value=0>0- Nē</option>
            <option value=null>Ģimenes ārsta apmeklējums</option>
    </select><br/><br/>

    <label>Valsts apmaksāts:</label>
    <select name="valsts_apmaksats" required>
            <option><?php echo $row['valsts_apmaksats']; ?></option>
            <option value=1>1 - Jā</option>
            <option value=0>0 - Nē</option>
    </select><br/><br/>

    <label>Apdrošināšana:</label>
    <select name="apdrosinasana" required>
            <option><?php echo $row['apdrosinasana']; ?></option>
            <option value=1>1 - Jā</option>
            <option value=0>0 - Nē</option>
    </select><br/><br/>

    <label>Kabinets:</label>
    <select name="id_kabinets">
        <option><?php echo $row['id_kabinets']; ?></option>
            <?php 
        while($row2 = mysqli_fetch_assoc($kabineti)){
            ?>
            <option value="<?=$row2['kabinets_id']?>"><?=$row2['kabinets_id']?></option>
             <?php
            } 
        ?>
        </select> <br> <br>
    <button class="btn" type="submit" name="btn-update" id="btn-update" onClick="update()">Izmainīt</button>
    <a href="../vizites.php"><button class="btn-danger" type="button" value="button">Atpakaļ</button></a>


    </form>
        <div class="image">
        <img src="../images/vizites.png">
        </div>  
    </div>

   <!-- Paziņo, ka tiek veiktas izmaiņas -->
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