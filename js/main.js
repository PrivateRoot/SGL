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
$(document).ready(function() {
	$("body").append('<div class=\"alert\"></div>');

	$(".btn-menu").click(function(event) {
		/* Act on the event */
		$(".main-nav").slideToggle(300);
	});

	$("form[name ='login-form']").submit(function(event) {
		console.log('iniciando sesion');
		event.preventDefault();
		if($("input[name='password']").val().length == 0)
		{
			alerta("La contraseña no puede quedar en blanco","warning");
			event.preventDefault();
			return false;
		}
		var email = $("input[name='email']").val();
		var password = $("input[name='password']").val();

		var dat  = {correo:email,pwd:password,action:2};
		$.ajax({
			url: 'validator/',
			type: 'POST',
			dataType: 'JSON',
			data: dat,
		})
		.done(function(data) {
			// if(data.status == 1)
				
			switch (parseInt(data.status)) {
				case 1:
					window.open("productos.php","_self");	
				break;
				case 0:
					alerta("correo o contraseña erroneos","warning")
				break;
				default:
					// statements_def
					break;
			}
			// console.log("success");
			console.log("data r: "+data.status);
		})
		.fail(function() {
			console.log("error");
			// alert("asd");
		})
		.always(function() {
			console.log("complete");
			// alert("asd");
		});
		
	});	
	$(".btn-add-product").click(function(event) {
		var product_id = $(this).data('id');
		var customer_id = $(".nav-profile").data('customerid');
		console.log(product_id);
		console.log(customer_id);


		//comprobar existencia
		$.ajax({
			url: 'admin/sales/search.php',
			type: 'POST',
			dataType: 'JSON',
			data: {action:2,search:product_id},
		})
		.done(function(data) {
			console.log('stock');
			console.log(data.stock);
			if(data.stock > 0){
							$.ajax({
						url: 'update-pedido.php',
						type: 'POST',
						dataType: 'JSON',
						data:{productid:product_id,customerid:customer_id,action:1},
					})
					.done(function(data) {
						console.log(data.status);
						alerta("Agregado al carrito","success");

						var  textStock = parseInt($(".product-text[data-id='"+product_id.toString()+"']").text());
						console.log(textStock);
						$(".product-text[data-id='"+product_id.toString()+"']").text(textStock-1);
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
			}
			else
			{
				alerta("Stock insuficiente","warning");
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		

		// $.ajax({
		// 	url: 'update-pedido.php',
		// 	type: 'POST',
		// 	dataType: 'JSON',
		// 	data:{productid:product_id,customerid:customer_id,action:1},
		// })
		// .done(function(data) {
		// 	console.log(data.status);
		// 	alerta("Agregado al carrito","success");
		// })
		// .fail(function() {
		// 	console.log("error");
		// })
		// .always(function() {
		// 	console.log("complete");
		// });
		
	});
	$(".btn-cart-nav").click(function(event) {
		console.log('carrito');
		var customer_id = $(this).data('customerid');
		console.log(customer_id);

		$.ajax({
			url: 'update-pedido.php',
			type: 'POST',
			dataType: 'JSON',
			data:{customerid:customer_id,action:2},
		})
		.done(function(data) {
			console.log(data.status);

			if(data.status)
				window.open("carrito.php","_self");
			else
				alerta("No tienes productos en tu carrito","alert");

		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});
	//actualiza la cantidad desde el spin box
	$("input[name='sales-cantidad']").change(function(event) {
		console.log($(this).val());
		var cantidad = $(this).val();
		var product_id = $(this).data('id');
		var customer_id = $(".nav-profile").data('customerid');

		//comprobar existencia
		$.ajax({
			url: 'admin/sales/search.php',
			type: 'POST',
			dataType: 'JSON',
			data: {action:2,search:product_id},
			// data: {action:2,search:product_id,},
		})
		.done(function(data) {
			console.log('stock');
			console.log(data.stock);
			if(data.stock > 0){

					$.ajax({
					url: 'update-pedido.php',
					type: 'POST',
					dataType: 'JSON',
					data:{productid:product_id,customerid:customer_id,action:1,cantidad:cantidad},
				})
				.done(function() {
					console.log("actualizado desde detalle carrito");
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				 var price = $("#price[data-id='"+product_id.toString()+"']").text();
				 console.log(price);
				 $("#total[data-id='"+product_id.toString()+"']").text(price*cantidad);
				 var cant_inputs = $("input[name='sales-cantidad']");
				 console.log(cant_inputs.map(function(){return $(this).val();}).get());
				 var cantidades = cant_inputs.map(function(){return $(this).val();}).get();
				var total = 0;

		for(var i = 0;i<cantidades.length;i++)
		{
			console.log(cantidades[i]);
			total += parseInt(cantidades[i]);
		}
		 console.log(total);
		 $("#total-products").text(total);
			}
			else
			{
				$("input[name='sales-cantidad']").val(cantidad-1);
				alerta("Stock insuficiente","warning");
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
		
		
	});
	$(".pay-button").click(function(event) {
		var id_pedido = $(this).data('id');
		console.log("pagas: "+id_pedido.toString());
		var customer_id = $(".nav-profile").data('customerid');

		$.ajax({
			url: 'update-pedido.php',
			type: 'POST',
			dataType: 'JSON',
			data:{id:id_pedido,customerid:customer_id,action:3},
		})
		.done(function(a) {
			console.log(a.status);
		})
		.fail(function() {
			// console.log("error: "+a.status.toString());
			console.log("error: ");
		})
		.always(function() {
			console.log("complete");
		});
		
	});
	$(".btn-del-carrito").click(function(event) {
			var product_id = $(this).data("id");
			console.log(product_id);
			$("tr[data-id='"+product_id.toString()+"']").hide(400, function() {
				
			});

	});	

});