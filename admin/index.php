<?php 
// only for first run
// require'db_connect.php';
// $conn = conecta();
session_start();
if(isset($_SESSION['id']))
		header('Location: inicio.php');

?>
<!DOCTYPE html>
<html lang="Mx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="icomoon/style.css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/validator.js"></script>
    <title>Iniciar sesion</title>
</head>
<body class="bgcolor-blue6">
    <div class="row row-top">
	        <form class="col-d-4 col-md-4 bgcolor-gray4" method="POST" action="" name="login-form">
	        	<h1 class="bgcolor-blue5 icon-rocket icong"><span>  Iniciar sesion</span></h1>

	        	<label><span class="icon-user icong"></span></label>
	            <input type="email" name="email" placeholder="ejemplo@dominio.com" autocomplete="username"><br>
	            <label><span class="icon-key icong"></span></label>
	            <input type="password" name="password"><br><br>
	            <input type="submit" id="submit" name="enviar" value="" class="btn2 bgcolor-blue5">
	            <label for="submit"  class="btn2 bgcolor-blue5 icon-enter">
	            	<span> Iniciar session</span>
	            </label>
	        </form>
	</div>
</body>
</html>