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
if(!isset($_POST['correo']))
{
	header('Location:404');

}
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$pwd = $_POST['pwd'];
$pwd_enc = md5($pwd);

require '../../db_connect.php';
$connect = conecta();
	$insert_sql = "INSERT INTO clientes 
	(nombre,apellidos,correo,password)
	VALUES ('$nombre','$apellidos','$correo','$pwd_enc')";
	 mysqli_query($connect,$insert_sql);
?>
<body class="bgcolor-blue2">
	<div class="row row-top">
		<div class="col-d-4 col-md-4 bgcolor-gray1">

			<a href="../">
			<span class="icon-undo2 icon-main-nav  bgcolor-blue5" title="menu usuarios"></span>
			</a>

			<h1 class="bgcolor-blue5 icon-user icong"><span> Registro exitoso</span></h1>
			<div class="profile-container">
				<div class="profile-info">
					<span class="icon-user" title="Nombre de usuario"></span>
					<p><?php echo $nombre." ".$apellidos ?></p><br>
					<span class="icon-mail2 "></span>
					<p><?php echo $correo ?></p><br>
				</div>
			</div>
		</div>
	</div>
	

</body>
</html>