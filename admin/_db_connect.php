<?php
// $servidor= "localhost";
// $nombre_bd = "clientes";
// $usuario="root";
// $pwd_bd = "privateroot";

function conecta(){
	$conn = mysqli_connect("databases.000webhost.com","id11254488_privateroot","privateroot","id11254488_sgl");
if(!$conn){
	// echo "Error conectando al servidor";
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
	}
	return $conn;
}
?>