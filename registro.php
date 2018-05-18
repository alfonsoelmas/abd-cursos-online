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
		
		//Generamos cabecera de la página - hace además sesión_start para controlar la sesión. <!TODO -SI SESION CREADA, NO APARECE NADA DE REGISTRO
		$pagina_actual = "Registro";
		require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/genera_cabecera.php");
		if(isset($_SESSION["usuario_actual"])) {
			header("Location: index.php");
		} else {
			session_destroy();

		?>

		<main class="main-content">
			<div class="fullwidth-block">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<h2 class="section-title"><i class="icon-user"></i>Registro de usuario</h2>
							<!--TODO falta meterle accion . Por defecto el usuario creado se le asigna el rol estudiante. El administrador podrá cambiar el rol desde el panel. -->
							<?php
								require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/registro_usuario.php");

								if(isset($_POST['email'])) {

									registra_usuario();
								}
							?>

							<form id="register" enctype="multipart/form-data" method="post" action="registro.php" class="contact-form">
								<p>
									<label for="email">Correo</label>
									<span class="control"><input type="text" id="email" name="email" placeholder="Email"></span>
								</p>
								<p>
									<label for="emailr">Repite correo</label>
									<span class="control"><input type="text" id="emailr" name="emailr" placeholder="Email"></span>
								</p>
								<p>
									<label for="nombre">Nombre</label>
									<span class="control"><input type="text" id="nombre" name="nombre" placeholder="Nombre"></span>
								</p>
								<p>
									<label for="ape1">Primer apellido</label>
									<span class="control"><input type="text" id="ape1" name="ape1" placeholder="apellido 1"></span>
								</p>
								<p>
									<label for="ape2">Segundo apellido</label>
									<span class="control"><input type="text" id="ape2" name="ape2" placeholder="apellido 2"></span>
								</p>
								 <div class="form-group">
								  <label for="edad">Edad:</label>
								  <span class="control">
								  	<select class="form-control" id="edad" name="edad">
									  	<?php 
									  	for ($i = 1; $i <= 100; $i++) {
	    									echo "<option>".$i."</option>";
										}

									  	?>
								  	</select>
								  </span>
								</div> 
								<p>
									<label for="pass">Contraseña</label>
									<span class="control"><input type="password" id="pass" name="pass" placeholder="contraseña"></span>
								</p>
								<p>
									<label for="passr">Repite contraseña</label>
									<span class="control"><input type="password" id="passr" name="passr" placeholder="contraseña"></span>
								</p>
								<p class="text-right">
									<input type="submit" value="Registrarse">
								</p>

							</form>
						</div>
						<div class="col-md-2"></div>
						<?php
						echo "<div class='col-md-4'>";
							echo "<h2 class='section-title'><i class='icon-user'></i>...o inicia sesión</h2>";
							echo "<p class='text-center'>";
								echo "<a href='login.php' class='more button secondary'>Iniciar sesión</a>";
							echo "</p>";
						echo "</div>";
						?>
					</div> <!-- .row -->
				</div>
			</div> <!-- .fullwidth-block -->
		</main>

		<?php
		}
		//Generamos el pie de página
		require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/genera_pie.php")

		?>

		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/jquery.min.js"></script>
		<script src="js/plugins.js"></script>
		<script src="js/app.js"></script>
		<script src="js/validador_registro.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
		
	</body>

</html>