$(document).ready(function(e) {
	$('.bye').hide();
	$('.abonos-mod').hide();
	$('#btn-abonar').click(function(){
		$('.abonar-mod').show(500);
		$('.abonos-mod').hide(500);
		$(this).removeClass();
		$(this).addClass('btn btn-primary btn-lg');
		$('#btn-abonos').removeClass();
		$('#btn-abonos').addClass('btn btn-default btn-lg');
		$('#send-abono').show();
	});
	$('#btn-abonos').click(function(){
		$('.abonar-mod').hide(500);
		$('.abonos-mod').show(500);
		$(this).removeClass();
		$(this).addClass('btn btn-primary btn-lg');
		$('#btn-abonar').removeClass();
		$('#btn-abonar').addClass('btn btn-default btn-lg');
		$('#send-abono').hide();
	});

	$('.detalles').click(function(){
		console.log($(this).val());
		$.ajax({
			type:"POST",
			url:"Controlador/detallesApartado.php?opc=1", 
			data:{ID:$(this).val()},		
			success: function(data){
				datos = JSON.parse(data);
				$('#clavea').text( datos.ID_Apartado );
				$('#nombrec').text( datos.ID_Cliente );
				$('#totala').text( datos.TotalApartado );
				$('#saldoa').text( datos.SaldoApartado );
				$('#totalm').text( datos.TotalPremonedero );
				$('#fechai').text( datos.FechaInicio );
				$('#fechaf').text( datos.FechaFin );
				$('#estadoa').text( datos.Estado );
			}
		});
	});

	$('.abonos').click(function(){
			$.ajax({
				type:"POST",
				url:"Controlador/detallesApartado.php?opc=1", 
				data:{ID:$(this).val()},		
				success: function(data){
					datos = JSON.parse(data);
					$('#clav').text( datos.ID_Apartado );
					$('#tot').text( datos.TotalApartado );
					$('#sal').text( datos.SaldoApartado );
				}
			});
			$.ajax({
				type:"POST",
				url:"Controlador/detallesApartado.php?opc=2", 
				data:{ID:$(this).val()},		
				success: function(data){
					console.log(data + 'hola')
					$('#detallesAbono').html(data);
				}
			});
	});
	$('.productos').click(function(){
		venta=$(this).val();
		papa=$(this).parent().parent().parent().children('td')[4];
		$.ajax({
			type:"POST",
			url:"Controlador/detallesApartado.php?opc=3", 
			data:{ID:$(this).val()},		
			success: function(data){
				//console.log(data);
				$('#cuerpoProducto').html(data);
				$('.delApartado').unbind('click');
				$('.delApartado').bind('click',function(){
					context=$(this);
					var tr=$(this).parent().parent().parent().children('td');
					var cantidad=parseInt(tr[2].innerHTML);
					var id=$(this).val();
					//console.log(id,cantidad,venta);

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
							url:"Controlador/detallesApartado.php?opc=4",
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
									console.log(papa);
									//papa.innerHTML=parseFloat(parseFloat(tr[1].innerHTML)*(cantidad-cantidadR));
								}
							}
						});
					}
				})
			}
		});
	});

	$('#buscaTabla').keyup(function(){
		$.ajax({
			type: "POST",
			url: 'Controlador/detallesApartado.php?opc=buscar',
			data: {match:$(this).val()},
			success: function(data){
				$('.orig').hide();
				$('.search').show();
				$('.bye').show();
				$('.search').html(data);
				$('.productos').unbind('click');
				$('.productos').bind('click',function(){
					$.ajax({
						type:"POST",
						url:"Controlador/detallesApartado.php?opc=3", 
						data:{ID:$(this).val()},		
						success: function(data){
							console.log(data);
							$('#cuerpoProducto').html(data);
							$('.delApartado').unbind();
							$('.delApartado').bind('click',function(){
								$.ajax({
									type: "POST",
									url: 'Controlador/detallesApartado.php?opc=4',
									data: {ID:$(this).val()},
									success: function(data){
										console.log(data);
										if(data != false){
											alert(data);
										}else{
											alert('agregado correctamente');
										}
										
									}
								});
							});
						}
					});
				});
				$('.abonos').unbind('click');
				$('.abonos').bind('click',function(){
					$.ajax({
						type:"POST",
						url:"Controlador/detallesApartado.php?opc=1", 
						data:{ID:$(this).val()},		
						success: function(data){
							datos = JSON.parse(data);
							$('#clav').text( datos.ID_Apartado );
							$('#tot').text( datos.TotalApartado );
							$('#sal').text( datos.SaldoApartado );
						}
					});
					$.ajax({
						type:"POST",
						url:"Controlador/detallesApartado.php?opc=2", 
						data:{ID:$(this).val()},		
						success: function(data){
							console.log(data + 'hola')
							$('#detallesAbono').html(data);
						}
					});
				});


				$('.detalles').unbind('click');
				$('.detalles').bind('click',function(){
					console.log($(this).val());
					$.ajax({
						type:"POST",
						url:"Controlador/detallesApartado.php?opc=1", 
						data:{ID:$(this).val()},		
						success: function(data){
							datos = JSON.parse(data);
							$('#clavea').text( datos.ID_Apartado );
							$('#nombrec').text( datos.ID_Cliente );
							$('#totala').text( datos.TotalApartado );
							$('#saldoa').text( datos.SaldoApartado );
							$('#totalm').text( datos.TotalPremonedero );
							$('#fechai').text( datos.FechaInicio );
							$('#fechaf').text( datos.FechaFin );
							$('#estadoa').text( datos.Estado );
						}
					});
				});
			}
		});
	});
	
	$('.eliminarapartado').on('click',function(){
		context=$(this);
		var eliminar = confirm('¿Quiere eliminar éste apartado?');
		if (eliminar == true){
			$.ajax({
				type:"POST",
				data:{id:$(this).val()},
				url:'Controlador/eliminarApartado.php',
				success: function(data){
					datos=JSON.parse(data);
					if(datos.error){
						alert(datos.error);
					}
					else{
						alert(datos.mensaje);
						var tr = context.parent().parent().parent();
						tr.css('background-color','rgba(255,0,0,0.5)');
						tr.hide(750);
					}
				}
			});
		}
		else{
		}
	});

	$('#buscarfecha').on('click',function(){
		$.ajax({
			type:"post",
			url:"controlador/detallesApartado.php?opc=5",
			data:{
				tipo:$('#buscapor:checked').val(),
				fecha:$('#buscarApartado').val()
			},
			success:function(data){
				datos=JSON.parse(data);
				if(datos.error){
					alert(datos.error);
					$('#contenidobusqueda').html('');
				}
				else{
					$('#contenidobusqueda').html(datos.result);	
				}
			}
		});
	});

	abonar=function(){
		$.ajax({
			type: "POST",
			url: 'Controlador/registrarAbono_proc.php',
			data: {
				clave:$("#clav").text(),
				efectivo:$('#efec').val(),
				tarjeta:$('#tarj').val(),
				monedero:$('#mon').val()
			},
			success: function(data){
				console.log(data);
				if(data != false){
					alert(data);
				}else{
					alert('agregado correctamente');
					$('#abonar').modal('hide');
					window.open('ticket_ab.php','_target');
				}
				
			}
		});
	};
});