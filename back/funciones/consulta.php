<?php
	require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/config/connection.php");
	
	//Función que realiza una consulta en la base de datos
	function consulta($sql)
	{
		//conectamos con la base de datos
		$conn = conectar();
		//Realizamos la consulta y almacenamos su valor
		$resultado = realiza_consulta($conn, $sql);
		//Cerramos la conexión
		cerrar_conexion($conn);

		return $resultado;
	}
?>