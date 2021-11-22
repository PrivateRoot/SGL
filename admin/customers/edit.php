<?php 
session_start();
if(!isset($_SESSION['id']))
	header('Location:index.php');


$id = $_GET['id'];
// if(!isset($id))
// 	header('Location:index.php');

 	require'../db_connect.php';
 	$conn = conecta();

 	$query = "SELECT * FROM clientes WHERE id='$id' ";
 	$result = mysqli_query($conn,$query);
 	$registro = mysqli_fetch_array($result);
 	// $title = "Editar cliente";
 	// $rowCount = mysqli_num_rows($resuslt);

?>
<!DOCTYPE html>
<html lang="Mx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../icomoon/style.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/validator.js"></script>
    <title>Editar Cliente</title>
</head>
<body class="bgcolor-blue6">
    <div class="row row-top">
	<form class="col-d-4 col-md-4 bgcolor-gray4" method="POST" 
	enctype="multipart/form-data" name="update-form-customers" action="">

		<a href="customers-list.php"><span class="icon-undo2 btn-details bgcolor-blue1"></span></a>
		<h1 class="bgcolor-blue5 icon-user icong"><span>  Editar usuario</span></h1>
		<p>*solo se actualizan los campos llenados</p><br>
		
		<input type="hidden" name="FormName" value="clientes">
		<input type="hidden" name="id" value="<?php echo $registro[0]; ?>">
		<input type="text" name="nombre" id="nombre" placeholder="<?php echo $registro[1]; ?>"><br><br>
		<input type="text" name="apellidos" id ="apellidos" placeholder="<?php echo $registro[2]; ?>"><br><br>
		<input type="email" name="correo" id = "correo" placeholder="<?php echo $registro[3]; ?>"><br><br>
		<input type="password" name="pwd" id ="pwd" autocomplete="new-password">
		<br>
		<input type="submit"  id="submit" name="Enviar"  value="Registrarse">
		<label for="submit" class=" btn-update bgcolor-blue5 icon-user-check"></label>

	</form>
	</div>
</body>
</html>