<?php
	require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/consulta.php");
	require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/filtrado_entrada.php");
	
	// Registro de un usuario en la BD.
	function registra_usuario() {

		// COMPROBACIONES DE SEGURIDAD
		array_walk($_REQUEST, 'limpiarCadena');	

		$nombre    = htmlspecialchars(trim(strip_tags($_REQUEST["nombre"])));
		$apellido1 = htmlspecialchars(trim(strip_tags($_REQUEST["ape1"])));
		$apellido2 = htmlspecialchars(trim(strip_tags($_REQUEST["ape2"])));

		$edad     = htmlspecialchars(trim(strip_tags($_REQUEST["edad"])));
		$email    = htmlspecialchars(trim(strip_tags($_REQUEST["email"])));


		$password = htmlspecialchars(trim(strip_tags($_REQUEST["pass"])));
		// HASH
		$password_hased = password_hash($password, PASSWORD_DEFAULT);


		if(empty($nombre) || empty($edad) || empty($email) || empty($password) || empty($apellido1) || empty($apellido2) || !preg_match('/^[^@\s]+@([a-z0-9]+\.)+[a-z]{2,}$/i', $email) 	|| !is_numeric($edad) ||
	   	   		 strlen($password) < 6 ){

			echo "<p> Se ha producido un error al enviar los datos del formulario. ¡Inténtalo de nuevo!</p>";

		} else {

			// Comprobar si el email ya está registrado en la BD.
			$resultado = existe_email($email);
			if($resultado->num_rows != 0)
				echo "<p>El email introducido ya está registrado. Prueba con otro.</p>";
			else {
				// Registrar el nuevo usuario en la BD.
				annadir_usuario($nombre, $apellido1, $apellido2, $email, $password_hased, $edad);
				// Iniciamos sesion
				session_start();
				// Buscamos el usuario otra vez para obtener el id generado automaticamente
				$con = existe_email($email);

				$nFilas = n_filas($con);

				if($nFilas == 1){
					
					$filaUsuario = $con->fetch_object();
					$_SESSION['usuario_actual'] = $filaUsuario->id;
					$_SESSION['name'] = $filaUsuario->nombre;
					$_SESSION['rol'] =  "ESTUDIANTE"; //Por defecto al registrarse el rol es estudiante. El administrador podrá cambiar el rol. No hace falta realizar consulta.
					
					header('Location: index.php');
				}
			}
		}
	}

	function existe_email($email){

		$sql = "SELECT * FROM usuarios WHERE email='$email'";

		$resultado = consulta($sql);

		return $resultado;
	}

	function annadir_usuario($nombre, $apellido1, $apellido2, $email, $pass, $edad){
		//TODO - ARREGLAR CONSULTA
		$sql = "INSERT INTO usuarios(email,nombre,ape1,ape2,pass,edad) VALUES ('$email', '$nombre', '$apellido1', '$apellido2', '$pass', '$edad')";

		$ok = consulta($sql);
		//Insertamos el rol específico, primero obtenemos el ID creado
		if($ok){

			$sql = "SELECT * FROM usuarios WHERE email = '".$email."' "; 
			$resultado = consulta($sql);
			$consulta = $resultado->fetch_assoc();


			$idUser = $consulta["id"];
			$sql = "INSERT INTO roles(id_user, rol) VALUES ('$idUser','ESTUDIANTE')";
			$resultado = consulta($sql);
			return $resultado;
		}
	}

	function n_filas($consulta){

		$n = mysqli_num_rows($consulta);

		return $n;

	}

?>
