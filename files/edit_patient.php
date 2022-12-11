
<?php
$page = "pacienti"; #Obligāti jādara pirms izsaucot header
require "editor_header.php";

if(isset($_SESSION['username'])){

    //Datubāzes savienojums
    require '../connect_db.php';
    //Saņem ID no datubāzes
    if(isset($_GET['edit_id'])){
    $sql = "SELECT * FROM pacienti WHERE pacients_id =" .$_GET['edit_id'];
    $result = mysqli_query($savienojums, $sql);
    $row = mysqli_fetch_array($result);
    }
    //Update Information
    if(isset($_POST['btn-update'])){
    $vards = $_POST['vards'];
    $uzvards = $_POST['uzvards'];
    $gimenes_arsts = $_POST['gimenes_arsts'];
    $personas_kods = $_POST['personas_kods'];
    $dzim_datums= $_POST['dzim_datums'];
    $talrunis = $_POST['talrunis'];
    $epasts = $_POST['epasts'];
    $nacionalitate = $_POST['nacionalitate'];
    $id_adrese = $_POST['id_adrese'];

    $update = "UPDATE pacienti SET vards='$vards', uzvards='$uzvards', gimenes_arsts='$gimenes_arsts',
                                personas_kods=' $personas_kods',dzim_datums=' $dzim_datums',talrunis='$talrunis',epasts='$epasts',
                                nacionalitate='$nacionalitate', id_adrese='$id_adrese' WHERE pacients_id=". $_GET['edit_id'];
    $up = mysqli_query($savienojums, $update);
    if(!isset($sql)){
    die ("Error $sql" .mysqli_connect_error());
    }
    else
    {
    header("location: ../pacienti.php");
    }
    }
    ?>
    <!--Create Edit form -->

   
    <body>
        <div id="container">
    <form method="post">
    <h1>Rediģēt pacienta datus</h1>
    <label>Pacienta vārds:</label><input type="text" name="vards" placeholder="Pacienta vārds" value="<?php echo $row['vards']; ?>" required><br/><br/>
    <label>Pacienta uzvārds:</label><input type="text" name="uzvards" placeholder="Uzvārds" value="<?php echo $row['uzvards']; ?>" required><br/><br/>
    <label>Ģimenes ārsta ID:</label><input type="text" name="gimenes_arsts" placeholder="Ģimenes ārsts" value="<?php echo $row['gimenes_arsts']; ?>" required><br/><br/>
    <label>Personas kods:</label><input type="text" name="personas_kods" placeholder="Personas kods" value="<?php echo $row['personas_kods']; ?>" required><br/><br/>
    <label>Dzimšanas datums:</label><input type="text" name="dzim_datums" placeholder="0000-00-00" value="<?php echo $row['dzim_datums']; ?>" required><br/><br/>
    <label>Tālrunis:</label><input type="text" maxlength="12" name="talrunis" placeholder="00000000" value="<?php echo $row['talrunis']; ?>" required><br/><br/>
    <label>E-pasts:</label><input type="email" name="epasts" placeholder="email@email.com" value="<?php echo $row['epasts']; ?>" required><br/><br/>
    <label>Nacionalitāte:</label><input type="text" name="nacionalitate" placeholder="Latvietis" value="<?php echo $row['nacionalitate']; ?>" required><br/><br/>
    <label>Adreses ID:</label><input type="text" name="id_adrese" placeholder="0" value="<?php echo $row['id_adrese']; ?>" required><br/><br/>
    <button class="btn" type="submit" name="btn-update" id="btn-update" onClick="update()">Izmainīt</button>
    <a href="../pacienti.php"><button class="btn-danger" type="button" value="button">Atpakaļ</button></a>


    </form>
        <div class="image">
        <img src="../images/pacienti.png">
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