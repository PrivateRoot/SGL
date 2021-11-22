<?php 
	session_start();
if(!isset($_SESSION['id']))
	header('Location:../index.php');

$title = "Listado Ventas";
// $id_venta = $_GET['id'];

	require '../db_connect.php';
	$conn = conecta();
	$query = "SELECT * FROM ventas";
	$query_result = mysqli_query($conn,$query);
	$query_number_results = mysqli_num_rows($query_result);

	$title = "Detalle de venta" ;
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
    <script src="../js/validator.js"></script>
	<title>Detalle pedido</title>
</head>
<body class="bgcolor-blue6">

<?php require'sales-nav-bar.php' ?>
	<div class="row row-top">
			<a href="index.php">
			<div class="icon-nav-container bgcolor-blue1 col-d-2 ">
				<span class="icon-undo btn-print"></span>
				<span>Punto de venta</span>
			</div>
		</a>
	</div>
	<?php 
		/*if($query_number_results > 0)
			echo "<div class=\"row\">";
		else{
			echo "<div class=\"bgcolor-blue5 col-d-4 col-md-4 empty-reg\">
			<span class=\"icon-cancel-circle\"></span>
	 		<span>No hay registros</span>
			</div>";
			echo "<div class=\"row\" style=\"display:none;\">";
		}
			*/
	 ?>
 		<table class="col-d-10 col-md-1">
			<tr class="header-table bgcolor-blue1">
				<th>id Venta</th>
				<th>usurio</th>
				<th>cliente</th>
				<th>fecha</th>
				<th>operaciones</th>
			</tr>
			<?php


			for($i = 0;$i<$query_number_results;$i++)
			{
				mysqli_data_seek($query_result,$i);
				$registro = mysqli_fetch_array($query_result);

				$query_user = "SELECT * FROM administradores WHERE id='$registro[1]'";
				$result_user = mysqli_query($conn,$query_user);
				$reg = mysqli_fetch_array($result_user);

				$query_customer = "SELECT * FROM clientes WHERE id='$registro[2]'";
				$result_customer = mysqli_query($conn,$query_customer);
				$reg_customer = mysqli_fetch_array($result_customer);
			?>	
			<tr class="<?php echo $registro[0]; ?>  bgcolor-blue2">
				<td><?php echo $registro[0]; ?></td>
				<td><?php echo $reg[1]." ".$reg[2]; ?></td>
				<td><?php echo ($registro[2] == 0) ? "N/A" : $reg_customer[1]." ".$reg_customer[2];?></td>
				<td><?php echo $registro[3] ?></td>
				<td>
					<a href="details.php?id=<?php echo $registro[0]; ?>">
					<span class="icon-binoculars btn-detalles bgcolor-blue1 btn-table" data-id="<?php echo $registro[0];?>"></span>
					</a>

				</td>
			</tr>
			<?php 
				}
			?>
		</table>

			
	</div>
<!-- <p>house of the dead</p> -->
</body>
</html>
?>