$(document).ready(function(e) {
	//$(document).tooltip({track:true});
	$('.productos').click(function(){
		var venta=parseInt($(this).val());
		$.ajax({
			type:"POST",
			url:"Controlador/detallesProductoVenta.php",
			data:{ID:$(this).val()},		
			success: function(data){
				dat = JSON.parse(data);
				$.each(dat,function(index,datos){
					$('#contenido').append('<tr><td id="id">' + datos.DescripcionProducto + '</td><td id="cant">' + datos.Precio + '</td><td id="prec">' + datos.Cantidad + '</td><td id="subt">' + datos.Subtotal + '</td><td id="subm">' + datos.SubTotalMonedero + '</td><td><div class="btn-group btn-group-xs" data-toggle="modal" data-target="#eliminar"><button title="Regresar" type="button" class="btn btn-default regresar" value="' + datos.ID_Producto + '"><span class="glyphicon glyphicon-circle-arrow-left"></span></button></div></td></tr>');
					$('.regresar').unbind('click');
					$('.regresar').bind('click',function(){
						context=$(this);
						var tr=$(this).parent().parent().parent().children('td');
						var cantidad=parseInt(tr[2].innerHTML);
						var id=$(this).val();

						if(cantidad>1){
							do{
								b=0;
								cantidadR = prompt("¿Cuantos productos regresará?", "1");
								if(Math.floor(cantidadR) == cantidadR && $.isNumeric(cantidadR) && cantidadR>0 && cantidad>=cantidadR) {
									b=1;
	  							}
	  							else{
	  								if(cantidadR == null){
	  									b=2;
	  								}
	  							}
	  						}while(b!=1 && b!=2);
						}
						else{
							if(cantidad>0){
								cantidadR=cantidad;
								b=1
							}
							else{
								context.parent().parent().parent().css('background-color','rgba(255,0,0,0.5)');
								b=0;
							}

						}
						if (b==1){
							$.ajax({
								type:"POST",
								url:"Controlador/eliminarProductoVenta.php?opc=1",
								data:{
									id:id,
									cantidad:cantidadR,
									venta:venta
								},		
								success: function(data){
									console.log(data);
									datos = JSON.parse(data);
									if(datos.error){
										alert(datos.error)
									}
									else{
										alert(datos.mensaje);
										tr[2].innerHTML=cantidad-cantidadR;
										tr[3].innerHTML=parseFloat(parseFloat(tr[1].innerHTML)*(cantidad-cantidadR));
									}
								}
							});
						}
					})
				});
			}
		});
	});
	
	$('#producto').on('hide.bs.modal',function(){
		$('#contenido').html('');
	});
	$('.buscaventa').on('click',function(){
		$.ajax({
			type:"POST",
			url:"Controlador/buscarVenta.php",
			data:{fecha:$('#buscaTabla').val()},		
			success: function(data){
				//console.log(data);
				datos=JSON.parse(data);
				if(datos.mensaje){
					alert(datos.mensaje);
				}
				$('#ContenidoVenta').html(datos.contenido);
				$('.ventas').unbind('click');
				$('.ventas').on('click',function(){
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
				$('.productos').unbind('click');
				$('.productos').click(function(){
					var venta=parseInt($(this).val());
					$.ajax({
						type:"POST",
						url:"Controlador/detallesProductoVenta.php",
						data:{ID:$(this).val()},		
						success: function(data){
							dat = JSON.parse(data);
							$.each(dat,function(index,datos){
								$('#contenido').append('<tr><td id="id">' + datos.DescripcionProducto + '</td><td id="cant">' + datos.Precio + '</td><td id="prec">' + datos.Cantidad + '</td><td id="subt">' + datos.Subtotal + '</td><td id="subm">' + datos.SubTotalMonedero + '</td><td><div class="btn-group btn-group-xs" data-toggle="modal" data-target="#eliminar"><button title="Regresar" type="button" class="btn btn-default regresar" value="' + datos.ID_Producto + '"><span class="glyphicon glyphicon-circle-arrow-left"></span></button></div></td></tr>');
								$('.regresar').unbind('click');
								$('.regresar').bind('click',function(){
									context=$(this);
									var tr=$(this).parent().parent().parent().children('td');
									var cantidad=parseInt(tr[2].innerHTML);
									var id=$(this).val();

									if(cantidad>1){
										do{
											b=0;
											cantidadR = prompt("¿Cuantos productos regresará?", "1");
											if(Math.floor(cantidadR) == cantidadR && $.isNumeric(cantidadR) && cantidadR>0 && cantidad>=cantidadR) {
												b=1;
				  							}
				  							else{
				  								if(cantidadR == null){
				  									b=2;
				  								}
				  							}
				  						}while(b!=1 && b!=2);
									}
									else{
										if(cantidad>0){
											cantidadR=cantidad;
											b=1
										}
										else{
											context.parent().parent().parent().css('background-color','rgba(255,0,0,0.5)');
											b=0;
										}

									}
									if (b==1){
										$.ajax({
											type:"POST",
											url:"Controlador/eliminarProductoVenta.php?opc=1",
											data:{
												id:id,
												cantidad:cantidadR,
												venta:venta
											},		
											success: function(data){
												console.log(data);
												datos = JSON.parse(data);
												if(datos.error){
													alert(datos.error)
												}
												else{
													alert(datos.mensaje);
													tr[2].innerHTML=cantidad-cantidadR;
													tr[3].innerHTML=parseFloat(parseFloat(tr[1].innerHTML)*(cantidad-cantidadR));
												}
											}
										});
									}
								})
							});
						}
					});
				});
				$('.regresar').unbind('click');
				$('.regresar').bind('click',function(){
					var cantidad=datos.Cantidad;
					var id=datos.ID_Producto;
					var venta=datos.ID_Venta;
					if(cantidad>0){
						do{
							b=0;
							cantidadR = prompt("¿Cuantos productos regresará?", "1");
							if(Math.floor(cantidadR) == cantidadR && $.isNumeric(cantidadR) && cantidadR>0 && cantidad>=cantidadR) {
								$.ajax({
									type:"POST",
									url:"Controlador/eliminarProductoVenta.php?opc=1",
									data:{
										id:id,
										cantidad:cantidadR,
										venta:venta
									},		
									success: function(data){
										console.log(data);
										datos = JSON.parse(data);
										if(datos.error){
											alert(datos.error)
										}
										else{
											alert(datos.mensaje);
											context.parent().parent().parent().css('background-color','rgba(255,0,0,0.5)');
											context.parent().parent().parent().hide('8000');
										}
									}
								});
								b=1;
  							}
  							else{
  								console.log(cantidadR);
  								if(cantidadR == null){
  									b=2;
  								}
  							}
  						}while(b!=1 && b!=2);
					}
				})
			}
		});
	});
});