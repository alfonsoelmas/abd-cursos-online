<?php
session_start();
genera_cabecera($pagina_actual);

/*
	GENERA la cabecera de la aplicación web, este fichero está insertado al comienzo de todas las vistas.
*/


function genera_cabecera($pagina_actual) {


		echo "<div id='site-content'>";
			echo "<header class='site-header'>";
				echo "<div class='primary-header'>";
					echo "<div class='container'>";
						echo "<a href='index.php' id='branding'>";
							echo "<img src='images/logo.png'>";
							echo "<h1 class='site-title'>Cursos online</h1>";
							echo "</a> <!-- #branding -->";
						
						echo "<div class='main-navigation'>";
							echo "<button type='button' class='menu-toggle'><i class='fa fa-bars'></i></button>";
							echo "<ul class='menu'>";
								echo "<li class='menu-item'><a href='index.php'>Inicio</a></li>";



								if(isset($_SESSION["usuario_actual"]) && ($_SESSION["rol"] == "PROFESOR" || $_SESSION["rol"] == "ESTUDIANTE"))
									echo "<li class='menu-item'><a href='mis_cursos.php'>Mis cursos</a></li>";



								if(isset($_SESSION["usuario_actual"]) && $_SESSION["rol"] == "ADMINISTRADOR") {
									echo "<li class='menu-item'><a href='administrar.php'>Administrar</a></li>";
								}



								if(isset($_SESSION["usuario_actual"])) {
									echo "<li  class='menu-item'>¡Hola, ".$_SESSION["name"]."! ";
									echo "<a href='back/funciones/logout.php'>Desconectar</a></li>";
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


}



?>