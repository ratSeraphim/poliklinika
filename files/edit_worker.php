<?php
$page = "darbinieki"; #Obligāti jādara pirms izsaucot header
require "editor_header.php";

if(isset($_SESSION['username'])){

    //Datubāzes savienojums
    require '../connect_db.php';
    //Saņem ID no datubāzes
    if(isset($_GET['edit_id'])){
    $sql = "SELECT * FROM darbinieki WHERE darbinieks_id =" .$_GET['edit_id'];
    $result = mysqli_query($savienojums, $sql);
    $row = mysqli_fetch_array($result);
    }
    //Update Information
    if(isset($_POST['btn-update'])){
    $vards = $_POST['vards'];
    $uzvards = $_POST['uzvards'];
    $tips = $_POST['tips'];
    $personas_kods = $_POST['personas_kods'];
    $talrunis = $_POST['talrunis'];

    $update = "UPDATE darbinieki SET vards='$vards', uzvards='$uzvards', tips='$tips',
                                personas_kods=' $personas_kods',talrunis='$talrunis' WHERE darbinieks_id=". $_GET['edit_id'];
    $up = mysqli_query($savienojums, $update);
    if(!isset($sql)){
    die ("Error $sql" .mysqli_connect_error());
    }
    else
    {
    header("location: ../darbinieki.php");
    }
    }
    ?>
    <!--Create Edit form -->

   
    <body>
        <div id="container">
    <form method="post">
    <h1>Rediģēt darbinieka datus</h1>
    <label>Darbinieka vārds:</label><input type="text" name="vards" placeholder="Pacienta vārds" value="<?php echo $row['vards']; ?>" required><br/><br/>
    <label>Darbinieka uzvārds:</label><input type="text" name="uzvards" placeholder="Uzvārds" value="<?php echo $row['uzvards']; ?>" required><br/><br/>
    <label>Darbinieka loma:</label>
    <select name="tips">
            <option value="Speciālists">Speciālists</option>
            <option value="Administrators">Administrators</option>
            <option value="Apkopējs">Apkopējs</option>
            <option value="Māsa">Māsa</option>
    </select><br/><br/>
    <label>Personas kods:</label><input type="text" name="personas_kods" placeholder="Personas kods" value="<?php echo $row['personas_kods']; ?>" required><br/><br/>
    <label>Tālrunis:</label><input type="text" maxlength="12" name="talrunis" placeholder="00000000" value="<?php echo $row['talrunis']; ?>" required><br/><br/>
    <button class="btn" type="submit" name="btn-update" id="btn-update" onClick="update()">Izmainīt</button>
    <a href="../darbinieki.php"><button class="btn-danger" type="button" value="button">Atpakaļ</button></a>


    </form>
        <div class="image">
        <img src="../images/editor.png">
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