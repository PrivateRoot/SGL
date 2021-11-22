<?php 
	if(!isset($_POST['user']))
	{
		header('index.php');//te enviara al index de ventas
	}



	require '../db_connect.php';
	$conn = conecta();


	$user = $_POST['user'];
	$productos = $_POST['products'];
	if(isset($_POST['customer']))
		$customer = $_POST['customer'];
	else
		$customer = 0;


	$rows = 0;
	for ($i = 0; $i <count($productos); $i++) {
		//si encuentra 1 id de todo el pedido del cual no hay stock la compra no se guarda

		$cant = $productos[$i]['cantidad'];
		$id = $productos[$i]['id'];
		$query = "SELECT id FROM productos WHERE stock < '$cant' AND  id = '$id'";
		$query_result = mysqli_query($conn,$query);

		$rows += mysqli_num_rows($query_result);
	}
		if ($rows>0){
    		echo json_encode(array('response' => false));
			mysqli_close($conn);
			exit();
		}

	

		$query = "INSERT INTO ventas(id_usuario,id_cliente) VALUES ('$user','$customer')";
		$query_result = mysqli_query($conn,$query);
		$id_venta = mysqli_insert_id($conn);

	// $r;
	for ($i = 0; $i <count($productos); $i++) {
		$p = $productos[$i]['id'];
		$c = $productos[$i]['cantidad'];

		$query = "INSERT INTO detalle_venta(id_producto,cantidad,id_venta) 
		VALUES ('$p','$c','$id_venta')";
		 $r = mysqli_query($conn,$query);

	}
	// session_start();
	// $_SESSION['sale'] = $id_venta;
    echo json_encode(array('response' => true,'id' => $id_venta));
	mysqli_close($conn);
 ?>