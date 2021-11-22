<?php 
session_start();
if(!isset($_SESSION['id']))
		header('Location:../index.php');
$title = "Punto de venta";
?>
  <!DOCTYPE html>
 <html>
 <head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../icomoon/style.css">
	<link rel="icon" href="../laundry.ico">
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/main.js"></script>
	<script src="../js/validator.js"></script>
 	<title>Clientes</title>

 </head>
 <body class="bgcolor-blue6">
 	<?php require'sales-nav-bar.php' ?>

<div class="row row-top">
			<a href="list-sales.php">
			<div class="icon-nav-container bgcolor-blue1 col-d-2 ">
				<span class="icon-list2 btn-print"></span>
				<span>Lista de ventas</span>
			</div>
		</a>			
</div>
 	<div class="row">				
		<table class="col-d-3 overall-sales bgcolor-blue2">
 		<h1 class=" overall-sales-title bgcolor-blue5">Detalle de venta</h1>
 			<tr>
 				<td>Cantidad de articulos</td>
 				<td class="cantidad-overall">0</td>
 			</tr>
 			<tr>
 				<td>Total</td>
				<td class="total-overall">$0.00</td>	
 			</tr>
 			<tr>
 				<td>			
 					<div class="pay-button bgcolor-blue5">
						<span class="icon-coin-dollar sales-icon-pay"></span>
						<span>pagar</span>	
					</div>
				</td>
				<td>
				</td>
 			</tr>
 			<tr>
 				<td>
		 			<div class="sales-search">
	 					<input type="text" name="sales-search" id="search" placeholder="Buscar un producto" autocomplete="off">	
		 				<ul class="suggestions bgcolor-blue5 ">		
						</ul>
					</div>
 				</td>
 				<td>
 				</td>
 			</tr>
 			<tr>
 				<td>
		 			<div class="sales-search">
	 					<input type="text" name="sales-search-customer" id="search" placeholder="Buscar Cliente" autocomplete="off">	
		 				<ul class="suggestions-customer bgcolor-blue5 ">		
						</ul>
					</div>
 				</td>
 				<td>
 				</td>
 			</tr>
 			<tr>
 				<td>			
 					<div class="pay-user bgcolor-blue5">
						<span class="icon-user sales-icon-pay"></span>
						<span class="pay-button-text"></span>	
					</div>
				</td>
				<td>
				</td>
 			</tr>
		</table>
		<table class="col-d-9 table-items-sales">
 			<tr class="header-table bgcolor-blue1">
 				<th>Borrar</th>
 				<th>Codigo</th>
 				<th>Nombre del articulo</th>
 				<th>Precio</th>
 				<th>Cantidad</th>
				<th>Total</th>	
 			</tr>
<!--  			<tr data-id="" >
 				<td  data-id=""></td>
 				<td  data-id=""></td>
 				<td  data-id=""></td>
 				<td  data-id="">$0.00</td>
 				<td><input type="number"  name="sales-cantidad" min="1" data-id="" value="1"></td>
 				<td data-id="">$0.00</td>
 			</tr> -->
		</table>
 	</div> 


 
 </body>
 </html>