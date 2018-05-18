<?php

/*
Construlle el pie de página de la aplicación web. Este fichero está insertado al final de todas las vistas.

*/
genera_pie();


function genera_pie() {
	
		echo "<footer class='site-footer'>";
			echo "<div class='container'>";
				echo "<div class='row'>";
					echo "<div class='col-md-6'>";
						echo "<div class='widget'>";
							echo "<h3 class='widget-title'>Contacto</h3>";
							echo "<a href='mailto:tecnologiassoria@gmail.com'>tecnologiassoria@gmail.com</a> <br>";
						echo "</div>";
					echo "</div>";
					echo "<div class='col-md-6'>";
						echo "<div class='widget'>";
							echo "<h3 class='widget-title'>Nuestras redes</h3>";
							echo "<p>Aún no disponemos de redes</p>";
							echo "<div class='social-links circle'>";
								echo "<a href='#'><i class='fa fa-facebook'></i></a>";
								echo "<a href='#'><i class='fa fa-google-plus'></i></a>";
								echo "<a href='#'><i class='fa fa-twitter'></i></a>";
								echo "<a href='#'><i class='fa fa-pinterest'></i></a>";
							echo "</div>";
						echo "</div>";
					echo "</div>";					
				echo "</div>";
				echo "<div class='copy'>Copyright 2018 Cursos online. Todos los derechos reservados.</div>";
			echo "</div>";
		echo "</footer>";

}


?>