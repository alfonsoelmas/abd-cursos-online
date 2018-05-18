<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Crear curso</title>
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
		$pagina_actual = "Crear curso";
		require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/genera_cabecera.php");

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
		} else if( $_SESSION["rol"]!="ADMINISTRADOR"){
			header("Location: index.php");
		} else {

		?>

		<main class="main-content">
			<div class="fullwidth-block">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<h2 class="section-title"><i class="icon-user"></i>Crear curso</h2>


							<form id="crear_asignatura" enctype="multipart/form-data" method="post" action="/abd/back/funciones/add_curso.php" class="contact-form">
								<p>
									<label for="nombre">Nombre</label>
									<span class="control"><input type="text" name="nombre" placeholder="Nombre"></span>
								</p>
								<p>
									<label for="emailr">Descripcion</label>
									<span class="control"><textarea name="descripcion" rows="10" cols="40"></textarea></span>
								</p>
								
								<p class="text-right">
									<input type="submit" value="Crear">
								</p>

							</form>
						</div>
						<div class="col-md-2"></div>
						<?php
						echo "<div class='col-md-4'>";
							echo "<h2 class='section-title'><i class='icon-user'></i>Volver a listado de cursos</h2>";
							echo "<p class='text-center'>";
								echo "<a href='cursos.php' class='more button secondary'>Volver</a>";
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
		
	</body>

</html>