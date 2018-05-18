
<?php

/*
Pagina donde el administrador asigna asignaturas a los cursos
*/
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Administrar asignaturas</title>
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
		$pagina_actual = "Asignar asignaturas";
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
		} else if( $_SESSION["rol"]!="ADMINISTRADOR" || !isset($_GET["id"])){
			header("Location: index.php");
		} else {

			$idCurso = $_GET["id"];

			echo "<h1 class='text-center'>Añadir asignaturas a curso</h1>";
			
			$numeroCursos=0;

				echo "<div class='row'>";
					?>
					<div class='col-md-1'></div>
					<div class='col-md-3'>
						<div class="widget">
							<h3 class="widget-title">Buscador</h3>
							<p>Busqueda de asignaturas</p>
							<form action="add_asignatura_curso.php" type="get" class="subscribe">
								<input type="text" name="busqueda" placeholder="Nombre...">
								<?php echo "<input type='hidden' name='id' value='".$idCurso."' />"; ?>
								<input type="submit" class="light" value="Buscar">
							</form>
						</div>
					</div>
					<div class='col-md-2'></div>
					<?php
			if(isset($_GET['busqueda'])){
					$texto_buscar = $_GET['busqueda']; 
					require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/acciones_admin.php");

					//TODO CAMBIAR
					$resultados_busqueda = busquedaAsignaturas($texto_buscar);
					$numeroResultados = mysqli_num_rows($resultados_busqueda);
					$resultados = $resultados_busqueda->fetch_row(); 
					

					//Mostramos las asignaturas buscadas (y las opciones para el administrador. Eliminar)
					$numeroCursos=$numeroResultados;
					echo "<div class='col-md-5'>";
						echo "<aside class='sidebar'>";
							echo "<h2 class='section-title'><i class='icon-book'></i>Selecciona asignaturas</h2>";
							echo "<p>(Ctrl + click) Para seleccionar varias.</p>";
							echo "<form  class='subscribe' type='get' action='/abd/back/funciones/add_asignaturas_to_curso.php'>";

								echo "<select name='asignaturas[]' multiple>";
									for($i=0; $i<$numeroCursos; $i++){
										$id_as = $resultados[0];
										$nombre_as = $resultados[1];
									  	echo "<option value='".$id_as."'>".$nombre_as."</option>";
  										$resultados = $resultados_busqueda->fetch_row();
									}
								echo "</select>";

								echo "<input type='hidden' name='id' value='".$idCurso."' />";
								if($numeroCursos != 0) 	echo "<input type='submit' class='light' value='Añadir asignaturas seleccionadas'>";

							echo "</form>";
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

