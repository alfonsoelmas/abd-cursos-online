<?php

	require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/consulta.php");

	/*	
		Contiene funciones relacionadas con el inicio de sesión.
			-login(user,pass) -> inicia sesión con usuario password, y actúa según sea correcta o no la identificación.


	*/


	function login($username, $password){
		// Comprobamos si el usuario existe
		$con = comprueba_usuario($username);

		$nFilas = n_filas($con);
		
		if($nFilas == 1){

			// Comprobamos si la contraseña coincide
			// Ver el ejemplo de password_hash() para ver de dónde viene este hash.

			$pass = dame_pass($username);
			$hash = $pass->fetch_object();


			if (password_verify($password, $hash->pass)) {
			    echo '¡La contraseña es válida!';
				session_start();
				
				$filaUsuario = $con->fetch_object();

				$_SESSION['usuario_actual'] = $filaUsuario->id;
				$_SESSION['name'] = $filaUsuario->nombre;
				$_SESSION['rol'] = dame_rol($filaUsuario->id);
				header("Location: index.php");
				return '1';
			} 
			else {
			    echo '<br><span>La contraseña no es válida.</span>';
			    return '0';
			}
		}
		else{
			echo "<span>El usuario no existe o no coincide con la contraseña</span>";
			return '0';
		}
	}	

	function comprueba_usuario($email){
		//TODO, ARREGLAR CONSULTA
		$sql = "SELECT * FROM usuarios WHERE email='$email'";

		$resultado = consulta($sql);

		return $resultado;
	}

	function dame_pass($email){
		//TODO, ARREGLAR CONSULTA
		$sql = "SELECT U.pass FROM usuarios AS U WHERE email='$email'";

		$resultado = consulta($sql);

		return $resultado;
	}

	function dame_rol($id){
		//TODO, ARREGLAR CONSULTA
		$sql = "SELECT rol FROM roles WHERE id_user='$id'";

		$resultado = consulta($sql);
		$cons = $resultado->fetch_row();
		$rol = $cons[0];

		return $rol;
	}

	function n_filas($consulta){

		$n = mysqli_num_rows($consulta);

		return $n;

	}

?>