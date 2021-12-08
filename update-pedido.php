<?php
	$action = $_POST['action'];
	$customerid	= $_POST['customerid'];



	// echo json_encode(array('status' =>  $customerid));

require 'db_connect.php';
	// this method search in pedios table to know if user has a pedido

	function ExistePedidoAbierto($customerid){
	
		$conn = conecta();

		$query = "SELECT * FROM pedidos WHERE usuario='$customerid' AND status = 0";
		$result = mysqli_query($conn,$query);
		$rows = mysqli_num_rows($result);
		// $rows = 1;
		if($rows > 0)//si hay un pedido habierto
			return true;
		else
			return false;
	}
	function ProductExist($id){

		$conn = conecta();

		$query = "SELECT * FROM productos WHERE id='$id'";
		$result = mysqli_query($conn,$query);
		$rows = mysqli_num_rows($result);
		// if($rows)
	}
	function CreaPedido($customerid,$productid){		// crea el pedido si el usuario no tiene uno abierto
		$conn = conecta();

		$query = "INSERT INTO pedidos (usuario) VALUES('$customerid')";
		 mysqli_query($conn,$query);

		 $id_pedido = mysqli_insert_id($conn);//retorna el id del pedido que acabamos de crear
		 $query = "INSERT INTO pedidos_productos (id_pedido,id_producto,cantidad) VALUES('$id_pedido','$productid','1')";
		 mysqli_query($conn,$query);
	}
	function ActualizaPedido($customerid,$productid){//de quien|que cosa|cuantos solo sirve para agregar
		//esta funcion a cada llamada y que el producto exista suma de 1 en 1
		$conn = conecta();
		//buscar el id del pedido
		$query = "SELECT * FROM pedidos WHERE usuario='$customerid'"; 
		$result = mysqli_query($conn,$query);
	 	$row = mysqli_fetch_row($result);

	 	$idpedido = $row[0];

		//busca el pedido que tenga el articulo
		$query = "SELECT * FROM pedidos_productos WHERE id_pedido='$idpedido' AND id_producto ='$productid'"; 
		$result = mysqli_query($conn,$query);
		$rows = mysqli_num_rows($result);

		if($rows > 0){//si el producto esta un el pedido solo se actualiza la cantidad (cantidad actual+1)

 			$row = mysqli_fetch_row($result);
 			$id_pedido_producto = $row[0];
 			$cantidad_actual = $row[3];
 			if(!isset($_POST['cantidad']))//si no especifico cantidad aumenta en uno 
 				$cantidad_actual++;
			else
				$cantidad_actual= $_POST['cantidad'];

			$query = "UPDATE pedidos_productos SET cantidad = '$cantidad_actual' WHERE id ='$id_pedido_producto'";
			mysqli_query($conn,$query);


		}
		else{//si no se tendra que insertar con cantidad 1
		 $query = "INSERT INTO pedidos_productos (id_pedido,id_producto,cantidad) VALUES('$idpedido','$productid','1')";
		 mysqli_query($conn,$query);

		}



	}


	switch ($action){
		case 1:	
			$productid = $_POST['productid'];
			if(ExistePedidoAbierto($customerid))
			{
				
				// $cantidad= $_POST['cantidad'];
				ActualizaPedido($customerid,$productid);
				echo json_encode(array('status' => 'existe pedido se actualiza'));
			}

			else
				CreaPedido($customerid,$productid);
				// echo json_encode(array('status' => 'se creo pedido para este man'));

			break;
		case 2://compruega si tienes pedido
			if(ExistePedidoAbierto($customerid))
				echo json_encode(array('status' => true));
			else
				echo json_encode(array('status' => false));

			break;
			case 3:
			$conn = conecta();
			$id = $_POST['id'];
				$query = "UPDATE pedidos SET status = 1 WHERE id='$id'";
				if(mysqli_query($conn,$query))
					echo json_encode(array('status'=>1));
				else
					echo json_encode(array('status'=>0));

				break;
				case 4://cuando eliminas de tu carrito 
					
					break;
		default:
			// code...
			break;
	}
	// mysqli_close($conn);
 ?>