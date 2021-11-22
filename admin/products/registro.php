<?php 
	session_start();
	if(!isset($_SESSION['id'])) 
		header("Location:404");
	$title = "Agregar Producto";
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
    <title>Agregar Producto</title>
</head>
<body class="bgcolor-blue6">
	<?php
	/*Mostrar la barra solo si la session esta activa*/
	if(isset($_SESSION['id']))
		require 'products-nav-bar.php';
	?>
    <div class="row row-top">
	<form class="col-d-4 col-md-4 bgcolor-gray4" method="POST" 
	enctype="multipart/form-data" name="reg-form-products" action="create/">

		<h1 class="bgcolor-blue5 icon-price-tags icong"><span>Agregar Producto</span></h1>
		
		<input type="text" name="name" id="name" placeholder="Nombre"><br><br>
		<input type="number" name="code" id ="code" placeholder="Codigo" autocomplete="new" min="1"><br><br>
		<input type="number" name="price" id="price" placeholder="precio" min="1" step="0.01">
		<input type="number" name="stock" id="stock" placeholder="stock" min="1"><br><br>
		<textarea name="description" id="descripcion" cols="30" rows="10" placeholder="Descripcion del producto"></textarea><br>
		<input type="file" name="imagen" id ="imagen">
		<label for="imagen" class="bgcolor-blue5 icon-upload">
			<span >Subir Imagen</span>
		</label><br>
		<input type="submit" id="submit" name="Enviar" value="Registrarse" >
		<label for="submit" class="btn-update bgcolor-blue5 icon-plus"></label>
	</form>
	</div>
</body>
</html>