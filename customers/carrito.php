<?php 
session_start();
if(!isset($_SESSION['customerid']))
	header("Location:index.php");
	$title = "Carrito";
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/admin/css/main.css">
    <link rel="stylesheet" type="text/css" href="/admin/icomoon/style.css">
	<script src="/admin/js/jquery-3.4.1.min.js"></script>
	<script src="js/main.js"></script>
	<title>Productos</title>
</head>
<body class="bgcolor-blue6">
	<?php require'customers-nav-bar.php' ?>
	<?php 
	require 'db_connect.php';
	$conn = conecta();

		$customerid = $_SESSION['customerid'];
		$query = "SELECT * FROM pedidos WHERE usuario = '$customerid'";
		$result = mysqli_query($conn,$query);
		$row = mysqli_fetch_row($result);

		$idpedido = $row[0];

		
		$query = "SELECT * FROM pedidos_productos WHERE id_pedido = '$idpedido'";
		$result = mysqli_query($conn,$query);
		$num_productos = mysqli_num_rows($result);

		/*Total*/
		$total = 0;
		$cantidad_productos = 0;
		for ($i = 0; $i < $num_productos; $i++){
	 	mysqli_data_seek($result,$i);
		$pedidos_productos_row = mysqli_fetch_row($result);
		$cantidad_productos += $pedidos_productos_row[3];
		$productid = $pedidos_productos_row[2];
 		$query = "SELECT * FROM productos WHERE id='$productid'";
 		$result_p = mysqli_query($conn,$query);
		$row = mysqli_fetch_row($result_p);

			$total += $row[4]*$pedidos_productos_row[3];

		}


	 ?>
	<div class="row row-top">
		<div class="row row-top">							
		<table class="col-d-3 overall-sales bgcolor-blue2">
 		<h1 class=" overall-sales-title bgcolor-blue5">Detalle de venta</h1>
 			<tr>
 				<td>Cantidad de articulos</td>
 				<td id="total-products" class="cantidad-overall"><?php echo $cantidad_productos; ?></td>
 			</tr>
 			<tr>
 				<td>Total</td>
				<td class="total-overall"> </td>	
 			</tr>
 			<tr>
 				<td>			
 					<div class="pay-button bgcolor-blue5" data-id="<?php echo $idpedido; ?>">
						<span class="icon-coin-dollar sales-icon-pay"></span>
						<span>pagar</span>	
					</div>
				</td>
				<td>
				</td>
 			</tr>
		</table>
		<table class="col-d-9 table-items-sales">
 			<tr class="header-table bgcolor-blue1">
 				<th>Borrar</th>
 				<th>Codigo</th>
 				<th>Nombre del articulo</th>
 				<th>Precio</th>
 				<th>Cantidad</th>
				<th>Total</th>	
 			</tr>
 			<?php for ($i = 0; $i < $num_productos; $i++){
 				 mysqli_data_seek($result,$i);
 				 $pedidos_productos_row = mysqli_fetch_row($result);
 				$productid = $pedidos_productos_row[2];
 				$query = "SELECT * FROM productos WHERE id='$productid'";
 				$result_p = mysqli_query($conn,$query);
				$row = mysqli_fetch_row($result_p);


			?>

 			<tr data-id="<?php  echo $row[0]; ?>" >
 				<td  data-id="<?php  echo $row[0]; ?>" class="icon-bin btn-del-carrito"></td>
 				<td  data-id=""><?php echo $row[0]; ?></td>
 				<td  data-id=""><?php echo $row[1]; ?></td>
 				<td id="price" data-id="<?php echo $row[0]; ?>"><?php echo $row[4]; ?></td>
 				<td><input type="number"  name="sales-cantidad" min="1" data-id="<?php echo $row[0] ?>" value="<?php echo $pedidos_productos_row[3]; ?>"></td>
 				<td id="total" data-id="<?php echo $row[0] ?>" value="<?php echo $pedidos_productos_row[0]; ?>"><?php echo $row[4]*$pedidos_productos_row[3];  ?></td>
 			</tr>
 		<?php }	 ?>
		</table>
 	</div> 
	</div>
</body>
</html>