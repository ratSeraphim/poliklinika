<?php
$page = "cits"; #Obligāti jādara pirms izsaucot header
require "../editor_header.php";

if(isset($_SESSION['username'])){

    //Datubāzes savienojums
    require '../../connect_db.php';
    //Saņem ID no datubāzes
    if(isset($_GET['edit_id'])){
    $sql = "SELECT * FROM pakalpojums WHERE pakalpojums_id =" .$_GET['edit_id'];
    $result = mysqli_query($savienojums, $sql);
    $row = mysqli_fetch_array($result);
    }
      //Atjauno informāciju (ievieto saņemtos datus mainīgajos)
    if(isset($_POST['btn-update'])){
    $nosaukums = $_POST['nosaukums'];
    $apraksts = $_POST['apraksts'];
    $cena = $_POST['cena'];


    $update = "UPDATE pakalpojums SET nosaukums='$nosaukums', apraksts='$apraksts', cena='$cena'
                                WHERE pakalpojums_id=". $_GET['edit_id'];
    $up = mysqli_query($savienojums, $update);
    if(!isset($sql)){
    die ("Error $sql" .mysqli_connect_error());
    }
    else
    {
    header("location: pakalpojumi.php");
    }
    }

    ?>
    <!--Rediģēšanas saskarsne -->
    <!-- value="php.." attēlo ieraksta jau esošos datus -->
   
    <body>
        <div id="container">
    <form method="post">
    <h1>Rediģēt pacienta datus</h1>
    <label>Pakalpojuma nosaukums:</label><input type="text" name="nosaukums" placeholder="Pakalpojuma nosaukums" value="<?php echo $row['nosaukums']; ?>" required><br/><br/>
    <label>Apraksts:</label><input type="text" name="apraksts" placeholder="apraksts" value="<?php echo $row['apraksts']; ?>" required><br/><br/>
    <label>Cena:</label><input type="number" name="cena" placeholder="0.00" min="1" step="any" value="<?php echo $row['cena']; ?>" required><br/><br/>
     <!-- Paņem ierakstus no datubāzes un attēlo kā dropdown opcijas-->
    
    <button class="btn" type="submit" name="btn-update" id="btn-update" onClick="update()">Izmainīt</button>
    <a href="pakalpojumi.php"><button class="btn-danger" type="button" value="button">Atpakaļ</button></a>


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