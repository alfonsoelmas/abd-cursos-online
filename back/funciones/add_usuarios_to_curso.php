
<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/acciones_admin.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/genera_plantilla.php");


if(isset($_SESSION["usuario_actual"]) && $_SESSION["rol"] == "ADMINISTRADOR" && isset($_GET["id"]) && isset($_GET["usuarios"])){
	$idCurso = $_GET["id"];
	$asignaturas = $_GET["usuarios"];

	$tamArray = 0;
	foreach ($_GET["usuarios"] as $asignatura) {	
			$tamArray++;
	}


	$ok = addUsuariosToCursos($idCurso, $asignaturas, $tamArray);

	if($ok){

		generaPlantilla("Exito","Se añadieron los usuarios exitosamente.");
	} else {

		generaPlantilla("Fallo","La consulta se realizó incorrectamente.");

	}

} else {
	generaPlantilla("Fallo","La sesión no se corresponde o el GET fue enviado incorrectamente");
}


?>