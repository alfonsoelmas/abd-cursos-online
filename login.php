<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Cursos online</title>
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
		//TODO - NO LOGGEA, no da errores...
		//Generamos cabecera de la página - hace además sesión_start para controlar la sesión.
		$pagina_actual = "Inicio de sesión";
		require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/genera_cabecera.php");
		if(isset($_SESSION["usuario_actual"])) {
			header("Location: index.php");
		} else {
		?>

		<main class="main-content">
			<div class="fullwidth-block">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<h2 class="section-title"><i class="icon-user"></i>Iniciar sesión</h2>

						<?php
							require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/iniciar_sesion.php");
							require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/filtrado_entrada.php");

							if(isset($_POST['email']))
							{
								array_walk($_POST, 'limpiarCadena');

								$username = $_POST['email'];
								$password = $_POST['pass'];
								$ok = login($username, $password);							
							}						?>
							<form id="log" enctype="multipart/form-data" method="post" action="login.php" class="contact-form">
								<p>
									<label for="email">Correo</label>
									<span class="control"><input type="text" id="email" name="email" placeholder="Email"></span>
								</p>
								<p>
									<label for="pass">Contraseña</label>
									<span class="control"><input type="password" id="pass" name="pass" placeholder="contraseña"></span>
								</p>
								<p class="text-right">
									<input type="submit" value="Entrar">
								</p>

							</form>
						</div>
						<div class="col-md-2"></div>
						<?php
						echo "<div class='col-md-4'>";
							echo "<h2 class='section-title'><i class='icon-user'></i>...O registrate</h2>";
							echo "<p class='text-center'>";
								echo "<a href='registro.php' class='more button secondary'>Registrarse</a>";
							echo "</p>";
						echo "</div>";
						?>

					</div> <!-- .row -->
				</div>
			</div> <!-- .fullwidth-block -->
		</main>

		<?php

			//Generamos el pie de página
			require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/genera_pie.php");
		}

		?>

		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/jquery.min.js"></script>	
		<script src="js/plugins.js"></script>
		<script src="js/app.js"></script>
		<script src="js/validador_login.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	</body>

</html>