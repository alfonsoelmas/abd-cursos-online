

<?php

/*
	Muestra el contenido asociado a una asignatura
*/
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Asignatura</title>
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
		$pagina_actual = "Asignatura";
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

		} else if( ($_SESSION["rol"]!="ESTUDIANTE" && $_SESSION["rol"]!="PROFESOR") || !isset($_GET["id"]) || !isset($_GET["nombre"])){
			header("Location: index.php");

		} else {
			//TODO. No controlamos que las asignaturas / el curso, esté inscrito por el usuario. Si modifican el get otro usuario con esos roles, pueden acceder.
			$idCurso = $_GET["id"]; //ID de la asignatura
			$nombreAs = $_GET["nombre"]; //No controlo si no esta seleccionado en el get -TODO
			echo "<h1 class='text-center'>Contenido de asignatura ".$nombreAs."</h1>";
			
			$numeroCursos=0;

				echo "<div class='row'>";
					?>
					<div class='col-md-2'></div>
					<?php
		
					require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/acciones_admin.php");


					$resultados_busqueda = busquedaContenidoPorAsignatura($idCurso);
					$numeroResultados = mysqli_num_rows($resultados_busqueda);
					$resultados = $resultados_busqueda->fetch_row(); 
					
					//Mostramos los contenidos asociados a la asignatura...
					$numeroCursos=$numeroResultados;
					echo "<div class='col-md-6'>";
						echo "<aside class='sidebar'>";
							echo "<h2 class='section-title'><i class='icon-book'></i>Listado del contenido de ".$nombreAs."</h2>";
							if($_SESSION["rol"] == "PROFESOR"){
								echo "<p class='text-center'>";
									echo "<a href='/abd/add_content.php?id=".$idCurso."&nombre=".$nombreAs."' class='more button secondary'>Crear</a>";
								echo "</p>";
							}
								for($i=0; $i<$numeroCursos; $i++){
									
									$id_con = $resultados[0];
									$ruta_con = $resultados[1];
									$nombre_con = $resultados[2];

								
									echo "<div class='accordion'>";
										echo "<div class='accordion-toggle'>";
											echo "<h3>".$nombre_con."</h3>";
										echo "</div>";
										echo "<div class='accordion-content'>";
											echo "<p><a href='".$ruta_con."''>Click para abrir y descargar</a></p>"; //TODO MOSTRAR HREF ETC ETC ETC
										echo "</div>";
									echo "</div>";

									$resultados = $resultados_busqueda->fetch_row();
								}
								
						echo "</aside>";
					echo "</div>";
					echo "<div class='col-md-2'></div>";
			
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

