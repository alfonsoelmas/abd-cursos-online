<?php
require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/acciones_admin.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/genera_plantilla.php");

session_start();
//Borramos los datos del usuario, con las comprobaciones correspondientes para que esta acción solo pueda ser llamada desde el administrador.

if(isset($_GET["idUser"]) && isset($_SESSION["usuario_actual"]) && ($_SESSION["rol"] == "ADMINISTRADOR") && isset($_GET["correoUser"])){
	$idUser = $_GET["idUser"];
	$correoUser = $_GET["correoUser"];
	
	$ok = comprobarIdUser_Correo($idUser, $correoUser);

	if($ok){
		$ok = borrarUsuario($idUser);
		if($ok)
			generaPlantilla("Éxito","El usuario ".$correoUser." se eliminó con éxito.");
		else
			generaPlantilla("Fallo","La acción no se pudo realizar. La consulta no se realizó correctamente.");
	} else
		generaPlantilla("Fallo","La acción no se pudo realizar por que el correo no se corresponde al ID.");


} else {
	generaPlantilla("Fallo","La acción no se pudo realizar por algún motivo.");

}


?>