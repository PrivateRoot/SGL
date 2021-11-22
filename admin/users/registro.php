<?php 
// only for first run
session_start();
if(!isset($_SESSION['id']))
		header('Location:../');

$title = "Registro";
require'../db_connect.php';
$conn = conecta();
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
    <title>Registrarse</title>
</head>
<body class="bgcolor-blue6">
	<?php
	/*Mostrar la barra solo si la session esta activa*/
	if(isset($_SESSION['id']))
		require 'users-nav-bar.php';
	?>
    <div class="row row-top">
	<form class="col-d-4 col-md-4 bgcolor-gray4" method="POST" 
	enctype="multipart/form-data" name="reg-form" action="../reg/">

		<h1 class="bgcolor-blue5 icon-user-plus icong"><span>  Registrar usuario</span></h1>
		
		<input type="hidden" name="FormName" value="administradores">
		<input type="text" name="nombre" id="nombre" placeholder="Nombre"><br><br>
		<input type="text" name="apellidos" id ="apellidos" placeholder="Apellidos"><br><br>
		<input type="email" name="correo" id = "correo" placeholder="Correo"><br><br>
		<input type="password" name="pwd" id ="pwd">
		<input type="file" name="imagen" id ="imagen">
		<label for="imagen" class="bgcolor-blue5 icon-upload">
			<span>Subir Imagen</span>
		</label><br><br>
		<select name="rol" class="bgcolor-gray4">
			<option value = "0">Seleccionar</option>
			<option value = "1">Administrar</option>
			<option value = "2">Consultar</option>
		</select>
		<br><br>
		<!-- <input type="submit" name="Enviar" onclick="ValidaForm(); return false;"> -->
		<input type="submit"  id="submit" name="Enviar" class="btn2 bgcolor-blue5" value="Registrarse" >
		<label for="submit" class="btn-update bgcolor-blue5 icon-user-check"></label>
	</form>
	</div>
</body>
</html>