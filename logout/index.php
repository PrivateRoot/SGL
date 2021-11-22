<?php 
	session_start();

	if(isset($_SESSION['customerid'])){
		session_destroy();
		header('location:../');
	}
?>