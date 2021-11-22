<?php
$id = $_POST['id'];
$action = $_POST['action'];
require '../db_connect.php';
$conn = conecta();
 switch ($action) {
 	case 1:
 		$query = "UPDATE pedidos SET status = 2 WHERE id = '$id'";
 		if(mysqli_query($conn,$query))
 			echo json_encode(array('status'=>1));
 		else
 			echo json_encode(array('status'=>0));
 		break;
	case 2:
		$query = "DELETE FROM pedidos_productos WHERE id_pedido = '$id'";
		mysqli_query($conn,$query);

		$query = "DELETE FROM pedidos WHERE id = '$id'";
		mysqli_query($conn,$query);
		echo json_encode(array('status'=>1));
		break;
 	
 	default:
 		// code...
 		break;
 }
 ?>