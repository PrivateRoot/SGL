<?php 

function createSesion($registro){
	session_start();
	$_SESSION['customerid'] = $registro[0];
	$_SESSION['nombre'] = $registro[1];
	$_SESSION['apellidos'] = $registro[2];
	$_SESSION['correo'] = $registro[3];
	return array('status' => 1);
}

function closeSesion(){
	session_start();
	session_destroy();
	return array('status' => 1);
}
 ?>