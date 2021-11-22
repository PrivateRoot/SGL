<?php
 session_start();
 if(!isset($_SESSION['id']))
	header('Location:index.php');
	$title = "Usuarios";
 ?>
 <!DOCTYPE html>
 <html>
 <head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../icomoon/style.css">
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/main.js"></script>
 	<title>Usuarios</title>
 </head>
 <body class="bgcolor-blue6">
 	<?php require 'users-nav-bar.php'; ?>
 
 </body>
 </html>