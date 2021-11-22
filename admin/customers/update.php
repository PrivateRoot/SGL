<?php 

// echo json_encode(array('asd'=> "asd"));

if(!isset($_POST['id']))
{
	header('Location:404');
	exit();
}

// if(isset($_POST['id']))
	$id = $_POST['id'];


session_start();

$query = "";
$cambios = false;//detecta cambios en la cosulta

/*always*/
$query = "UPDATE clientes SET ";

/*Nombre*/
if(isset($_POST['nombre'])){
	$nombre = $_POST['nombre'];
	$query.= "nombre = '$nombre'";
	$cambios = true;
}

/*Apellidos*/
if(isset($_POST['apellido'])){
	$apellidos = $_POST['apellido'];
	if($cambios)//si hubo cambios agrega coma
		$query.=",";

	$query.= "apellidos = '$apellidos'";
	$cambios = true;

	
}
/*Correo*/
if(isset($_POST['correo'])){
	$correo = $_POST['correo'];
	if($cambios)//si hubo cambios agrega coma
		$query.=",";
	$query.="correo = '$correo'";
	$cambios = true;
}


/*password*/
if (isset($_POST['pwd'])) {
	$pwd = $_POST['pwd'];	
	$pwd_enc = md5($pwd);
	if($cambios)//si hubo cambios agrega coma
		$query.=",";
	$query.="password = '$pwd_enc'";
	$cambios = true;			

}
	

@$query.= " WHERE id = '$id'";
/*DO QUERY*/

require '../db_connect.php';
$conn = conecta();

		
	// echo $query;
	if(mysqli_query($conn,$query))
	{
		echo json_encode(array('status' => $query));

	}
	else {
		// echo json_encode(array('status' => $query));
		echo json_encode(array('status' => 'no me quiero ir sr. Stark'));
			
		}			
		mysqli_close($conn);


 ?>