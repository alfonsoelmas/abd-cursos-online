<?php
require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/acciones_admin.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/genera_plantilla.php");

session_start();
//Borramos los datos del usuario, con las comprobaciones correspondientes para que esta acción solo pueda ser llamada desde el administrador.

if(isset($_GET["id"]) && isset($_SESSION["usuario_actual"]) && ($_SESSION["rol"] == "ADMINISTRADOR") ){
	
	$idAs = $_GET["id"];

	$ok = borrarAsignatura($idAs);
	if($ok)
		generaPlantilla("Éxito","La asignatura con id ".$idAs." se eliminó con éxito.");
	else
		generaPlantilla("Fallo","La acción no se pudo realizar. La consulta no se realizó correctamente.");


} else {
	generaPlantilla("Fallo","La acción no se pudo realizar por algún motivo.");

}


?>