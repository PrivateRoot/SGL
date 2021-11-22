<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/main.css">
    <link rel="stylesheet" type="text/css" href="../../icomoon/style.css">
    <script src="../../js/jquery-3.4.1.min.js"></script>
    <script src="../../js/main.js"></script>
	<title>Detalles|Registro</title>
</head>
<?php 
/*this page is inaccesible is only for register prevalidated*/
if(!isset($_POST['code']))
{
	header('Location:404');

}
$nombre = $_POST['name'];
$codigo = $_POST['code'];
$descripcion = $_POST['description'];
$price = $_POST['price'];
$stock = $_POST['stock'];

$file_name = $_FILES['imagen']['name'];

$file_temp = $_FILES['imagen']['tmp_name'];
$file_enc = md5($file_temp);
$ext = explode('.',$file_name);
$dir = "../../products_img/";
// echo $file_enc;
/*COPIA EL ARCHIVO*/
	$file_name1 = "$file_enc.$ext[1]";
	copy($file_temp,$dir.$file_name1);

require '../../db_connect.php';
$connect = conecta();
	$insert_sql = "INSERT INTO productos
	(nombre,codigo,descripcion,costo,stock,archivo_n,archivo)
	VALUES ('$nombre','$codigo','$descripcion','$price','$stock','$file_name','$file_name1')";
	 mysqli_query($connect,$insert_sql);
?>
<body class="bgcolor-blue6">
	<div class="row row-top">
		<div class="col-d-4 col-md-4 bgcolor-blue2 create-container">

			<a href="../registro.php">
				<span class="icon-undo2 icon-main-nav  bgcolor-blue5" title="menu usuarios"></span>
			</a>

			<h1 class="bgcolor-blue5 icon-user icong"><span> Registro exitoso</span></h1>
			<!-- <div class="create-container"> -->
				<div class="img-nav-profile">
					<img src= "<?php echo $dir.$file_name1;?> ">
				</div>
				<!-- <div class="profile-info"> -->
					<div class="create-icon" title="Nombre del producto">
						<span class="icon-price-tag bgcolor-blue5" title="Nombre producto"></span>
						<p><?php echo $nombre;?></p>
					</div>
					
					<div class="create-icon" title="descripcion">
						<span class="icon-list bgcolor-blue5"></span>
						<p><?php echo $descripcion?></p>
					</div>
					
					<div class="create-icon" title="Codigo de producto">
						<span class="icon-barcode bgcolor-blue5"></span>
						<p><?php echo $codigo?></p>
					</div>

					<div class="create-icon" title="Precio">
						<span class="icon-coin-dollar bgcolor-blue5"></span>
						<p><?php echo $price?></p>
					</div>
					<div class="create-icon" title="Stock">
						<span class="icon-stack bgcolor-blue5"></span>
						<p><?php echo $stock?></p>
					</div>
				<!-- </div> -->
			<!-- </div> -->
		</div>
	</div>
	

</body>
</html>