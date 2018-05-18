<?php

	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/acciones_admin.php");
	require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/genera_plantilla.php");
	require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/filtrado_entrada.php");

	/*
	Fichero que controla si está el usuario correspondiente que permite realizar la acción, y posteriormente realiza la acción de añadir contenido.
	El contenido no puede ocupar mas de X tamaño, y los formatos aceptados son los que se leen en la condición del IF.
	Finalmente muestra un mensaje de éxito o fallo según lo sucedido.
*/

	if(isset($_SESSION["usuario_actual"]) && $_SESSION["rol"] == "PROFESOR" && isset($_POST["nombre"]) && isset($_POST["id"])){
		//Subimos el archivo
	     $nombre = basename($_FILES['userfile']['name']);
	     $nombre .= generateRandomString(5);
	     $tipo_archivo = $_FILES['userfile']['type'];
	     $tamano_archivo = $_FILES['userfile']['size'];
	     $ruta = $_SERVER['DOCUMENT_ROOT'] ."/abd/contenido/";
	     $ruta_del_archivo = $ruta.$_FILES['userfile']['name']; 
	     $rutaBaseDatos = "/abd/contenido/".$_FILES['userfile']['name'];
	     $nombre_archivo=$_FILES['userfile']['name'];
	     
	     if ($nombre!=''){
	          if (!((strpos($tipo_archivo, "pdf") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png") || strpos($tipo_archivo,"ppt") ) && ($tamano_archivo < 1000000) )){
	                  /*se indica que la ext o el tamaño no son correctos*/    
	          }else{
	                   if(move_uploaded_file($_FILES['userfile']['tmp_name'],$ruta_del_archivo)){ //TODO ARREGLAR
	                        //Lo añadimos a la base de datos

	                   		//TODO, NO HAY NINGUN CONTROL
	                   		$nombreCont = $_POST["nombre"];
	                   		$idAs = $_POST["id"];

	                   		$ok = addContenido($idAs,$rutaBaseDatos,$nombreCont);

	                   		if($ok){
								generaPlantilla("Exito","El contenido se subió al servidor.");
	                   		} else {
	                   			generaPlantilla("Fallo","La consulta tuvo algún problema.");
	                   		}

	                   }else{
	                        generaPlantilla("Fallo","El contenido no se subió correctamente.");
	                    }
	          }
	     }
	 } else {
        generaPlantilla("Fallo","Sesión indebida o mal pasado el POST.");
	 }


?>