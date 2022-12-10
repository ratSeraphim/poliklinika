<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ielogošanās sistēmā</title>
    <link rel="stylesheet" href="files/style_login.css">
</head>
<body>
	<div class="container" id="container">
		<div class="form-container sign-in-container">
			<form action="#" method="post">
				<img class="logo" src="images/medlogo.png">
				<h1>Ielogoties sistēmā</h1>
				<?php 
				//if button is pressed
					if(isset($_POST['autorizeties'])){
						require("connect_db.php");
						//all pages that require sessions NEED to start sessions first
						session_start();
						//using real_escape_string will prevent SQL injections - it won't let hackers use SQL terms and brackets by turning their SQL query into a harmless string
						$Lietotajvards = mysqli_real_escape_string($savienojums, $_POST ["lietotajs"]) ;
						$Parole = mysqli_real_escape_string($savienojums, $_POST ["parole"]) ;
						$sqlVaicajums = "SELECT * FROM lietotaji WHERE lietotajvards = '$Lietotajvards' ";
						$rezultats = mysqli_query($savienojums, $sqlVaicajums);

						//use phppasswordhash.com if unable to hash own password
                        

                        //raivisozols parole= Parole1
                        
						if(mysqli_num_rows($rezultats) == 1){
							while($row = mysqli_fetch_array($rezultats)){
								//does the password in the database match the entered password (works hashed)
								if(password_verify($Parole, $row["parole"])){
									$_SESSION["username"] = $Lietotajvards;
									header("location:index.php");
								}else{
									echo "Nepareizs lietotajvards!";
								}
							}
						} else {
							echo "Nepareizs lietotajvards vai parole!";
						}
					}

					if(isset($GET['logout'])){
						session_destroy();
					}
				?>
				<input type="text" name="lietotajs" placeholder="Lietotājvārds" />
				<input type="password" name="parole" placeholder="Parole" />
				<input class="ghost" type="submit" name="autorizeties" value="ielogoties">
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-right">

					<h1>Poliklīnikas administrēšanas panelis paredzēts tikai poliklīnikas darbiniekiem!</h1>

				</div>
			</div>
		</div>
	</div>
</body>
</html>