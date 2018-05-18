<?php
require_once($_SERVER['DOCUMENT_ROOT'] ."/abd/back/funciones/consulta.php");


/*

ACCIONES ADMIN
Aquí se encuentran todas o la mayoría de las consultas de la aplicación web.
Toda comunicación con la base de datos se realizará en este ficheros mediante funciones específicas que permitan la comunicación.

*/



//Asigna un rol a un id de usuario modificandolo en la base de datos
function asignarRol($id_user, $rol){

	$sql = "UPDATE roles SET rol = '$rol' WHERE id_user = '$id_user'";

	$resultado = consulta($sql);

	return $resultado; // TRUE/FALSE
}


//Borra un usuario de la base de datos por su ID
function borrarUsuario($id_user){	

	$sql = "DELETE FROM usuarios WHERE id = '$id_user'";
	$ok = $resultado = consulta($sql);


	return $resultado; // TRUE/FALSE
}


//Borra una asignatura de la base de datos por su ID
function borrarAsignatura($id){	

	$sql = "DELETE FROM asignaturas WHERE id = '$id'";
	$ok = $resultado = consulta($sql);


	return $resultado; // TRUE/FALSE
}

//Borra un curso por su id
function borrarCurso($id){	

	$sql = "DELETE FROM cursos WHERE id = '$id'";
	$ok = $resultado = consulta($sql);


	return $resultado; // TRUE/FALSE
}


//Comprueba que el ID de un usuario y su correo se corresponden
function comprobarIdUser_Correo($id_user, $correo){


	$sql = "SELECT email FROM usuarios WHERE id = '$id_user' ";
	$resultado = consulta($sql);
	$ok = false;
	if(mysqli_num_rows($resultado)==1)
		$ok = true;
	else
		$ok = false;

	return $ok; // TRUE/FALSE
}


//Devuelve listado de correos que coincidan con el valor de busqueda
function busquedaCorreo($valor){

	$sql = "SELECT  id, email, nombre, ape1, ape2 FROM usuarios WHERE email LIKE '%".$valor."%'";

	$resultado = consulta($sql);

	return $resultado;

}

//Devuelve listado de correos que coincidan con el valor de busqueda
function busquedaAsignaturas($valor){

	$sql = "SELECT  id, nombre, descripcion FROM asignaturas WHERE nombre LIKE '%".$valor."%'";

	$resultado = consulta($sql);

	return $resultado;

}

//Añade una asignatura a la tabla de asignaturas.
function addAsignaturas($nombre, $descripcion){

	$sql = "INSERT INTO asignaturas (id, nombre, descripcion) VALUES (NULL, '".$nombre."', '".$descripcion."')";

	$resultado = consulta($sql);

	return $resultado;

}


//Devuelve listado de correos que coincidan con el valor de busqueda
function busquedaCursos($valor){

	$sql = "SELECT  id, nombre, descripcion FROM cursos WHERE nombre LIKE '%".$valor."%'";

	$resultado = consulta($sql);

	return $resultado;

}

//Añade un curso a la tabla de asignaturas.
function addCursos($nombre, $descripcion){

	$sql = "INSERT INTO cursos (id, nombre, descripcion) VALUES (NULL, '".$nombre."', '".$descripcion."')";

	$resultado = consulta($sql);

	return $resultado;

}

//Añade un curso a la tabla de asignaturas.
function addAsignaturasToCursos($idCurso, $arrayAsignaturas, $tamArray){

	$sql = "INSERT INTO contiene (id_curso, id_asignatura) VALUES";

	for($i=0; $i<$tamArray; $i++){
		$sql .= "('".$idCurso."', '".$arrayAsignaturas[$i]."')";
		if($i<$tamArray-1) $sql .= ",";
	}


	$resultado = consulta($sql);

	return $resultado;

}

//Añade un curso a la tabla de asignaturas.
function addUsuariosToCursos($idCurso, $arrayAsignaturas, $tamArray){

	$sql = "INSERT INTO matricula (id_user, id_curso) VALUES";

	for($i=0; $i<$tamArray; $i++){
		$sql .= "('".$arrayAsignaturas[$i]."', '".$idCurso."')";
		if($i<$tamArray-1) $sql .= ",";
	}

	$resultado = consulta($sql);

	return $resultado;

}


//Devuelve el ID de los cursos asociados al usuario
function busquedaCursosPorAlumno($idAlumno){


	$sql = "SELECT id_curso FROM matricula WHERE id_user = '".$idAlumno."' ";
	$resultado = consulta($sql);

	return $resultado;

}


//Devuelve nombre y descripción de un curso buscado por ID
function obtenerDatosCurso($idCurso){

	$sql = "SELECT nombre, descripcion FROM cursos WHERE id = '".$idCurso."'";

	$resultado = consulta($sql);

	return $resultado;

}


//Devuelve el ID de las asignaturas asociadas a ese curso.
function busquedaAsignaturasPorCurso($idCurso){


	$sql = "SELECT id_asignatura FROM contiene WHERE id_curso = '".$idCurso."' ";
	$resultado = consulta($sql);

	return $resultado;

}


//Devuelve nombre y descripción de una asignatura buscada por ID
function obtenerDatosAsignatura($idAs){

	$sql = "SELECT nombre, descripcion FROM asignaturas WHERE id = '".$idAs."'";

	$resultado = consulta($sql);

	return $resultado;

}

//Devuelve los contenidos de una asignatura (Buscado por ID de asignatura)
function busquedaContenidoPorAsignatura($idCurso){

	$sql = "SELECT id, ruta, nombre FROM contenidos WHERE id_asignatura = '".$idCurso."' ";
	$resultado = consulta($sql);

	return $resultado;

}


//Devuelve los contenidos de una asignatura (Buscado por ID de asignatura)
function addContenido($idAs,$ruta,$nombre){

	$sql = 	"INSERT INTO contenidos (id, id_asignatura, ruta, nombre) VALUES (NULL, '".$idAs."', '".$ruta."', '".$nombre."');";
	$resultado = consulta($sql);

	return $resultado;

}


?>