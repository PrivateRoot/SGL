<?php 
session_start();
if(!isset($_SESSION['id']))
	header('Location:index.php'); 
$id = $_GET['id'];

	require'../db_connect.php';
 	$conn = conecta();

 	$query = "SELECT * FROM productos WHERE id='$id' ";
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
    <title>Editar producto</title>
</head>
<body class="bgcolor-blue6">
    <div class="row row-top">
	<form class="col-d-4 col-md-4 bgcolor-gray4" method="POST" 
	enctype="multipart/form-data" name="update-form-products" action="">

		<a href="products-list.php"><span class="icon-undo2 btn-details bgcolor-blue5"></span></a>
		<h1 class="bgcolor-blue5 icon-user icong"><span>  Editar Produtco</span></h1>
		<p>*solo se actualizan los campos llenados</p><br>
		
		<input type="hidden" name="FormName" value="products">
		<input type="hidden" name="id" value="<?php echo $registro[0]; ?>">
		<input type="hidden" name="oldfilename" value="<?php echo $registro[7];?>">
		<!-- <span class="icon-price-tag icon-details bgcolor-blue5"></span> -->
		<input type="text" name="name" id="name" placeholder="<?php echo $registro[1];?>"><br><br>
		<input type="number" name="code" id ="code" placeholder="<?php echo $registro[2];?>"><br><br>
		<input type="number" name="price" id="price" placeholder="<?php echo $registro[4];?>" min="1">
		<input type="number" name="stock" id="stock" placeholder="<?php echo $registro[5];?>" min="1"><br><br>
		<textarea name="description" id="descripcion" cols="30" rows="10" placeholder="<?php echo $registro[3];?>"></textarea><br>
		<input type="file" name="imagen" id ="imagen">
		<label for="imagen" class="bgcolor-blue5 icon-upload">
			<span >Subir Imagen</span>
		</label><br>
		<input type="submit" id="submit" name="Enviar" value="Registrarse" >
		<label for="submit" class="btn-update bgcolor-blue5 icon-user-check"></label>

	</form>
	</div>
</body>
</html>