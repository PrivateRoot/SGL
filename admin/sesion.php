<?php 

// if(session_start())
// session_start();
// if(!isset($_SESSION['id']))
// 	echo "no set session";

function createSesion($registro){
	session_start();
	$_SESSION['id'] = $registro[0];
	// $_SESSION['id'] = "sesion jala";
	$_SESSION['nombre'] = $registro[1];
	$_SESSION['apellidos'] = $registro[2];
	$_SESSION['correo'] = $registro[3];
	$_SESSION['rol'] = $registro[5];
	$_SESSION['img'] = $registro[7];
	return array('status' => 1);
}
function closeSesion(){
	session_start();
	session_destroy();
	return array('status' => 1);
}

 ?>