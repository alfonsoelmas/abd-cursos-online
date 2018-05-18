
<?php

/*
listado_cursos

muestra un listado de usuarios, a la derecha un boton de cambiarRol, borrar, editar
arriba tendra un buscador por correo electronico
*/
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Administrar cursos</title>
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
		
		//Generamos cabecera de la página - hace además sesión_start para controlar la sesión. TODO- CURSOS, ADD ASIGNATURAS, CREAR CURSO, ELIMINAR CURSO
		$pagina_actual = "Administracion de cursos";
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

			echo "<h1 class='text-center'>Cursos</h1>";
			
			$numeroCursos=0;

				echo "<div class='row'>";
					?>
					<div class='col-md-1'></div>
					<div class='col-md-3'>
						<div class="widget">
							<h3 class="widget-title">Buscador</h3>
							<p>Busqueda de cursos</p>
							<form action="cursos.php" type="get" class="subscribe">
								<input type="text" name="busqueda" placeholder="Nombre...">
								<input type="submit" class="light" value="Buscar">
							</form>
						</div>
						<p class='text-center'>
							<a href='/abd/crear_cursos.php' class='more button secondary'>Crear</a>
						</p>
					</div>
					<div class='col-md-2'></div>
					<?php
			if(isset($_GET['busqueda'])){
					$texto_buscar = $_GET['busqueda']; 
					require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/acciones_admin.php");

					//TODO CAMBIAR
					$resultados_busqueda = busquedaCursos($texto_buscar);
					$numeroResultados = mysqli_num_rows($resultados_busqueda);
					$resultados = $resultados_busqueda->fetch_row(); 
					

					//Mostramos las asignaturas buscadas (y las opciones para el administrador. Eliminar)
					$numeroCursos=$numeroResultados;
					echo "<div class='col-md-5'>";
						echo "<aside class='sidebar'>";
							echo "<h2 class='section-title'><i class='icon-book'></i>Listado de cursos</h2>";
							echo "<ul class='courses'>";
								for($i=0; $i<$numeroCursos; $i++){
									$id_curso = $resultados[0];
									$nombre_curso = $resultados[1];
									$descrip_curso = $resultados[2];
									echo "<li class='current'>";
										echo "<h3 class='course-title'><a href='#''>".$nombre_curso."</a></h3>";
										echo "<div class='course-meta'>";
											echo "<span class='date'><i class='icon-calendar'></i>".$descrip_curso."</span>";
										echo "</div>";
										echo "<div class='course-meta'>";
											echo "<p class='text-center'><a href='/abd/back/funciones/borrar_curso.php?id=".$id_curso."' class='more button secondary'>eliminar</a></p>";
											echo "<p class='text-center'><a href='/abd/add_asignatura_curso.php?id=".$id_curso."' class='more button secondary'>añadir asignaturas</a></p>";
											echo "<p class='text-center'><a href='/abd/add_usuario_curso.php?id=".$id_curso."' class='more button secondary'>añadir usuarios</a></p>";
										echo "</div>";
									echo "</li>";
									$resultados = $resultados_busqueda->fetch_row();
								}
								
							echo "</ul>";
						echo "</aside>";
					echo "</div>";
					echo "<div class='col-md-1'></div>";
			}
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

