<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poliklīnikas pārvalde</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/medlogo.png" type="image/x-icon">
</head>
<body>

<header>
    <img class="logo" src="images/medlogo.png">
    <nav class="navbar">
        <a href="index.php" class="<?php echo ($page == "sakums" ? "active" : ""); ?>"><i class="fas fa-home"></i> Sākumlapa</a>
        <a href="vizites.php" class="<?php echo ($page == "vizites" ? "active" : ""); ?>"><i class="fa fa-calendar"></i> Vizītes</a>
        <a href="pacienti.php" class="<?php echo ($page == "pacienti" ? "active" : ""); ?>"><i class="fas fa-users"></i> Pacienti</a>
        <a href="#pakalpojumi.php" class="<?php echo ($page == "pakalpojumi" ? "active" : ""); ?>"><i class="fa-solid fa-suitcase-medical"></i> Pakalpojumi</a>
    </nav>
    <nav class="navbar">
        <a href="logout.php"><b>
          <?php
           // session_start();
        // echo $_SESSION["username"];
            ?> 
        </b> <i class="fas fa-power-off"></i></a>
    </nav>
</header>