$(document).ready(function(e) {
    addSaldo=function(){
		$.ajax({
			type: "POST",
			url: 'Controlador/abonarCaja.php',
			data: {
				ID_Corte:$('[name=ID_Corte]').val(),
					monto:$('[name=abono]').val(),
					totalcaja:$('[name=saldoCaja]').val()
			},
			success: function(data){
				console.log(ID_Corte);
				if(data != false){
					alert(data);
				}else{
					$('#alerta2').append('<div class="alert alert-success">Gasto agregado Correctamente</div>');
					$("#abono").val("")
				}
				
			}
		});
	};
});


$(document).ready(function(e){
	abonoCaja=function(){	
		if ($('[name=abono]').val()>0){
			$.ajax({
				type: "POST",
				url: 'Controlador/abonarCaja.php',
				data: {
					ID_Corte:$('[name=ID_Corte]').val(),
					monto:$('[name=abono]').val(),
					totalcaja:$('[name=saldoCaja]').val()
				},
				success: function(data){
					console.log(data);
					if(data != false){
						$('[name=monto]').val('');
						$('[name=totalcaja]').val(data);
						$('[name=monto]').focus();
					}
				}
			});
		}
		else{
			alert('INGRESA UN NUMERO VALIDO');
		}
	};

	$('.cortar').on('click',function(){
		if( confirm('¿Los datos son correctos?')){
			if( ($('#retiro').val() > 0) && (parseInt($('#elbuensaldo').text()) >= $('#retiro').val()) ){
				$.ajax({
					url:'Controlador/hacerCorte.php',
					type:'post',
					data:{
						cantidad:$('#retiro').val()
					},
					success: function(data){
						datos = JSON.parse(data);
						if(datos.error){
							alert(datos.error);
						}
						else{
							datos.mensaje;
							$('#corte').modal('hide');
						}
					}
				});
			}else{
				alert('La cantidad no es correcta');
			}
		}
	});
});
