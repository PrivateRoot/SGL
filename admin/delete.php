<?php 


if (!isset($_POST['action'])) 
	header('Location:404');

$action = $_POST['action'];
$id = $_POST['id'];
$table = $_POST['t'];

require'db_connect.php';
$conn = conecta();

switch ($action) {
	case 1://eliminar logico
		$query = "UPDATE $table SET eliminado = 1 WHERE id = '$id'";
		if(mysqli_query($conn,$query)===true)
			$status = 1;
		else
			$status = 0;
		mysqli_close($conn);
			echo json_encode(array('status' => $status));
		break;
	case 2://elimina fisico
		$query = "DELETE FROM $table WHERE id = '$id'";
		if(mysqli_query($conn,$query)===true)
			$status = 1;
		else
			$status = 0;
		mysqli_close($conn);
		echo json_encode(array('status' => $status));
		break;
	default:
		// code...
		break;
}
 ?>