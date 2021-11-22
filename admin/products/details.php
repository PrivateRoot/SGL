<?php 
// session_start();
$id = $_GET['id'];
if(!isset($id)){
	header('Location:products-list.php');
}
 ?>
 <?php 
 	require'../db_connect.php';
 	$conn = conecta();
 	$query = "SELECT * FROM productos WHERE id='$id' ";
 	$result = mysqli_query($conn,$query);
 	$registro = mysqli_fetch_array($result);
 	// $rowCount = mysqli_num_rows($resuslt);

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
	<title></title>
</head>
<body class="bgcolor-blue6">
<!-- 		<div class=" btn-details bgcolor-blue5">
		
		</div> -->
	<div class="row row-top">
		<div class="col-d-4 col-md-4 bgcolor-gray4 details-container">
			<a href="products-list.php"><span class="icon-undo2 btn-details bgcolor-blue5"></span></a>
			<!-- <div class="profile-details"> -->
				<div class="img-nav-profile">
					<img src= "../products_img/<?php echo $registro[7];?> ">
				</div>

<!-- 				<div class="profile-info-detail" -->
					<div class="icon-details-container">
						<span class="icon-price-tag icon-details bgcolor-blue5"></span>
						<span>Nombre</span><br><br>
						<span class="details-text"><?php echo $registro[1];?></span>
					</div>
					
					<div class="icon-details-container">
						<span class="icon-barcode icon-details bgcolor-blue5"></span>
						<span>Codigo</span><br><br>
						<span><?php echo $registro[2] ?></span>
					</div>

					<div class="icon-details-container">
						<span class="icon-list2 icon-details bgcolor-blue5"></span>
						<span>Descripcion</span><br><br>
						<span><?php echo $registro[3];?></span>
					</div>

					<div class="icon-details-container">
						<span class="icon-coin-dollar icon-details bgcolor-blue5"></span>
						<span>Precio</span><br><br>
						<span><?php echo $registro[4];?></span>
					</div>					
					<div class="icon-details-container">
						<span class="icon-stack icon-details bgcolor-blue5"></span>
						<span>Stock</span><br><br>
						<span><?php echo $registro[5];?></span>
					</div>
				<!-- </div> -->
		</div>
	</div>
</body>
</html>
