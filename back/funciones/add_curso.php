
<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/acciones_admin.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/genera_plantilla.php");


if(isset($_SESSION["usuario_actual"]) && $_SESSION["rol"] == "ADMINISTRADOR" && isset($_POST["nombre"]) && isset($_POST["descripcion"])){
	$nombre = $_POST["nombre"];
	$descripcion = $_POST["descripcion"];

	$ok = addCursos($nombre, $descripcion);

	if($ok){
		generaPlantilla("Exito","El curso ".$nombre." se creo exitosamente. Dirijase a la administración para asignarle asignaturas.");
	} else {
		generaPlantilla("Fallo","La consulta se realizó incorrectamente.");

	}

} else {
	generaPlantilla("Fallo","La sesión no se corresponde o el POST fue enviado incorrectamente");
}


?>