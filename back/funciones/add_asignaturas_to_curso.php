
<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/acciones_admin.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/genera_plantilla.php");

/*
	Fichero que controla si está el usuario correspondiente que permite realizar la acción, y posteriormente realiza la acción de insertar a un curso asignaturas.
	Finalmente muestra un mensaje de éxito o fallo según lo sucedido.
*/

if(isset($_SESSION["usuario_actual"]) && $_SESSION["rol"] == "ADMINISTRADOR" && isset($_GET["id"]) && isset($_GET["asignaturas"])){
	$idCurso = $_GET["id"];
	$asignaturas = $_GET["asignaturas"];

	$tamArray = 0;
	foreach ($_GET["asignaturas"] as $asignatura) {	
			$tamArray++;
	}


	$ok = addAsignaturasToCursos($idCurso, $asignaturas, $tamArray);

	if($ok){

		generaPlantilla("Exito","Se añadieron las asignaturas exitosamente.");
	} else {

		generaPlantilla("Fallo","La consulta se realizó incorrectamente.");

	}

} else {
	generaPlantilla("Fallo","La sesión no se corresponde o el GET fue enviado incorrectamente");
}


?>