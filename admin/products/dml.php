<?php

// if (!isset($_POST['action'])){
// 	header("Location:404");	
// 	// echo 'you';
// }
$action = $_POST['action'];
// $action = 2;
		require '../db_connect.php';
		$conn = conecta();

switch ($action) {
	case 1://comprueba que no exista ese codigo
		$code = $_POST['code'];
		$query = "SELECT * FROM productos WHERE codigo = '$code'";

		$query_result = mysqli_query($conn,$query);
		$num_rows = mysqli_num_rows($query_result);
// echo json_encode(array('status' => true));
		
		if($num_rows > 0)
			echo json_encode(array('status' => true));
		else
			echo json_encode(array('status' => false));

		mysqli_close($conn);
		break;
	case 2:
		break;
	default:
		// code...
		break;
}

 ?>