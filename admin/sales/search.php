<?php 

	if(!isset($_POST['search']))
	{
		header('index.php');//te enviara al index de ventas
		// echo json_encode(array('response' => "not arre"));
	}

	require '../db_connect.php';
	$opt = $_POST['action'];
	$search = $_POST['search'];

	switch ($opt) {
		case 1://busqueda en la barra
	$conn = conecta();
	$query = "SELECT * FROM productos WHERE nombre      LIKE '%$search%'
										 OR codigo      LIKE '%$search%'
										 OR descripcion LIKE '%$search%'
										 AND stock > 0";
	$query_result = mysqli_query($conn,$query);
	$query_rows = mysqli_num_rows($query_result);

	if($query_rows > 0){		

			$rows = array();

			while($r = mysqli_fetch_assoc($query_result)){
			    $rows[]['row'] = $r;
			}
			mysqli_free_result($query_result);

			echo json_encode($rows);

			mysqli_close($conn);
	}
			break;
		case 2://busqueda para agregar //comprueba stock
			$conn = conecta();	
			$query = "SELECT * FROM productos WHERE id ='$search'";
			$query_result = mysqli_query($conn,$query);
			$result = mysqli_fetch_assoc($query_result);
			echo json_encode($result);
			mysqli_close($conn);
			break;
		case 3://comprueba stock
			$conn = conecta();	
			$query = "SELECT * FROM productos WHERE id ='$search'";				
			mysqli_close($conn);
			break;
		default:
			// code...
			break;
	}
 ?>