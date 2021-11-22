<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../icomoon/style.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/main.js"></script>
	<title>Registro exitoso</title>
</head>
<?php 
if(!isset($_POST['correo']))
{
	header('Location: ../registro.php');

}
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$file_name = $_FILES['imagen']['name'];
$file_temp = $_FILES['imagen']['tmp_name'];
$file_enc = md5_file($file_temp);
$ext = explode(".",$file_name);
$pwd = $_POST['pwd'];
$pwd_enc = md5($pwd);
$rol = $_POST['rol'];
$dir = "../profile_img/";

/*COPIA EL ARCHIVO*/
	$file_name1 = "$file_enc.$ext[1]";
	copy($file_temp,$dir.$file_name1);

require '../db_connect.php';
$connect = conecta();
	$insert_sql = "INSERT INTO administradores 
	(nombre,apellidos,correo,password,rol,archivo_n,archivo)
	VALUES ('$nombre','$apellidos','$correo',
	'$pwd_enc','$rol','$file_name','$file_name1')";
	mysqli_query($connect,$insert_sql);
?>
<body class="bgcolor-blue2">
	<div class="row row-top">
		<div class="col-d-4 col-md-4 bgcolor-gray1">
			<a href="../users/users-list.php"><span class="icon-enter icon-login" title="iniciar sesion"></span></a>
			<!-- <span></span> -->
			<!-- main container -->
			<div class="profile-container">
				<div class="img-nav-profile">
					<img src= "<?php echo $dir.$file_name1;?> ">
				</div>
				<div class="profile-info">
					<span class="icon-user" title="Nombre de usuario"></span>
					<p><?php echo $nombre." ".$apellidos ?></p><br>
					<span class="icon-mail2 "></span>
					<p><?php echo $correo ?></p><br>
					<span class="icon-tree" title="permisos"></span>
					<p><?php echo ($rol==1)?"Administrar":"Consultar"?></p>
				</div>
			</div>
		</div>
	</div>
	

</body>
</html>