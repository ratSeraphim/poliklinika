<?php
$page = "cits"; #Obligāti jādara pirms izsaucot header
require "../editor_header.php";

if(isset($_SESSION['username'])){

    //Datubāzes savienojums
    require '../../connect_db.php';
    //Saņem ID no datubāzes
    if(isset($_GET['edit_id'])){
    $sql = "SELECT * FROM pacienta_diagnoze WHERE pacienta_diagnoze_id =" .$_GET['edit_id'];
    $result = mysqli_query($savienojums, $sql);
    $row = mysqli_fetch_array($result);
    }
      //Atjauno informāciju (ievieto saņemtos datus mainīgajos)
    if(isset($_POST['btn-update'])){
    $id_diagnoze = $_POST['diagnozes_kods'];
    $id_pacients = $_POST['id_pacients'];
    $statuss = $_POST['statuss'];

    $update = "UPDATE pacienta_diagnoze SET id_diagnoze='$id_diagnoze', id_pacients='$id_pacients', statuss='$statuss' WHERE pacienta_diagnoze_id=". $_GET['edit_id'];
    $up = mysqli_query($savienojums, $update);
    if(!isset($sql)){
    die ("Error $sql" .mysqli_connect_error());
    }
    else
    {
    header("location: ../../pacienti.php");
    }
    }
    //saņem datus priekš dropdown izvēlnes
    $pieejamiepacienti = "SELECT * FROM `pacienti`";
    $pacienti = mysqli_query($savienojums, $pieejamiepacienti);

    $pieejamasdiagnozes = "SELECT * FROM `diagnoze`";
    $diagnozes = mysqli_query($savienojums, $pieejamasdiagnozes);
    ?>
    <!--Rediģēšanas saskarsne -->
    <!-- value="php.." attēlo ieraksta jau esošos datus -->
   
    <body>
        <div id="container">
    <form method="post">
    <h1>Rediģēt pacienta datus</h1>
    <label>Diagnozes kods:</label>
    <!-- Paņem ierakstus no datubāzes un attēlo kā dropdown opcijas-->
            <select name="diagnozes_kods">
                <option><?php echo $row['id_diagnoze']; ?></option>
                <?php 
                while($row2 = mysqli_fetch_assoc($diagnozes)){
                    ?>
                    <option value="<?=$row2['diagnozes_kods']?>"> <?=$row2['diagnozes_kods']?>: <?=$row2['nosaukums']?></option>
                    <?php
                    } 
                ?>
            </select><br/><br/>
     
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
    <label>Statuss:</label>
            <select name="statuss">
                <option ><?php echo $row['statuss']; ?></option>
                <option value="Aktīvs">Aktīvs</option>
                <option value="Izmeklēšanā">Izmeklēšanā</option>
                <option value="Izārstēts">Izārstēts</option>
        </select><br/><br/>

    <button class="btn" type="submit" name="btn-update" id="btn-update" onClick="update()">Izmainīt</button>
    <a href="../../pacienti.php"><button class="btn-danger" type="button" value="button">Atpakaļ</button></a>


    </form>
        <div class="image">
        <img src="../../images/pacienti.png">
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
        header("Refresh: 0;url=../../login.php");
    }
include "../../footer.php"; ?>