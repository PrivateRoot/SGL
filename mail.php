<?php

require 'PHPMailer/src/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
$mail->IsSMTP();
 
//Configuracion servidor mail
$mail->From = "privateroot9908@gmail.com"; //remitente
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls'; //seguridad
$mail->Host = "smtp.gmail.com"; // servidor smtp
$mail->Port = 587; //puerto
$mail->Username ='privateroot9908@gmail.com'; //nombre usuario
$mail->Password = 'PR1V4T3R00T'; //contraseña

//Agregar destinatario
$mail->AddAddress($_POST['ericksanchezpadilla@outlook.com']);
$mail->Subject = $_POST['nel'];
$mail->Body = $_POST['test'];
if ($mail->Send()) {
    echo'<script type="text/javascript">
           alert("Enviado Correctamente");
        </script>';
} else {
    echo'<script type="text/javascript">
           alert("NO ENVIADO, intentar de nuevo");
        </script>';
}
?>
