<?php 
	session_start();
if(!isset($_SESSION['id']))
	header('Location:../index.php');

$id_venta = $_GET['id'];

	require '../db_connect.php';
	$conn = conecta();
	$query = "SELECT * FROM detalle_venta WHERE id_venta ='$id_venta'";
	$query_result = mysqli_query($conn,$query);
	$query_number_results = mysqli_num_rows($query_result);
	// $title = "Detalle de venta" ;
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


	<div class="row row-top">
		<!-- <span class="icon-file-text2 icon-main-nav bgcolor-blue5"></span> -->
		<a href="ticket.php?id=<?php echo $id_venta; ?>">
			<div class="icon-nav-container bgcolor-blue5 col-d-2 col-md-1">
				<span class="icon-file-text2 btn-print"></span>
				<span>Imprimir ticket</span>
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
				<th>Imagen</th>
				<th>Nombre</th>
				<th>Codigo</th>
				<th>Costo</th>
				<th>cantidad</th>
			</tr>
			<?php


			for($i = 0;$i<$query_number_results;$i++)
			{
				mysqli_data_seek($query_result,$i);
				$registro = mysqli_fetch_array($query_result);

				$prod_query = "SELECT * FROM productos WHERE id = '$registro[1]'";
				$prod_query_res = mysqli_query($conn,$prod_query);
				$prod_reg = mysqli_fetch_array($prod_query_res);
			?>	
			<tr class="<?php echo $registro[0]; ?>  bgcolor-blue2">
				<td><div class="img-profile"><img src="../products_img/<?php echo $prod_reg[7]; ?>"></img></div></td>
				<td><?php echo $prod_reg[1];?></td>
				<td><?php echo$prod_reg[2];?></td>
				<td> $<?php echo$prod_reg[4];?></td>
				<td><?php echo$registro[2];?></td>
				<td></td>
			</tr>
			<?php 
				}
			?>
		</table>

			
	</div>
<!-- <p>house of the dead</p> -->
</body>
</html>