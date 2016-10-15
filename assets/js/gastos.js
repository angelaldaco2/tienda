$(document).ready(function(e) {
    addGasto=function(){
    	var monto=parseInt($('#monto').val());
		$.ajax({
			type: "POST",
			url: 'Controlador/registrarGasto.php',
			data: {
				desc:$("#desc").val(),
				monto:$('#monto').val()
			},
			success: function(data){
				console.log(data);
				if(data != false){
					alert(data);
				}else{
					$('#alerta').append('<div class="alert alert-success">Gasto agregado Correctamente</div>');
					$("#desc").val("");
					$("#monto").val("");
					var saldo=parseInt($('#elbuensaldo').text());
					saldo=saldo-monto;
					$('#elbuensaldo').text(saldo)

				}
				
			}
		});
	};
	addCaja=function(){
		var sumar = parseInt($('#abono').val());
		$.ajax({
			type: "POST",
			url: 'Controlador/AbonarCaja.php',
			data: {
				totalcaja:$("#totalcaja").val(),
				ID_Corte:$('#ID_Corte').val(),
				abono:$('#abono').val()
			},
			success: function(data){
				console.log(data);
				if(data != false){
					alert(data);
				}else{
					$('#alerta2').append('<div class="alert alert-success">Gasto agregado Correctamente</div>');
					$("#abono").val("")
					saldo=parseInt($('#elbuensaldo').text());
					saldo=saldo+sumar;
					$('#elbuensaldo').text(saldo);
				}
				
			}
		});
	};
});