<?php 
if(!isset($_GET['id']))
	header('Location:index.php');

$id = $_GET['id'];
session_start();
 	require'../db_connect.php';
 	$conn = conecta();
 	$query = "SELECT * FROM clientes WHERE id='$id' ";
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
	<title><?php echo $registro[1]." ".$registro[2]; ?></title>
</head>
<body class="bgcolor-blue6">
<!-- 		<div class=" btn-details bgcolor-blue5">
		
		</div> -->
	<div class="row row-top">
		<div class="col-d-4 col-md-4 bgcolor-gray4 profile-details">
			<a href="customers-list.php"><span class="icon-undo2 btn-details bgcolor-blue5"></span></a>

				<div class="icon-details-container">
					<span class="icon-user icon-details"></span><br><br>
					<span><?php echo $registro[1]." ".$registro[2]; ?></span>
				</div>
				
				<div class="icon-details-container">
					<span class="icon-envelop icon-details"></span><br><br>
					<span><?php echo $registro[3] ?></span>
				</div>

		</div>
	</div>
</body>
</html>