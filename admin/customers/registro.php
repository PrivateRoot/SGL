<!DOCTYPE html>
<html lang="Mx">
<?php 
// session_start();
// if(!isset($_SESSION['id']))
// {
	// $sql_query = "SELECT * FROM administradores WHERE rol = 1";
	// $query_result = mysqli_query($conn,$sql_query);
	// $query_rows = mysqli_num_rows($query_result);
		// header('Location:../');

// }
		$title = "registrar cliente";
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../icomoon/style.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/validator.js"></script>
    <title>Registro|Clientes</title>
</head>
<body class="bgcolor-blue6">
	<?php
	/*Mostrar la barra solo si la session esta activa*/
	if(isset($_SESSION['id']))
		require 'customers-nav-bar.php';
	?>
    <div class="row row-top">
	<form class="col-d-4 col-md-4 bgcolor-gray4" method="POST" 
	enctype="multipart/form-data" name="reg-form" action="create/" autocomplete="off">

		<h1 class="bgcolor-blue5 icon-user-plus icong"><span>  Registrar Cliente</span></h1>
		
		
		<input type="hidden" name="FormName" value="clientes">
		<input type="text" name="nombre" id="nombre" placeholder="Nombre"><br><br>
		<input type="text" name="apellidos" id ="apellidos" placeholder="Apellidos"><br><br>
		<input type="email" name="correo" id = "correo" placeholder="Correo"><br><br>
		<input type="password" name="pwd" id ="pwd" autocomplete="new-password">
		<br><br>
		<input type="submit" id="submit" name="Enviar" onclick="ValidaForm(); return false;">
		<label for="submit" class="btn-update bgcolor-blue5 icon-user-check"></label>
	</form>
	</div>
</body>
</html>