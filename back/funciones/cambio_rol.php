<?php

	require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/acciones_admin.php");
	require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/genera_plantilla.php");
	
	if(isset($_POST['idUser']))
	{
		$idUser = 	 $_POST['idUser'];
		$correo = 	 $_POST['correoUser'];
		$rol 	=    $_POST['rol'];

		$ok = comprobarIdUser_Correo($idUser, $correo); //Comprobamos que no han modificado los datos y que el id se corresponde al correo.

		if($ok){
			$ok = asignarRol($idUser, $rol); //Si está ok, modificamos el rol del idUser
		}


		if($ok){
			generaPlantilla("Éxito","La modificación resultó exitosamente. El Rol ha resultado cambiado. Cuando el usuario inicie sesión notará los cambios.");
		} else {
			generaPlantilla("Fallo","La modificación resultó fallida. El Rol puede no haberse cambiado.");
		}
	} else {
			generaPlantilla("Fallo","El formulario se envió incorrectamente.");
	}

?>