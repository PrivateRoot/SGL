/*declaracion de funciones*/
function alerta(texto,tipo) {
	// el tipo define el color	
	// bi seleccionar un color adecuado puede ocacionar error de ejecucion
	// los colores estan en el css solo se agrega la clase del color
	//alert,success,warning
				$(".alert").append("<p class=\"alert-text\">"+texto+"</p>");
				$(".alert-text").addClass("bgcolor-"+tipo);


				/*this is a one notify type*/
				// $(".alert-text").slideDown(400,function () {
				// 	$(this).delay(2000,).slideUp(400, function() {
				// 		$(this).remove();
				// 	});
				// });


				// $(".alert-text").slideDown(400);
				// 		$(".alert-text").animate({
				// 			left: "0%" 
				// 		},1500, function() {					
				// 		});

				// 		$('.alert').find('p:last').delay(1000,).animate({
				// 			left: "-50%",
				// 			opacity : "0"
				// 		},1500,"swing",function () {
				// 			$(this).remove(); 
						
				// });

			$(".alert-text").fadeIn(600, function() {
				$(this).delay(2000).fadeOut(600, function() {
					$(this).remove();
				});
			});
}
$(document).ready(function(){

$("body").append('<div class=\"alert\"></div>');
//eliminar logico
	$(".btn-eliminar").click(function(){
		var id_u = parseInt($(this).data("id"));
		var tname = $(this).data("t");
		console.log(tname);
		console.log(id_u);
		$("."+id_u.toString()).hide('slow/200', function() {
			
		});
		$.ajax({
			url: '../delete.php',
			type: 'POST',
			dataType: 'JSON',
			data: {id:id_u,action:2,t:tname},
		})
		.done(function(response) {
			console.log(response.status);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
		
	});
	// $(".btn-detalles").click(function(event) {
	// 	var id = $(this).data("id");
		// window.open("adminprofiledetails.php?variable1="+id,"_self");


	//MODAL TEXT
	$("#btn-caja").click(function(event) {
		console.log("clicked");
		$(".modal").fadeIn("fast" );
	});

	$(document).on('click', '.close-modal', function(){ 
		console.log('shet');
		$(".modal").fadeOut( "fast",function () {
			$(this).remove();
		});
		

}); 

	//MODAL ALERT;
	// $("#btn-almacen").click(function(event) {
	// 	$("body").append('<div class=\"modal\"></div>');
	// 	$(".modal").append('<div class=\" modal-container col-d-8 col-md-2 bgcolor-blue2\">');
	// 	$(".modal-container").append('<p class=\"modal-text\">Some Text</p>');
	// 	$(".modal-container").append('<span class=\"icon-cross close-modal\"></span>');
	// 	$(".modal").fadeIn("fast" );


		// <div class=" modal-container col-d-8 col-md-2 bgcolor-blue2">   
  //           <p class="modal-text ">Some Text</p>
  //           <span class="icon-cross close-modal"></span>        
  //       </div>

		// alerta("tersting","success");

 
	// });

	$(".btn-menu").click(function(event) {
		/* Act on the event */
		$(".main-nav").slideToggle(300);
	});

	$("#btn-menu-usuarios").click(function(event) {
		$(".users-main-nav").slideToggle(300);
	});
	$("#btn-close-menu-usuarios").click(function(event) {
		$(".users-main-nav").slideToggle(300);
	});	

	$("#btn-menu-clientes").click(function(event) {
		$(".customers-main-nav").slideToggle(300);
	});
	$("#btn-close-menu-customers").click(function(event) {
		$(".customers-main-nav").slideToggle(300);
	});

	$("#btn-menu-productos").click(function(event) {
		$(".products-main-nav").slideToggle(300);
	});
		$("#btn-close-menu-products").click(function(event) {
		$(".products-main-nav").slideToggle(300);
	});

	// $("#btn-menu-pedidos").click(function(event) {
	// 	$(".pedidos-main-nav").slideToggle(300);
	// });
	// 	$("#btn-close-menu-pedidos").click(function(event) {
	// 	$(".pedidos-main-nav").slideToggle(300);
	// });
	$(".btn-dispatch").click(function(event) {
		/* dispatch */
		var id_pedido  = $(this).data('id');
		console.log(id_pedido);

		$.ajax({
			url: 'update.php',
			type: 'POST',
			dataType: 'JSON',
			data:{id:id_pedido,action:1} ,
		})
		.done(function(status) {
						$("."+id_pedido.toString()).hide('300', function() {
				
			});

			console.log(status);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});
	$(".btn-del-pedido").click(function(event) {
		/* elimina pedido */
		var id_pedido  = $(this).data('id');
		$.ajax({
			url: 'update.php',
			type: 'POST',
			dataType: 'JSON',
			data:{id:id_pedido,action:2},
		})
		.done(function() {
			$("."+id_pedido.toString()).hide('300', function() {
				
			});
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});



});
