<?php 
session_start();

if(!isset($_SESSION['id']))
{
    header('location:/admin');
}
$title = "Inicio";
 ?>
<!DOCTYPE html>
<html lang="Mx">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="icomoon/style.css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/Chart.js"></script>
	<title>inicio</title>
</head>
<body class="btest bgcolor-blue6">

	<?php
		require 'main-nav-bar.php';
	?>
    
	<div class="row row-top">
		<div class="bgcolor-blue5 welcome"><h1>Bienvenido <?php echo $_SESSION['nombre'];?></h1></div>
		<!-- <div class=" bgcolor-blue3 col-d-12"></div> -->
		<!-- <div class="  bgcolor-blue1 col-d-12"></div> -->
	</div>

	<!-- <div class="alert">
		<p class="alert-text">Mensaje de alerta</p>
	</div> -->
	<!-- <div class="chart-container" style="position: relative; height:20%; width:100vw"> -->
<!-- 	<div class="chart-container d-col-10">
    <canvas id="myChart"></canvas> -->
</div>
<script>
// var ctx = document.getElementById('myChart').getContext('2d');
// var myChart = new Chart(ctx, {
//     type: 'polarArea',
//     data: {
//         labels: ['Red', 'Blue', 'Enero', 'Green', 'Purple', 'Orange','December'],
//         datasets: [{
//             label: 'Ventas',
//             data: [12, 100, 3, 5, 2, 3,54],
//             backgroundColor: [
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(255, 206, 86, 1)',
//                 'rgba(75, 192, 192, 1)',
//                 'rgba(153, 102, 255, 1)',
//                 'rgba(255, 159, 64, 1)'
//             ],
//             borderColor: [
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(255, 206, 86, 1)',
//                 'rgba(75, 192, 192, 1)',
//                 'rgba(153, 102, 255, 1)',
//                 'rgba(255, 159, 64, 1)'
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero: true
//                 }
//             }]
//         }
//     }
// });
</script>
<!--     <div class="modal">
        <div class=" modal-container col-d-8 col-md-2 bgcolor-blue2">   
            <p class="modal-text ">Some Text</p>
            <span class="icon-cross close-modal"></span>        
        </div>
    </div> -->
</body>
</html>