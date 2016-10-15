$(document).ready(function(e) {
	$('.ventas').click(function(){
		console.log($(this).val());
		$.ajax({
			type:"POST",
			url:"Controlador/detallesVenta.php",
			data:{ID:$(this).val()},		
			success: function(data){
				console.log(data);
				datos = JSON.parse(data);
				$('#numerov').text( datos.ID_Venta );
				$('#nombrec').text( datos.NombreCliente +' '+ datos.ApellidoP +' '+ datos.ApellidoM );
				$('#fechav').text( datos.FechaVenta );
				$('#totalv').text( datos.TotalVenta );
				$('#tipop').text( datos.TipoPago );
				$('#montoe').text( datos.MontoEfectivo );
				$('#montot').text( datos.MontoTarjeta );
				$('#montom').text( datos.TotalMonedero );
			}
		});
	});
	$('.bye').hide();
	$('#buscaTabla').keyup(function(){
		$.ajax({
			type: "POST",
			url: 'Controlador/detallesVenta2.php?opc=buscar',
			data: {match:$(this).val()},
			success: function(data){
				console.log('holi')
				$('.orig').hide();
				$('.search').show();
				$('.bye').show();
				$('.search').html(data);
				$('.ventas').unbind();
				$('.ventas').bind('click',function(){
					$.ajax({
						type:"POST",
						url:"Controlador/detallesVenta.php",
						data:{ID:$(this).val()},		
						success: function(data){
							datos = JSON.parse(data);
							$('#numerov').text( datos.ID_Venta );
							$('#nombrec').text( datos.NombreCliente +' '+ datos.ApellidoP +' '+ datos.ApellidoM );
							$('#fechav').text( datos.FechaVenta );
							$('#totalv').text( datos.TotalVenta );
							$('#tipop').text( datos.TipoPago );
							$('#montoe').text( datos.MontoEfectivo );
							$('#montot').text( datos.MontoTarjeta );
							$('#montom').text( datos.TotalMonedero );
						}
					});
				});
			}
		});
	});
});