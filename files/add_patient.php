<?php
$page = "pacienti"; #Obligāti jādara pirms izsaucot header
require "editor_header.php";

if(isset($_SESSION['username'])){ ?>

<body>
    <div id="container">
        <form action="insert_pat.php" method="post">
            <h1>Ievietot pacienta datus</h1>
            <label>Pacienta vārds:</label><input type="text" name="vards" placeholder="Vārds"  required><br/><br/>
            <label>Pacienta uzvārds:</label><input type="text" name="uzvards" placeholder="Uzvārds" required><br/><br/>
            <label>Ģimenes ārsta ID:</label><input type="text" name="gimenes_arsts" placeholder="Ģimenes ārsts" required><br/><br/>
            <label>Personas kods:</label><input type="text" name="personas_kods" placeholder="Personas kods" required><br/><br/>
            <label>Dzimšanas datums:</label><input type="text" name="dzim_datums" placeholder="yyyy-mm-dd" required><br/><br/>
            <label>Tālrunis:</label><input type="text" maxlength="12" name="talrunis" required><br/><br/>
            <label>E-pasts:</label><input type="email" name="epasts" placeholder="email@email.com" required><br/><br/>
            <label>Nacionalitāte:</label><input type="text" name="nacionalitate" placeholder="Latvietis" required><br/><br/>
            <label>Adreses ID:</label><input type="text" name="id_adrese" placeholder="0" required><br/><br/>
            <button class="btn" type="submit" name="submit" id="submit" onClick="update()">Izmainīt</button>
            <a href="../pacienti.php"><button class="btn-danger" type="button" value="button">Atpakaļ</button></a>


        </form>
        <div class="image">
            <img src="../images/pacienti.png">
        </div>  
    </div>
<?php

    } else {
        echo "<div class='pazinojums sarkans'>TEV ŠEIT NAV PIEEJAS!</div>";
        header("Refresh: 0;url=login.php");
    }
include "../footer.php"; ?>