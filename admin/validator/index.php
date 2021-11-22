<?php 
	/*VALIDAR CORREO UNICO*/
	

if (!isset($_POST['action'])){
	header('Location:404');
	// header("location:/admin");
}
$action = $_POST['action'];
$mail = $_POST['correo'];
$pwd = $_POST['pwd'];

// /*db conect*/
 require '../db_connect.php';
 $connect = conecta();
// echo json_encode(array($action,$mail));

	switch ($action){
		case 1://comprobar que no exista correo
			/*check if email exist in db*/
			$table = $_POST['table'];
			$query = "SELECT * FROM $table WHERE correo = '$mail'";
			$query_result = mysqli_query($connect,$query);//hace la consulta
			$query_num = mysqli_num_rows($query_result);//numero de filas devuelto 
			$query_cols = mysqli_fetch_array($query_result);

			echo json_encode(array('exist' => $query_num,'id' => $query_cols[0]));
			// echo json_encode(array('id' => $query_cols[0]));
			break;	
		case 2://iniciar session
			//comprueba que exista el usuario, si existe manda a crear la sesion con el id
			//retornara con formato json:
			//0 si el correo no existe
			//1 si se crea lasesion

			$query = "SELECT * FROM administradores WHERE correo = '$mail'";
			$query_result = mysqli_query($connect,$query);//hace la consulta
			$query_num = mysqli_num_rows($query_result);//numero de filas devuelto 

			if($query_num === 1)//si encuentra un registro con el email comprobar el pass
			{
				$reg = mysqli_fetch_array($query_result);
				$pwd_enc = md5($pwd);		

				if($pwd_enc===$reg[4])
				{
					require '../sesion.php';
					echo json_encode(createSesion($reg));

				}
				else
					echo json_encode(array('status' => 0));
			}
			else 
				echo json_encode(array('status' => 0));
			break;	
		case 3://cerrar session
					require '../sesion.php';

			break;
		default:
			echo json_encode("no jala");
			break;
	}

	mysqli_close($connect);

 ?>