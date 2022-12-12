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
				//Kad poga tiek nospiesta
					if(isset($_POST['autorizeties'])){
						require("connect_db.php");
						//visām lapām, kurām nepieciešamas sesijas, sesija ir jāuzsāk
						session_start();
						//izmantojot real_escape_string sevi pasargi no SQL injekcijām. neliešu SQL terminus un iekavas (vaicājumus) pārtaisa par tekstu (string) 
						$Lietotajvards = mysqli_real_escape_string($savienojums, $_POST ["lietotajs"]) ;
						$Parole = mysqli_real_escape_string($savienojums, $_POST ["parole"]) ;
						
						//pārbauda, vai šāds lietotājs datubāzē pastāv
						$sqlVaicajums = "SELECT * FROM lietotaji WHERE lietotajvards = '$Lietotajvards' ";
						$rezultats = mysqli_query($savienojums, $sqlVaicajums);

						//pārbauda, vai lietotājam būs administratora piekļuve (attēlos datus, ko parastie lietotāji nevar aiztikt)
						$admin_SQL = "SELECT adminpiekluve FROM lietotaji WHERE lietotajvards = '$Lietotajvards'";
						$adminpiekluve = mysqli_query($savienojums, $admin_SQL);
						if(mysqli_num_rows($adminpiekluve) == 1){
							while($row = mysqli_fetch_array($adminpiekluve)){
								$_SESSION["isadmin"] = $row["adminpiekluve"];
							}
						}
						//use phppasswordhash.com if unable to hash own password

                        
						if(mysqli_num_rows($rezultats) == 1){
							while($row = mysqli_fetch_array($rezultats)){
								//vai ievadītā parole saskan ar datubāzes paroli? (strādā tikai hašots)
								if(password_verify($Parole, $row["parole"])){
									$_SESSION["username"] = $Lietotajvards;
									//pārvieto lietotāju uz sākumlapu
									header("location:index.php");
								}else{
									echo "Nepareizs lietotajvards vai parole!";
								}
							}
						} else {
							echo "Nepareizs lietotajvards vai parole!";
						}
					}
					//ja padots signāls no izlogošanās pogas, tad sesija tiek iznīcināta
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