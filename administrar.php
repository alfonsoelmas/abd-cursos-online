<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Administrar</title>
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
		/*
		administrar.

		muestra un listado de:

		administrar cursos,
		administrar estudiantes,
		administrar asignaturas
		*/
		
		//Generamos cabecera de la página - hace además sesión_start para controlar la sesión.
		$pagina_actual = "Opciones de administracion";
		require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/genera_cabecera.php");

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
		} else if( $_SESSION["rol"]!="ADMINISTRADOR"){
			header("Location: index.php");
		} else {
			echo "<h1 class='text-center'>Opciones de administracion</h1>";
			

			$numeroBotones=3;
			$lista = array("Administrar usuarios","Administrar asignaturas", "Administrar cursos");
			$links = array("listado_usuarios.php","listado_asignaturas.php", "cursos.php");

				echo "<div class='row'>";
					echo "<div class='col-md-5 col-md-offset-1'>";
						echo "<aside class='sidebar'>";
							echo "<h2 class='section-title'><i class='icon-book'></i>Listado de opciones</h2>";
							echo "<ul class='courses'>";
								for($i=0; $i<$numeroBotones; $i++){
									echo "<li class='current'>";
										echo "<h3 class='course-title'><a href='".$links[$i]."'>".$lista[$i]."</a></h3>";
									echo "</li>";
								}
								
							echo "</ul>";
						echo "</aside>";
					echo "</div>";
				echo "</div>";

		}

		//Generamos el pie de página
		require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/genera_pie.php")

		?>

		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/plugins.js"></script>
		<script src="js/app.js"></script>
		
	</body>

</html>