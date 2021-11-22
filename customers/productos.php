<?php 
session_start();
if(!isset($_SESSION['customerid']))
	header("Location:index.php");
	$title = "productos";
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/admin/css/main.css">
    <link rel="stylesheet" type="text/css" href="/admin/icomoon/style.css">
	<script src="/admin/js/jquery-3.4.1.min.js"></script>
	<script src="js/main.js"></script>
	<title>Productos</title>
</head>
<body class="bgcolor-blue6">
	<?php require'customers-nav-bar.php' ?>
	<?php 
		require 'db_connect.php';
		$conn = conecta();
		$query = "SELECT * FROM productos";
		$result = mysqli_query($conn,$query);
		$rows = mysqli_num_rows($result);

	 ?>
	

	<?php $items = 0 ?>
		<div class="row row-top">
						
		</div>
	<?php for ($i = 0; $i <ceil($rows/5) ; $i++){?>

	<div class="row ">
		<div class="col-d-12 product-main-container">
			<?php for ($i = $items; $i<$rows; $i++){  mysqli_data_seek($result,$items); $row = mysqli_fetch_row($result)?>
				<div class="product-container bgcolor-gray4">
						<?php echo $row[0]; ?>
					<div class="img-nav-profile">
						<img src= "../admin/products_img/<?php echo $row[7]; ?>">
					</div>
<!-- 					<div class="icon-product-container bgcolor-blue5">						
						<span>Precio</span>
						<span class="icon-price-tags "></span>				
					 	<span> </span>
					</div> -->
					<div class="icon-product-container bgcolor-blue5">						
						<span>Precio</span><br>
						<span class="icon-coin-dollar "></span>			
					 	<span class="product-text"> <?php echo $row[4]; ?></span>
					</div>
					<div class="icon-product-container bgcolor-blue5">						
						<span>Stock</span><br>
						<span class="icon-stack"></span>				
					 	<span class="product-text" data-id="<?php echo $row[0]; ?>"> <?php echo $row[5]; ?></span>
					</div>
					<div class="btn-add-product bgcolor-blue5" data-id="<?php echo $row[0];?>"> 
						<span class="icon-plus  add-product-icon"></span>
						<span> Agregar al carrito</span>
					</div>
				</div>
			<?php $items++;} ?>
		</div>
	</div>	
	<?php } ?>
</body>
</html>