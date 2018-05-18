<?php
	function conectar()
	{
		//Acceso a BD



		$servername = "localhost";
		$username = "root";
		$password = "";
		$nombreBD = "abd"; //TODO


		//Hay que usar los métodos OO
		$conn = new mysqli($servername, $username, $password, $nombreBD);
		//$conn = mysqli_connect($servername, $username, $password ,$nombreBD);

		if (!$conn) {
			die("Conexión con la BBDD fallida. " . mysqli_connect_error());
		} 

		return $conn;	
	}

	function realiza_consulta($conn, $query)
	{
		$resultado = $conn->query($query);

		return $resultado;
	}

	function cerrar_conexion($conn){
		$conn->close();
	}
?>