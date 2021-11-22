<?php 
	session_start();
if(!isset($_SESSION['id']))
	header('Location:../index.php');


	require '../db_connect.php';
	$connect = conecta();
	$query = "SELECT * FROM pedidos";
	$query_result = mysqli_query($connect,$query);
	$query_number_results = mysqli_num_rows($query_result);
	$title = "Pedidos";
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
	<title>Clientes|Listado</title>
</head>
<body class="bgcolor-blue6">

	<?php require 'pedidos-nav-bar.php'; ?>

	<div class="row row-top">
<!-- 		<div class="col-d-10 col-md-1 bgcolor-blue5 ">
			<h1>Listado de Clientes</h1>
		</div> -->

	</div>
	<?php 
		if($query_number_results > 0)
			echo "<div class=\"row\">";
		else{
			echo "<div class=\"bgcolor-blue5 col-d-4 col-md-4 empty-reg\">
			<span class=\"icon-cancel-circle\"></span>
	 		<span>No hay registros</span>
			</div>";
			echo "<div class=\"row\" style=\"display:none;\">";
		}

	 ?>
 		<table class="col-d-10 col-md-1">
			<tr class="header-table bgcolor-blue1">
				<th>ID pedido</th>
				<th>Fecha</th>
				<th>ID Usuario</th>
				<th>Opciones</th>
			</tr>
			<?php


			for($i = 0;$i<$query_number_results;$i++)
			{
				mysqli_data_seek($query_result,$i);
				$registro = mysqli_fetch_array($query_result);	
				if($registro[3] == 1){
			?>	
			<tr class="<?php echo $registro[0]; ?>  bgcolor-blue2">
				<td><?php echo $registro[0]; ?></td>
				<td><?php echo $registro[1];?></td>
				<td><?php echo$registro[2];?></td>
				<td>
					<span class= "icon-bin btn-del-pedido bgcolor-blue5 btn-table" data-id=" <?php echo $registro[0]; ?>" 
					data-t="clientes"></span>
		
					<span class="icon-rocket btn-dispatch bgcolor-blue5 btn-table" data-id="<?php echo $registro[0]; ?>"></span>
					

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
<!-- <p>house of the dead</p> -->
</body>
</html>