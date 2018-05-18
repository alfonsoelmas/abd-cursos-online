<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Cambiar rol</title>
		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Arvo:400,700|" rel="stylesheet" type="text/css">
		<link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Loading main css file -->
		<link rel="stylesheet" href="style.css">
		
		<!--[if lt IE 9]>
		<script src="js/ie-support/html5.js"></script>
		<script src="js/ie-support/respond.js"></script>
		<![endif]-->

	</head>


	<body>
		<?php
		
		//Generamos cabecera de la página - hace además sesión_start para controlar la sesión.
		$pagina_actual = "Cambio de rol";
		require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/genera_cabecera.php");
		require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/config/roles_usuarios.php");
		?>

		<?php

		if(!isset($_SESSION["usuario_actual"])) {

		echo "<main class='main-content'>";
			echo "<div class='fullwidth-block'>";
				echo "<div class='container'>";
					echo "<div class='row'>";
						echo "<div class='col-md-6'>";
							echo "<h2 class='section-title'><i class='icon-user'></i>Inicia sesión...</h2>";
							
							echo "<p class='text-center'>";
								echo "<a href='login.php' class='more button secondary'>Iniciar sesión</a>";
							echo "</p>";
						echo "</div>";
						echo "<div class='col-md-6'>";
							echo "<h2 class='section-title'><i class='icon-user'></i>...O registrate</h2>";
							echo "<p class='text-center'>";
								echo "<a href='registro.php' class='more button secondary'>Registrarse</a>";
							echo "</p>";
						echo "</div>";

					echo "</div> <!-- .row -->";
				echo "</div>";
			echo "</div> <!-- .fullwidth-block -->";
		echo "</main>";

		} else {
			//Si la sesión es "ADMINISTRADOR" y nos llega parametro de usuario
			if($_SESSION["rol"] == "ADMINISTRADOR" && isset($_GET["idUser"]) && isset($_GET["correoUser"])){
					//No me importa controlar el get de esta página, ya que es accesible por el ADMINISTRADOR y confiamos en que no intente tirar las consultas.
					//TODO - Controlar lo que llega en el GET para realizar consultas correctas - NO ENVIA FORMULARIO BIEN
				
				echo "<main class='main-content'>";
					echo "<div class='fullwidth-block'>";
						echo "<div class='container'>";
							echo "<div class='row'>";
								echo "<div class='col-md-3'></div>";
								echo "<div class='col-md-6'>";
									echo "<form name='cambioRol' enctype='multipart/form-data' method='post' action='/abd/back/funciones/cambio_rol.php' class='contact-form'>";
										echo "<p>";
											echo "<label for='email'>Correo: </label>";
											echo "<span class='control'>".$_GET['correoUser']."</span>";
										echo "</p>";
										echo "<input type='hidden' name='idUser' value='".$_GET['idUser']."' />";
										echo "<p>";
										echo "</p>";
										echo "<input type='hidden' name='correoUser' value='".$_GET['correoUser']."' />";
										echo "<p>";
											echo "<div class='form-group'>";
										    echo "<label for='rol'>Rol: </label>";
										    echo "<span class='control'><select name='rol'>";

										    //Cargamos los roles
										    for($i = 0; $i < $numRoles; $i++){
										      echo "<option>".$roles[$i]."</option>";
										    }


										    echo "</select></span>";
										  echo "</div>";
										echo "</p>";
										echo "<p class='text-right'>";
											echo "<input type='submit' name='boton' value='Cambiar rol'/>";
										echo "</p>";
									echo "</form>";
								echo "</div>";
								echo "<div class='col-md-3'></div>";
							echo "</div> <!-- .row -->";
						echo "</div>";
					echo "</div> <!-- .fullwidth-block -->";
				echo "</main>";

			} else {

				header("Location: index.php");

			}


		}

		//Generamos el pie de página
		require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/genera_pie.php")

		?>

		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/plugins.js"></script>
		<script src="js/app.js"></script>
		
	</body>

</html>