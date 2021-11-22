<?php 

// echo json_encode(array('asd'=> "asd"));

if(!isset($_POST['id']))
{
	header('Location:404');
	exit();
}

// if(isset($_POST['id']))
	$id = $_POST['id'];


// session_start();

$query = "";
$cambios = false;//detecta cambios en la cosulta

/*always*/
$query = "UPDATE productos SET ";

/*Nombre*/
if(isset($_POST['name'])){
	$nombre = $_POST['name'];
	$query.= "nombre = '$nombre'";
	$cambios = true;
}

/*codigo*/
if(isset($_POST['code'])){
	$code = $_POST['code'];
	if($cambios)//si hubo cambios agrega coma
		$query.=",";

	$query.= "codigo = '$code'";
	$cambios = true;

	
}
/*precio*/
if(isset($_POST['price'])){
	$price = $_POST['price'];
	if($cambios)//si hubo cambios agrega coma
		$query.=",";
	$query.="costo = '$price'";
	$cambios = true;
}

/*stock*/
if(isset($_POST['stock'])){
	$stock = $_POST['stock'];
	if($cambios)//si hubo cambios agrega coma
		$query.=",";

	$query.="stock = '$stock'";
	$cambios = true;
}

/*password*/
if (isset($_POST['description'])) {
	$description = $_POST['description'];	
	if($cambios)//si hubo cambios agrega coma
		$query.=",";
	$query.="descripcion = '$description'";
	$cambios = true;			

}
	
//el uso de @ es para evitar warning & notice ya que estos errores nunca ocurriran
if (isset($_FILES['imagen']['name'])){
	$a = $_FILES['imagen']['name'];
	$OldFilename = $_POST['oldfilename'];
	@unlink("../profile_img/".$OldFilename);



	$file_name = $_FILES['imagen']['name'];
	$file_temp = $_FILES['imagen']['tmp_name'];
	$file_enc = @md5_file($file_temp);
	$ext = explode(".",$file_name);
	$dir = "../products_img/";

	$file_name1 = "$file_enc.$ext[1]";
	@copy($file_temp,$dir.$file_name1);
	
	// echo json_encode(array('status' => copy($file_temp,$dir.$file_name1)));
	$query.="archivo_n = '$file_name',archivo = '$file_name1'";
}

@$query.= " WHERE id = '$id'";
/*DO QUERY*/

require '../db_connect.php';
$conn = conecta();

		
	// echo $query;
	if(mysqli_query($conn,$query))
	{
		echo json_encode(array('status' => $query));

	}
	else {
		// echo json_encode(array('status' => $query));
		echo json_encode(array('status' => 'no me quiero ir sr. Stark'));
			
		}			
		mysqli_close($conn);


 ?>