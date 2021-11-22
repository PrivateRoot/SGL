$(document).ready(function(){

	var extPermitidas = /(.jpg)$/i;

	$("form[name ='reg-form']").submit(function(event) {
		// event.preventDefault();
		var cont=null;
		var user = $("input[name='nombre']").val();
		var apellido = $("input[name='apellidos']").val();
		var correo = $("input[name='correo']").val();
		var file = $("input[name='imagen']").val();
		var pwd = $("input[name='pwd']").val();
		var seleccion =  $("select[name='rol']").val();
		var form = $("input[name ='FormName']").val();

		if(user == null || user.length == 0)
			{
				alerta("Ingresa usuario","alert");
				event.preventDefault(); /*cancel submit*/
				return false;
			}
		if(apellido == null || apellido.length == 0)
			{
				alerta("Ingresa apellido","alert");
				event.preventDefault(); /*cancel submit*/
				return false;
			}
		if(pwd == null || pwd.length < 8)
		{
		
				alerta("ingresa contraseña de 8 caracteres o más","alert");
				event.preventDefault(); /*cancel submit*/
				return false;
		}
		if(seleccion == 0)
		{
				alerta("Selecciona un rol","alert");
				event.preventDefault(); /*cancel submit*/
				return false;
		}
		if(!file || !extPermitidas.exec(file))
		{
				if(form == "administradores"){
				alerta("Inserta una imagen valida","alert");
				event.preventDefault(); /*cancel submit*/
				return false;

				}
		}
		if(correo == null || correo.length <= 1)
		{
				alerta("Ingresa correo","alert");
				event.preventDefault(); /*cancel submit*/
				return false;
		}
		else {
			var tname = $(this).data("t");
			var dat;
			cont = $.ajax({
				url: "../validator/",
				async: false, 
				method:'POST',
				dataType: 'JSON',
				data: {action:1,correo:correo,table:form},
			})
			.done(function(data){
				// console.log(data);
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				// console.log("complete");
			});
			
			return cont.done(function(data){
				if(data.exist > 0){
					alerta("Este correo ya existe","alert");
					console.log("Success"+data.exist);
					event.preventDefault();
					return false;
				}
				// event.preventDefault();
				return true;
			});		
		}
		console.log('Form succes');
	});
	$("input[name='imagen']").change(function(event) {
			var fileName = event.target.files[0].name;
			if(!extPermitidas.exec(fileName)){
				alerta("Inserta una imagen valida","alert");
				console.log(fileName);
				console.log('cambio');
				/*added after*/


			}
	});
	/*UPDATE FORM users*/
	/*DETECT IF IS EDITED*/
	$("form[name='update-form']").submit(function(event) {
		var user = $("input[name='nombre']").val();
		var apellido = $("input[name='apellidos']").val();
		var correo = $("input[name='correo']").val();
		var file = $("input[name='imagen']").val();
		var pwd = $("input[name='pwd']").val();
		var seleccion =  $("select[name='rol']").val();
		var idReg = $("input[name='id']").val();
		var form = $("input[name ='FormName']").val();
		var formData = new FormData();

		if(user != null && user.length > 0)
		{
			formData.append('nombre',user);
		}
		if(apellido != null && apellido.length > 0)
		{
			formData.append('apellido',apellido);	
		}
		if(pwd !=null && pwd.length >8)
		{
			formData.append('pwd',pwd);
		}
		else
		{
			alerta("La contraseña minima es de 8 caracteres","warning");
			$("input[name='pwd']").val("");
		}
		$("select[name='rol']").change(function(event) {
			console.log('rol changed an added to FormData object');
			formData.append('rol',seleccion);
		});
		if(correo != null && correo.length > 0)
		{
			var tname = $(this).data("t");
			cont = $.ajax({
				url: "../validator/",
				async: false, 
				method:'POST',
				dataType: 'JSON',
				data: {action:1,correo:correo,table:tname},
			})
			.done(function(data){
				// console.log(data);
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				// console.log("complete");
			});
			 
				cont.done(function(data){
				// console.log("Success: "+data.id);
				if(data.exist){
					if (data.id != idReg) {
					
					/*esto se cumple cuando se ingresa un correo que ya esta en la base 
					de datos pero excluyendo el correo de este registro */
					alerta("Este correo ya esta registrado","alert");
					console.log("Success"+data.id);
					event.preventDefault();
					// return false;

					}
					else
					{
						alerta("Este es tu correo actualmente","alert");	
						event.preventDefault();
						// return false;
					}
				}
				console.log('is a new mail');
				formData.append('correo',correo);
			});	
		}
		if(file && !extPermitidas.exec(file))
		{
				console.log('no valid img');
				alerta("Inserta una imagen valida","alert");
				event.preventDefault(); /*cancel submit*/
				return false;
		}
		if(file && extPermitidas.exec(file))//si es una imagen con formato valido la agregamos al form data
		{
			console.log('valid img');
			console.log('is a new profile picture');
			var file = $("input[type='file']").prop("files");

			console.log(file.length);
			formData.append('imagen',file[0]);
			var oldfile = $("input[name='oldfilename']").val();
			formData.append('oldfilename',oldfile);
					
		}
		console.log(formData);
		/*COUNT ITEMS APENDED TO FORMDATA OBJECT*/
		var fieldsToUpdate = 0;
		for (var pair of formData.entries()) {
			fieldsToUpdate ++;
    		console.log(pair[0]+ ', ' + pair[1]); 
    	}

    	if(fieldsToUpdate == 0)
    	{
    		console.log('no hay nada para actualizar');
    		event.preventDefault();
    	}
    	else{
    	console.log('fields to update: ' + fieldsToUpdate.toString());
    		formData.append('id',idReg);
    		console.log(idReg);
		/*updater*/
		$.ajax({
			url: "../users/update.php",
			type: 'POST',
			dataType: 'JSON',
			cache: false,
  		 	contentType: false,
  		 	processData: false,
			data: formData,
			// data:{as:'asd'},
		})
		.done(function(data) {
			console.log("success: "+ data.status);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});

    	}
		
		
	});
	/*UPDATE CUSTOMER*/
	$("form[name='update-form-customers']").submit(function(event) {
		var user = $("input[name='nombre']").val();
		var apellido = $("input[name='apellidos']").val();
		var correo = $("input[name='correo']").val();
		var pwd = $("input[name='pwd']").val();
		var idReg = $("input[name='id']").val();
		var form = $("input[name ='FormName']").val();
		var formData = new FormData();
		console.log(user);

		if(user != null && user.length > 0)
		{
			formData.append('nombre',user);
		}
		if(apellido != null && apellido.length > 0)
		{
			formData.append('apellido',apellido);	
		}
		if(pwd !=null && pwd.length > 8)
		{
			formData.append('pwd',pwd);
		}
		else if(pwd.length > 0 & pwd.length < 8)
		{
			console.log('updating pwd customer');
			alerta("La contraseña minima es de 8 caracteres","warning");
			$("input[name='pwd']").val("");
		}
		$("select[name='rol']").change(function(event) {
			console.log('rol changed an added to FormData object');
			formData.append('rol',seleccion);
		});
		if(correo != null && correo.length > 0)
		{
			var tname = $(this).data("t");
			cont = $.ajax({
				url: "../validator/",
				async: false, 
				method:'POST',
				dataType: 'JSON',
				data: {action:1,correo:correo,table:tname},
			})
			.done(function(data){
				// console.log(data);
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				// console.log("complete");
			});
			 
				cont.done(function(data){
				// console.log("Success: "+data.id);
				if(data.exist){
					if (data.id != idReg) {
					
					/*esto se cumple cuando se ingresa un correo que ya esta en la base 
					de datos pero excluyendo el correo de este registro */
					alerta("Este correo ya esta registrado","alert");
					console.log("Success"+data.id);
					event.preventDefault();
					// return false;

					}
					else
					{
						alerta("Este es tu correo actualmente","alert");	
						event.preventDefault();
						// return false;
					}
				}
				console.log('is a new mail');
				formData.append('correo',correo);
			});	
		}
		console.log(formData);
		/*COUNT ITEMS APENDED TO FORMDATA OBJECT*/
		var fieldsToUpdate = 0;
		for (var pair of formData.entries()) {
			fieldsToUpdate ++;
    		console.log(pair[0]+ ', ' + pair[1]); 
    	}

    	if(fieldsToUpdate == 0)
    	{
    		console.log('no hay nada para actualizar');
    		event.preventDefault();
    	}
    	else{
    	console.log('fields to update: ' + fieldsToUpdate.toString());
    		formData.append('id',idReg);
    		console.log(idReg);
		/*updater*/
		$.ajax({
			url: "../customers/update.php",
			type: 'POST',
			dataType: 'JSON',
			cache: false,
  		 	contentType: false,
  		 	processData: false,
			data: formData,
			// data:{as:'asd'},
		})
		.done(function(data) {
			console.log("success: "+ data.status);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});

    	}
	});

/*Loging form*/
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
					window.open("inicio.php","_self");	
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
	/*FORMULARIO DE REGISTRO DE PRODUCTOS*/
	$("form[name='reg-form-products']").submit(function(event) {
		var nombre = $("input[name='name']").val();
		var codigo = $("input[name='code']").val();
		var price = $("input[name='price']").val();
		var stock = $("input[name='stock']").val();
		var descripcion = $("textarea[name='description']").val();
		var file = $("input[name='imagen']").val();

		if(nombre == null || nombre.length == 0){
			alerta("Inserta un nombre","alert");
			event.preventDefault();
		}
		if(codigo == null || codigo.length == 0){
			alerta("Inserta un codigo","alert");
			event.preventDefault();
		}
		else{
		var val = $.ajax({
				async:false,
				url: 'dml.php',
				type: 'POST',
				dataType: 'JSON',
				data: {action:1,code:codigo},
			})
			.done(function(data) {

			})
			.fail(function() {
				console.log("errors");
			})
			.always(function() {
				console.log("completes");
			});

			return val.done(function (data) {
				if (data.status == true) {
					event.preventDefault();
					console.log("success");
					console.log('existe');
					alerta("Este codigo ya existe","warning");
					return false;
				}
				else
					console.log('no existe');
			});
			
		}
		if(price < 0){
			alerta("Inserta un precio valido","alert");
			event.preventDefault();
		}
		if(stock < 0){
			alerta("El stock no puede ser negativo","alert");
			event.preventDefault();
		}
		if(descripcion == null || descripcion.length == 0){
			alerta("Inserta una descripcion","alert");
			event.preventDefault();
		}
		if(!file  || !extPermitidas.exec(file)){
			alerta("Inserta una imagen valida","alert");
			event.preventDefault();
		}
		console.log('se hace');
			// event.preventDefault();

	});
	/*FORMULARIO DE ACTUALIZACION DE PRODUCTOS*/
	$("form[name='update-form-products']").submit(function(event) {
		var nombre = $("input[name='name']").val();
		var codigo = $("input[name='code']").val();
		var price = $("input[name='price']").val();
		var stock = $("input[name='stock']").val();
		var descripcion = $("textarea[name='description']").val();
		var file = $("input[name='imagen']").val();
		var idReg = $("input[name='id']").val();
		var formData = new FormData();

		if(nombre != null && nombre.length > 0){
			formData.append('name',nombre);
		}
		if(codigo != null && codigo.length > 0){
		var val = $.ajax({
				async:false,
				url: 'dml.php',
				type: 'POST',
				dataType: 'JSON',
				data: {action:1,code:codigo},
			})
			.done(function(data) {

			})
			.fail(function() {
				console.log("errors");
			})
			.always(function() {
				console.log("completes");
			});

			 val.done(function (data) {
				if (data.status == true) {
					event.preventDefault();
					console.log("success");
					console.log('existe');
					alerta("Este codigo ya existe","warning");
					// return false;
				}
				else{
					console.log('no existe');
					formData.append('code',codigo);
				}

			});
			
		}
		if(price > 0){
			formData.append('price',price);
		}
		if(stock > 0){
			formData.append('stock',stock);			
		}
		if(descripcion != null && descripcion.length > 0){
			formData.append('description',descripcion);
		}
		if(file && extPermitidas.exec(file))//si es una imagen con formato valido la agregamos al form data
		{
			console.log('valid img');
			console.log('is a new profile picture');
			var file = $("input[type='file']").prop("files");

			console.log(file.length);
			formData.append('imagen',file[0]);
			var oldfile = $("input[name='oldfilename']").val();
			formData.append('oldfilename',oldfile);
					
		}
		var fieldsToUpdate = 0;
		for (var pair of formData.entries()) {
			fieldsToUpdate ++;
    		console.log(pair[0]+ ', ' + pair[1]); 
    	}
    	if(fieldsToUpdate == 0)
    	{
    		console.log('no hay nada para actualizar');
    		event.preventDefault();
    	}
    	else{
    	console.log('fields to update: ' + fieldsToUpdate.toString());
    		formData.append('id',idReg);
    		console.log(idReg);
		/*updater*/
		$.ajax({
			url: "../products/update.php",
			type: 'POST',
			dataType: 'JSON',
			cache: false,
  		 	contentType: false,
  		 	processData: false,
			data: formData,
			// data:{as:'asd'},
		})
		.done(function(data) {
			console.log("success: "+ data.status);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});

    	}
	});
	/*MODULO VENTAS*/
	$("input[name='sales-search']").keyup(function(event) {
		var search = $("input[name='sales-search']").val();


		if(search.length == 0)
		$(".item-suggestion").remove();
		// 	$(".suggestions").slideToggle(250, function(){});	


		if(search.length > 0){
			var val = $.ajax({
				url: '../sales/search.php',
				type: 'POST',
				dataType: 'JSON',
				data: {'search':search,action:1},
			})
			.done(function(data) {
				// console.log(data);
				console.log("success");
			})
			.fail(function() {
				// console.log("error");
			})
			.always(function() {
				// console.log("complete");
			});

			val.done(function (response){
				if(response.length > 0)
				// 	console.log('si hay');
				// console.log(response[0].row);
				var name;
				$(".item-suggestion").remove();
				for(var i = 0;i<response.length;i++)
				{
					name = response[i].row.nombre;
					$(".suggestions").append("<li class=\"item-suggestion\" data-id=\""+response[i].row.id+"\" tabindex=\"1\">"+name+"</li>");
				}
				$(".suggestions").slideDown(300, function() {
						
				});

			})
		}
		
	});
	//cierra sugerencias de productos
	$(".suggestions").mouseleave(function(event) {
			$(".suggestions").slideUp(250, function() {
				$(".item-suggestion").remove();
			});
			$("input[name='sales-search']").val("");
	});

	/*AGREGAR PRODUCTOS A LA COMPRA*/
	$(document).on('click','.item-suggestion',function(event) {
		var  id = $(this).data("id");
		// console.log('id: '+id.toString());

		var item = $("tr[data-id=\""+id+"\"]");
		// console.log(item.data('id'));

		// TOTAL PRODUCTOS +1
		// var totalItems = $(".cantidad-overall").text();
		// $(".cantidad-overall").text(parseInt(totalItems)+1);

		var stock = 0;//variable para el stock in db


		if (!item.data('id')) {
			//si el id no existe se agrega por primera vez a la lista 
			// console.log("thihs id not exist");
		$.ajax({
			url: 'search.php',
			type: 'POST',
			dataType: 'JSON',
			data: {search:id,action:2},
		})
		.done(function(data){
			stock = parseInt(data.stock);
			if(stock>0){

				var totalItems = $(".cantidad-overall").text();
				$(".cantidad-overall").text(parseInt(totalItems)+1);


				var row = "<tr data-id=\""+id+"\"><td data-id=\""+id+"\"><span class=\"icon-bin btn-table bgcolor-blue5 del-prod-sale\" data-id=\""+id+"\"></span></td><td class=\"code\" data-id=\""+id+"\"></td><td class=\"name\" data-id=\""+id+"\"></td><td class=\"price\" data-id=\""+id+"\">$0.00</td><td><input type=\"number\"  name=\"sales-cantidad\" min=\"1\" class=\"cant\" data-id=\""+id+"\" value=\"1\"></td><td class=\"total\" data-id=\""+id+"\">$0.00</td></tr>";
				$(".table-items-sales").append(row);
				$(".name[data-id=\""+id+"\"]").text(data.nombre);
				$(".code[data-id=\""+id+"\"]").text(data.codigo);
				$(".price[data-id=\""+id+"\"]").text(data.costo);
				$(".total[data-id=\""+id+"\"]").text(data.costo);
				console.log("success");
				var  totals = $(".total");
				var total = 0;
				for(var i = 0;i < totals.length; i++){
				// console.log(totals[i]);
				total += parseFloat($(totals[i]).text());
				// console.log("total:" + total.toString());
				$(".total-overall").text("$ "+total.toString());
				}
			}
			else{
				alerta("No hay suficiente stock","warning");
			}

		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});

		}
		else{
			//si ya existe revisar con ajax cuanto tiene en la bd y si lo que tengo en la lista
			//es menor a lo de la bd permito permito agregar si es igual no
			
			$.ajax({
				url: 'search.php',
				type: 'POST',
				dataType: 'JSON',
				data: {search:id,action:2},
			})
			.done(function(data) {
				stock = parseInt(data.stock);
				// console.log("stock: "+data.stock);
				// console.log('this id exist');
				// console.log(stock);
				var val = parseInt($(".cant[data-id=\""+id+"\"]").val(), 10);
				if(val < stock){
					$(".cant[data-id=\""+id+"\"]").val(val+1).change();
				}
				else{
					alerta("No hay suficiente stock","warning")
				}

			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			

		}
		
	});
	$(document).on('change','.cant',function(event) {
		// console.log('more');
		var  id = $(this).data("id");
		var cant = $(this).val();
		$.ajax({
				url: 'search.php',
				type: 'POST',
				dataType: 'JSON',
				data: {search:id,action:2},
			})
			.done(function(data) {
				stock = parseInt(data.stock);

				var val = parseInt($(".cant[data-id=\""+id+"\"]").val(), 10);

				if(val <= stock){

					var totalItems = $(".cantidad-overall").text();
					$(".cantidad-overall").text(parseInt(totalItems)+1);

					var total = $(".price[data-id=\""+id+"\"]").text()*cant;

					$(".total[data-id=\""+id+"\"]").text(total);
					var  totals = $(".total");
					var total = 0;
					for(var i = 0;i < totals.length; i++){
					// console.log(totals[i]);
					total += parseFloat($(totals[i]).text());
					console.log("total:" + total.toString());
					}
					$(".total-overall").text("$ "+total.toString());
				}
				else{
					$(".cant[data-id=\""+id+"\"]").val(stock);
					alerta("No hay suficiente stock","warning")
				}

			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
	});

	$(document).on('click','.del-prod-sale',function(event) {
		var id = $(".del-prod-sale").data('id');
		console.log(id);

		$("tr[data-id='"+id.toString()+"']").hide(350, function() {
			$(this).remove();
		});
	});
	/*BOTON PARA PAGAR*/
	$(".pay-button").click(function(event) {
		console.log('pagar punto de venta');
		var  total = $(".total").text();
		var customer = $(".pay-button-text").data('id');

		if(total <= 0 ){
			alerta("No hay productos","alert");
			return false;
		}
		// if(!customer){
		// 	alerta("Agrega un cliente a la venta","alert");
		// 	return false;
		// }
		var productos = $(".cant");
		var productsJson=[];
		for(var k = 0; k < productos.length; k++){
			productsJson[k] = {id:$(productos[k]).data('id'),cantidad:$(productos[k]).val()}
		}
		// console.log(productos);
		// console.log(productsJson);

		var user = $(".nav-profile").data('id');
		var customer = $(".pay-button-text").data('id');
		
		var completeSale = {user:user,customer:customer,products:productsJson};
		// console.log(customer);
		// console.log(completeSale);
		var r = $.ajax({
			url: 'complete.php',
			type: 'POST',
			dataType: 'JSON',
			data: completeSale,
		})
		.done(function(data) {
			console.log(data.response);
			console.log(data.id);
			// r = data.response;
			var id = data.id.toString();
			window.open("../sales/details.php?id="+id,"_blank");
			window.open("../sales/","_self");
				
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});

			// return r;

	});

	/*BUSCADOR PARA USUARIOS*/
	$("input[name='sales-search-customer']").keyup(function(event) {
		// console.log('tiping');

		var search = $("input[name='sales-search-customer']").val();


		//clear suggestions
		console.log(search.length);
		
		if(search.length == 0)
		{
			$(".item-suggestion-customer").remove();
			$(".suggestions-customer").slideUp(250, function() {
			});	
		// console.log('ta vacio');
		}	

		if(search.length > 0){
			console.log('a por ajax');
			var val = $.ajax({
				url: '../customers/search.php',
				type: 'POST',
				dataType: 'JSON',
				data: {'search':search,action:1},
			})
			.done(function(data) {
				// console.log(data);
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});

			val.done(function (response){
				if(response.length > 0)
				// 	console.log('si hay');
				console.log(response[0].row);
				var name;
				$(".item-suggestion-customer").remove();
				for(var i = 0;i<response.length;i++)
				{
					name = response[i].row.nombre;
					$(".suggestions-customer").append("<li class=\"item-suggestion-customer\" data-id=\""+response[i].row.id+"\" tabindex=\"-1\">"+name+"</li>");
				}
				$(".suggestions-customer").slideDown(300, function() {
						
				});

			})
		}
		
	});
	$(".sales-search").mouseleave(function(event) {
			$(".suggestions-customer").slideUp(250, function() {
				$(".item-suggestion-customer").remove();
			});
			$("input[name='sales-search-customer']").val("");
	});

	$(document).on('click','.item-suggestion-customer',function(event) {
		var  id = $(this).data("id");
		console.log('id: '+id.toString());

		$.ajax({
			url: '../customers/search.php',
			type: 'POST',
			dataType: 'JSON',
			data: {search:id,action:2},
		})
		.done(function(data){
			console.log(data.id);
		$(".pay-button-text").text(data.nombre);
		$(".pay-button-text").data('id',id);
	// var row = "<tr><td><div class=\"pay-button bgcolor-blue5\"><span class=\"icon-user sales-icon-pay\"></span><span></span>	</div></td><td></td></tr>";
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



