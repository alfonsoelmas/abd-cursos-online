
<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/acciones_admin.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/genera_plantilla.php");

/*
	Fichero que controla si está el usuario correspondiente que permite realizar la acción, y posteriormente realiza la acción de añadir asignatura.
	Finalmente muestra un mensaje de éxito o fallo según lo sucedido.
*/
if(isset($_SESSION["usuario_actual"]) && $_SESSION["rol"] == "ADMINISTRADOR" && isset($_POST["nombre"]) && isset($_POST["descripcion"])){
	$nombre = $_POST["nombre"];
	$descripcion = $_POST["descripcion"];

	$ok = addAsignaturas($nombre, $descripcion);

	if($ok){

		generaPlantilla("Exito","La asignatura ".$nombre." se creo exitosamente");
	} else {

		generaPlantilla("Fallo","La consulta se realizó incorrectamente.");

	}

} else {
	generaPlantilla("Fallo","La sesión no se corresponde o el POST fue enviado incorrectamente");
}


?>