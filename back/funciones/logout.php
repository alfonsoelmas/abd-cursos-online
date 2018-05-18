<?php
	session_start();
	/*
		Fichero encargado del cierre de sesión.
		Cierra la sesión actual si existe una abierta, y te redirige a la pagina principal.
	*/
	if(isset($_SESSION['usuario_actual'])) {
		session_destroy();
		header("Location: ../../index.php");
	}
?>