<?php 
	session_start();
if(!isset($_SESSION['id']))
	header('Location:index.php');

	require '../db_connect.php';
	$connect = conecta();
	$title = "Lista de Usuarios";
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
	<title>Usuarios</title>
</head>
<body class="bgcolor-blue6">

	<?php require 'users-nav-bar.php' ?>
	<div class="row row-top">
	<h1 class="col-d-10 ">Listado de usaurios</h1>
 		<table class="col-d-10 col-md-1">
			<tr class="header-table bgcolor-blue1">
				<th>Imagen</th>
				<th>Nombre</th>
				<th>correo</th>
				<th>rol</th>
				<th>Opciones</th>
			</tr>
			<?php
			$query = "SELECT * FROM administradores";
			$query_result = mysqli_query($connect,$query);
			$query_number_results = mysqli_num_rows($query_result);

			for($i = 0;$i<$query_number_results;$i++)
			{
				mysqli_data_seek($query_result,$i);
				$registro = mysqli_fetch_array($query_result);	
			?>	
			<tr class="<?php echo $registro[0]; ?>  bgcolor-blue2">
				<td><div class="img-profile"><img src="../profile_img/<?php echo $registro[7]; ?>"></img></div></td>
				<td><?php echo $registro[1]." ".$registro[2];?></td>
				<td><?php echo$registro[3];?></td>
				<td><?php echo($registro[5]==1)?"Administrar":"Consultar"?></td>
				<td>
					<?php if($_SESSION['id']!=$registro[0])
					echo "<span class= \"icon-bin btn-eliminar bgcolor-blue1 btn-table\" data-id=\" $registro[0]\" data-t=\"administradores\"></span>
		
					<a href=\"edit.php?id=$registro[0];\">
					<span class=\"icon-pencil btn-edit bgcolor-blue1 btn-table\" data-id=\"$registro[0]\"></span>
					</a>"
					?>

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