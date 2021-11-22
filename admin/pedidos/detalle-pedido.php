<?php 
if(!isset($_GET['id'])){
	header('Location:lista-pedidos.php');
}
$id = $_GET['id'];
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../icomoon/style.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/main.js"></script>
	<title></title>
</head>
<body class="bgcolor-blue6">
		<?php 
	require '../db_connect.php';
	$conn = conecta();

		$query = "SELECT * FROM pedidos WHERE id = '$id'";
		$result = mysqli_query($conn,$query);
		$row = mysqli_fetch_row($result);

		$idpedido = $row[0];

		
		$query = "SELECT * FROM pedidos_productos WHERE id_pedido = '$idpedido'";
		$result = mysqli_query($conn,$query);
		$num_productos = mysqli_num_rows($result);

		/*Total*/
		$total = 0;
		for ($i = 0; $i < $num_productos; $i++){
	 	mysqli_data_seek($result,$i);
		$pedidos_productos_row = mysqli_fetch_row($result);
		$productid = $pedidos_productos_row[2];
 		$query = "SELECT * FROM productos WHERE id='$productid'";
 		$result_p = mysqli_query($conn,$query);
		$row = mysqli_fetch_row($result_p);

			$total += $row[4]*$pedidos_productos_row[3];

		}


	 ?>
	<div class="row row-top">
		<table class="col-d-10 col-md-1">
			<tr class="header-table bgcolor-blue1">
				<th>Imagen</th>
				<th>ID producto</th>
				<th>ID cantidad</th>
				<th>Opciones</th>
			</tr>
			<?php


			for($i = 0;$i<$query_number_results;$i++)
			{
				mysqli_data_seek($query_result,$i);
				$registro = mysqli_fetch_array($query_result);	
				if($registro[3] ==1){
			?>	
			<tr class="<?php echo $registro[0]; ?>  bgcolor-blue2">
				<td><?php echo $registro[0]; ?></td>
				<td><?php echo $registro[1];?></td>
				<td><?php echo$registro[2];?></td>
				<td>
					<span class= "icon-bin btn-eliminar bgcolor-blue5 btn-table" data-id=" <?php echo $registro[0]; ?>" 
					data-t="clientes"></span>
		
					<a href="edit.php?id=<?php echo $registro[0]; ?>">
					<span class="icon-rocket btn-dispatch bgcolor-blue5 btn-table" data-id="$registro[0]"></span>
					</a>

					<a href="detalle-pedido.php?id=<?php echo $registro[0]; ?>">
					<span class="icon-binoculars btn-detalles bgcolor-blue5 btn-table" data-id="<?php echo $registro[0];?>"></span>
					</a>
				</td>
			</tr>
			<?php 
					}
			}
			?>
		</table>
	</div>
</body>
</html>
