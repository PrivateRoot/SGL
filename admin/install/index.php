<?php 
/*INSTALLER*/
//this can run only one once


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
    <script src="../js/validator.js"></script>
 	<title>Instalacion SGL</title>
</head>
<body class="bgcolor-gray4">
	<div class="row row-top">
		 	<form class="col-d-4 col-md-4 bgcolor-gray4" method="POST" 
			enctype="multipart/form-data" name="reg-form" action="../reg/">

			<h1 class="bgcolor-blue5 icon-cogs icong"><span>  Instalacion</span></h1>
			<!-- <div class=" bgcolor-blue5">
				<span class="icon-cogs icon-form"></span> 
			</div> -->


				<input type="text" name="nombre" id="nombre" placeholder="Nombre"><br><br>
				<input type="text" name="apellidos" id ="apellidos" placeholder="Apellidos"><br><br>
				<input type="email" name="correo" id = "correo" placeholder="Correo"><br><br>
				<input type="password" name="pwd" id ="pwd"><br>
				<input type="file" name="imagen" id ="imagen">
				<label for="imagen" class="bgcolor-blue5 icon-upload">
					<span>Subir Imagen</span>
				</label>
				<select name="rol"   id="autorol">
					<option value = "0" >Seleccionar</option>
					<option value = "1" selected="true">Administrar</option>
					<option value = "2">Consultar</option>
				</select>
				<br><br>
				<!-- <input type="submit" name="Enviar" onclick="ValidaForm(); return false;"> -->
				<input type="submit" id="submit"  name="Enviar" class="btn2 bgcolor-blue5" value="Registrarse" >
				<label for="submit" class="btn-update bgcolor-blue5 icon-user-check"></label>
			</form>
	</div>
</body>
</html>