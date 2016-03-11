$(document).ready(function()
{
	/*
	** Agregar factura iva mediante ajax jquery.
	*/
	var form = $('.create_factura_iva');
	form.bind('submit', function()
	{
		$.ajax({
			type: form.attr('method'),
			url: form.attr('action'),
			data: form.serialize(),
			beforeSend: function(){
                $('.before').append('<img src="assets/img/before.gif" />');
            },
            complete: function(data){
            	
            },
            success: function (data) {	
            	$(".before").hide();
				$(".errors_form").html("");
				$(".success_message").hide().html("");
            	if(data.success == false){
	            	var errores = "";
	            	for(datos in data.errors){
	            		errores += "<div class='alert alert-warning'>";
	            		errores += "<h6><b><i class='fa fa-exclamation-triangle fa-fw'></i> " + data.errors[datos] + "</b></h6>";
	            		errores += "</div>";
	            	}
	            	$(".errors_form").html(errores)
	            }else{
	            	$(form)[0].reset();//limpiamos el formulario
	            	$(".success_message").show().html(data.message)
	            	location.reload();

	            }
            },
            error: function(errors){
            	$(".before").hide();
				$(".errors_form").html("");
            	$(".errors_form").html(errors);
            }
		});
		return false;
	});
	/*
	** Fin Agregar factura iva mediante ajax jquery.
	*/
});
$(document).ready(function(){
	/*
	** Agregar factura islr mediante ajax jquery.
	*/
	var form = $('.create_factura_islr');
	form.bind('submit', function()
	{
		$.ajax({
			type: form.attr('method'),
			url: form.attr('action'),
			data: form.serialize(),
			beforeSend: function(){
                $('.before').append('<img src="assets/img/before.gif" />');
            },
            complete: function(data){
            	
            },
            success: function (data) {	
            	$(".before").hide();
				$(".errors_form").html("");
				$(".success_message").hide().html("");
            	if(data.success == false){
	            	var errores = "";
	            	for(datos in data.errors){
	            		errores += "<div class='alert alert-warning'>";
	            		errores += "<h6><b><i class='fa fa-exclamation-triangle fa-fw'></i> " + data.errors[datos] + "</b></h6>";
	            		errores += "</div>";
	            	}
	            	$(".errors_form").html(errores)
	            }else{
	            	$(form)[0].reset();//limpiamos el formulario
	            	$(".success_message").show().html(data.message)
	            	location.reload();

	            }
            },
            error: function(errors){
            	$(".before").hide();
				$(".errors_form").html("");
            	$(".errors_form").html(errors);
            }
		});
		return false;
	});
});

$(document).ready(function(){
	/*
	*	Agregar reportes de ventas mediante ajax jquery.
	*/
	var form = $('.create_reporte_venta');
	form.bind('submit', function()
	{
		$.ajax({
			type: form.attr('method'),
			url: form.attr('action'),
			data: form.serialize(),
			beforeSend: function(){
                $('.before').append('<img src="assets/img/before.gif" />');
            },
            complete: function(data){
            	
            },
            success: function (data) {	
            	$(".before").hide();
				$(".errors_form").html("");
				$(".success_message").hide().html("");
            	if(data.success == false){
	            	var errores = "";
	            	for(datos in data.errors){
	            		errores += "<div class='alert alert-warning'>";
	            		errores += "<h6><b><i class='fa fa-exclamation-triangle fa-fw'></i> " + data.errors[datos] + "</b></h6>";
	            		errores += "</div>";
	            	}
	            	$(".errors_form").html(errores)
	            }else{
	            	$(form)[0].reset();//limpiamos el formulario
	            	$(".success_message").show().html(data.message)
	            	location.reload();

	            }
            },
            error: function(errors){
            	$(".before").hide();
				$(".errors_form").html("");
            	$(".errors_form").html(errors);
            }
		});
		return false;
	});
});