<?php


/*
GENERA una plantilla que muestra un mensaje. Esta plantilla funciona correctamente sobre ficheros dentro del subdirectorio funciones puesto que usamos links y referencias relativas.
La plantilla es usada para mostrar los mensajes de exito y error después de cada consulta (Acciones como borrar o crear elementos).
*/

function generaPlantilla($mensajeTitulo,$mensajeParrafo){
	if(!isset($_SESSION["usuario_actual"]))session_start();
	echo "<!DOCTYPE html>";
	echo "<html lang='en'>";
	echo "<head>";
		echo "<meta charset='UTF-8'>";
		echo "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
		echo "<meta name='viewport' content='width=device-width, initial-scale=1.0,maximum-scale=1'>";
		
		echo "<title>Cursos online</title>";
		echo "<!-- Loading third party fonts -->";
		echo "<link href='http://fonts.googleapis.com/css?family=Arvo:400,700|' rel='stylesheet' type='text/css'>";
		echo "<link href='fonts/font-awesome.min.css' rel='stylesheet' type='text/css'>";
		echo "<!-- Loading main css file -->";
		echo "<link rel='stylesheet' href='../../style.css'>";
		
		echo "<!--[if lt IE 9]>";
		echo "<script src='../../js/ie-support/html5.js'></script>";
		echo "<script src='../../js/ie-support/respond.js'></script>";
		echo "<![endif]-->";

	echo "</head>";

	echo "<body>";
		
		//Generamos cabecera de la página - hace además sesión_start para controlar la sesión.
		$pagina_actual = $mensajeTitulo;


		echo "<div id='site-content'>";
			echo "<header class='site-header'>";
				echo "<div class='primary-header'>";
					echo "<div class='container'>";
						echo "<a href='../../index.php' id='branding'>";
							echo "<img src='../../images/logo.png'>";
							echo "<h1 class='site-title'>Cursos online</h1>";
							echo "</a> <!-- #branding -->";
						
						echo "<div class='main-navigation'>";
							echo "<button type='button' class='menu-toggle'><i class='fa fa-bars'></i></button>";
							echo "<ul class='menu'>";
								echo "<li class='menu-item'><a href='../../index.php'>Inicio</a></li>";




								if(isset($_SESSION["usuario_actual"]) && ($_SESSION["rol"] == "PROFESOR" || $_SESSION["rol"] == "ESTUDIANTE"))
									echo "<li class='menu-item'><a href='../../mis_cursos.php'>Mis cursos</a></li>";


								if(isset($_SESSION["usuario_actual"]) && $_SESSION["rol"] == "ADMINISTRADOR") {
									echo "<li class='menu-item'><a href='../../administrar.php'>Administrar</a></li>";
								}



								if(isset($_SESSION["usuario_actual"])) {
									echo "<li  class='menu-item'>¡Hola, ".$_SESSION["name"]."! ";
									echo "<a href='logout.php'>Desconectar</a></li>";
								}

							echo "</ul> <!-- .menu -->";
						echo "</div> <!-- .main-navigation -->";

						echo "<div class='mobile-navigation'></div>";
					echo "</div> <!-- .container -->";
				echo "</div> <!-- .primary-header -->";

				echo "<div class='page-title'>";
					echo "<div class='container'>";
						echo "<h2>".$pagina_actual."</h2>";
					echo "</div>";
				echo "</div>";
			echo "</header>";
		echo "</div>";

		echo "<h1>".$mensajeTitulo."</h1>";
		echo "<p>".$mensajeParrafo."</p>";

		//Generamos el pie de página
		require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/genera_pie.php");
		echo "<script src='../../js/jquery-1.11.1.min.js'></script>";
		echo "<script src='../../js/plugins.js'></script>";
		echo "<script src='../../js/app.js'></script>";


		
	echo "</body>";

	echo "</html>";




}


?>