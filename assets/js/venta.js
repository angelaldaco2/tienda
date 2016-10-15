$(document).ready(function(e) {

	$('#producto').on('focusout',function(){
		var id=$(this).val();
		//console.log($(this).val());
		$.each($('#cuerpo>tr>#clave'),function(index,valor){
			if(valor.innerHTML == id){
				$('#myModalLabelerror').text('Atención');
				$('.contenido-msj').html('<font color="#4444ff" size="42" >El producto ya existe en la lista de compra</font><br>Para aumentar la cantidad elimine el producto de la lista de venta');
				$('#error').modal('show');
				$('#producto').val('');
				$('#cantidad').val('');
				$('#cantidad').addClass('readonly');
				$('#Agregar').addClass('readonly');
			}
		});
	});

	$('[name=monedero]').keyup(function(){
		var cant=parseFloat($('[name=monedero]').val());
		var monedero=parseFloat($('#monedero').text());
		var total=parseFloat($('#total').val());
		if(cant>monedero){
			if(monedero>total)
				{$('[name=monedero]').val(total);}
			else
				$('[name=monedero]').val(monedero);
		}
		if (cant>total)
			$('[name=monedero]').val(total);
		if(cant<0 || isNaN(cant)){
			$('[name=monedero]').val("");
		}

		if($('[name=monedero]').val()=="")
			var tPagar=total;
		if(cant!=0 && $('[name=monedero]').val()!=""){
			if (cant<monedero)
				var tPagar=total-cant;
			else 
				var tPagar=total;
		}
		else{
			var tPagar=total;
		}
		if(cant === 0){
			$('[name=apagar]').val(total);
		}
		else{
			if(tPagar<0){
				$('[name=apagar]').val(0);
			}else{
				$('[name=apagar]').val(tPagar);
			}
		}
	});
	
	$('[name=tpago]').click(function(){
		if($(this).val()!=1){
			$('#cambio').hide();
		}else{
			$('#cambio').show();
		}
		$('[name=mefectivo]').val(0);
		$('[name=mtarjeta]').val($('[name=apagar]').val());
		$('[name=mtarjeta]').attr('readonly',true);
	});

	$('[name=mefectivo]').keyup(function(){
		var efectivo=parseFloat( parseFloat($('[name=apagar]').val() - $('[name=mefectivo]').val()) );
		if(isNaN(efectivo) || parseFloat($('[name=mefectivo]').val()) <=0){
			efectivo=parseFloat($('[name=apagar]').val());
			$('[name=mefectivo]').val(0)
		}else{
			console.log(efectivo + '<=' + parseFloat($('[name=apagar]').val()));
			if(parseFloat($('[name=mefectivo]').val())>=parseFloat($('[name=apagar]').val()) ){
				$('[name=mefectivo]').val($('[name=apagar]').val());
				efectivo=0;
			}
		}
		$('[name=mtarjeta]').val(efectivo);
		$('[name=mtarjeta]').attr('readonly',true);
	});
	
    $('[name=producto]').change(function(){
    	if( $('[name=producto]').val()!="" ){
			$.ajax({
				type:"POST",
				url:"Controlador/obtenerProducto.php", 
				data:{
					ID_Producto:$("#producto").val()		
				},
				success: function(data){
					datos=JSON.parse(data);
					//console.log(datos.Precio);
					if ((datos.Precio != null && datos.Descripcion != null) || $('[name=producto]').val()!="" || $('[name=producto]').val()!=" " ){
						$('#precio').val(datos.Precio);
						$('#precio').attr('disabled','disabled');
						$('#control').append('<input type="hidden" value="' + datos.Descripcion + '" name="Descripcion">')
					}
					else{
						$('[name=producto]').val('');
					}

				}
			})
		}
	});

	$('#Agregar').click(function(){
		addProd();
	});

	$('#cantidad').keyup(function(){
		var cantidad = parseInt($('#cantidad').val());
		if(cantidad<0 || isNaN(cantidad)){
			$('#cantidad').val(1);
		}
		if(cantidad > parseInt($('#tcantidad').text()) ){
			$('#cantidad').val(parseInt($('#tcantidad').text()));
		}
	});

	$('#cantidad').focus(function(){
		$.ajax({
			type:"POST",
			url:"Controlador/obtenerProducto.php", 
			data:{
				ID_Producto:$("#producto").val()		
			},
			success: function(data){
				datos=JSON.parse(data);
				//console.log (datos);
				$('#tcantidad').text(datos.cantidad);
				$('#cantidad').attr('max',datos.cantidad);
			}
		})
	});

	addProd=function(){
		$.ajax({
			type:"POST",
			url:"Controlador/obtenerProducto.php", 
			data:{
				ID_Producto:$("#producto").val()		
			},
			success: function(data){
				datos=JSON.parse(data);
				var promocion=parseInt($('.promocioncliente').val());
				var clave=datos.ID_Producto;
				var desc=datos.Descripcion;
				var prec=datos.Precio;
				var total=parseInt(parseInt($("#total").val()) + parseInt($('#cantidad').val()) * parseInt(prec));
				var sub=parseFloat(parseFloat($('#cantidad').val()) * parseFloat(prec))
				//$('#tcantidad').text(parseInt($('#tcantidad').text())-parseInt($('#cantidad').val()));
				//console.log(datos);
				//console.log(datos.promocion);
				if(promocion<datos.promocion){
					promocion=datos.promocion;
				}
				$('#tcantidad').text('');
				$('#cuerpo').append('<tr><td id="clave">' + clave + '</td><td>' + desc + '</td><td><ol id="cantidadAdded" contenteditable="true">' + $('#cantidad').val() + '</ol></td><td> ' + prec + ' </td><td id="subtotal">' +  sub + '</td><td>' + promocion + '</td><td><div class="btn-group btn-group-xs" ><button type="button" value="' + sub +'" class="btn btn-danger borrar" style="font-size: 18px; padding: 0px 0px;"><span class="glyphicon glyphicon-remove-circle"></span></div></td></tr>');
				$(".borrar").unbind();
				$(".borrar").bind('click',function(){
					var del = $(this).parent().parent().parent();
					cantidad=del.children();
					//console.log(cantidad[2]);
					cantidad=cantidad[2].innerHTML;
					var resta=$("#total").val()-$(this).val();
					$("#total").val(resta);
					var cant=parseFloat($('[name=monedero]').val());
					var total=parseFloat($('#total').val());
					if(cant>total)
					{$('[name=monedero]').val(total);}
					//$('#tcantidad').text(parseInt($('#tcantidad').text())+parseInt(cantidad));
					$('[name=apagar]').val( parseFloat( $('#total').val() ) - parseFloat( $('[name=monedero]').val() ) )
					del.remove();
				});
				//$('#codes').append('<div id="bye' + clave + '"><script>$(".borrar").click(function(){console.log($(this).val());});</script></div>');
				$("#Agregar").attr('class','btn btn-info disabled');
				$("#producto").val('');
				$("#cantidad").val('');
				$('#cantidad').attr('readonly',true);
				$("#producto").focus();
				$("#total").val(total);

				if($("#total").val()>parseFloat($('#monedero').text()))
					$("[name=monedero]").val(parseFloat($('#monedero').text()));
				else
					$("[name=monedero]").val(total);
					
					//if(cant > parseInt($('#monedero').text()) ){
					//$('#mon').val(parseInt($('#mon').text()));
					//}

				if($('[name=monedero]').val() != "")
					var tPagar=parseFloat($('#total').val()) - parseFloat($('[name=monedero]').val());

				if(tPagar<0)
					tPagar=0;

				$('[name=apagar]').val(tPagar);
			}
		})
	};
	
	$(".apartar").click(function () {
		$('#bandera').val(0);
		var idProd=new Array;
		var cantidad=new Array;
		var precio=new Array;
		$("#tabla tbody tr").each(function (index) {			
			$(this).children("td").each(function (index2) {
				switch (index2) {
					case 0:
						idProd[index] = $(this).text();
					break;
					case 2:
						cantidad[index] = $(this).text();
					break;
					case 3:
						precio[index] = $(this).text();
					break;
				}
			})
		})
		if(idProd.length>0){
			$.ajax({
				type:"POST",
				url:"Controlador/registrarApartado.php", 
				data:{
					ID_Cliente:$("#ID_Cliente").val(),
					idProd:idProd,
					cantidad:cantidad,
					precio:precio
				},
				success: function(data){
					console.log(data);
					datos=JSON.parse(data);
					if(datos.error){
						alert(datos.error);
					}else{
						$('#abonar').modal({
	  						keyboard: false
							},'show');
						$('#abonar').on('shown.bs.modal',function(){
							$('#clav').text(datos.id);
							$('#tot').text(datos.total);
							$('#min').text( parseInt( datos.total )*0.10)
							$('#send-abono').addClass('disabled');
							$('#efec').bind('keyup',function(){
								efec=parseFloat($('#efec').val());
								tarj=parseFloat($('#tarj').val());
								mon=parseFloat($('#moned').val());
								if( ( efec + tarj + mon ) >= parseFloat( $('#min').text() ) ){
									$('#send-abono').removeClass('disabled');
								}
								else{
									$('#send-abono').removeClass('disabled');
									$('#send-abono').addClass('disabled');
								}
							});
							$('#tarj').bind('keyup',function(){
								efec=parseFloat($('#efec').val());
								tarj=parseFloat($('#tarj').val());
								mon=parseFloat($('#moned').val());
								if( ( efec + tarj + mon ) >= parseFloat( $('#min').text() ) ){
									$('#send-abono').removeClass('disabled');
								}
								else{
									$('#send-abono').removeClass('disabled');
									$('#send-abono').addClass('disabled');
								}
							});
							$('#moned').bind('keyup',function(){
								efec=parseFloat($('#efec').val());
								tarj=parseFloat($('#tarj').val());
								mon=parseFloat($('#moned').val());
								if( ( efec + tarj + mon ) >= parseFloat( $('#min').text() ) ){
									$('#send-abono').removeClass('disabled');
								}
								else{
									//$('#send-abono').removeClass('disabled');
									$('#send-abono').addClass('disabled');
								}
							});
						});
						$('#abonar').on('hide.bs.modal',function(){
							if($('#bandera').val() != 1){
								console.log($('#bandera').val())
								return false;
							}else{
								$('#formulario')[0].reset();
								$('[name=cliente]').val('');
								$('#cuerpo').html('');
								$('[name=total]').val('');
								$('[name=monedero]').val('');
								$('#monedero').text('');
								$('[name=apagar]').val('');
								$('[name=cliente]').focus();
								$('#producto').attr('readonly',true);
								$('#cantidad').attr('readonly',true);
								$('#Agregar').attr('readonly',true);
								$('#total').val(0);
							}
							
						});
					}
				}
			});
		}else{
			$('#myModalLabelerror').text('Atención');
			$('.contenido-msj').html('<font color="#4444ff" size="42" >No hay productos para apartar</font>');
			$('#error').modal('show');
		}
	});
	abonar=function(){
		$.ajax({
			type: "POST",
			url: 'Controlador/registrarAbono_proc.php',
			data: {
				clave:$("#clav").text(),
				efectivo:$('#efec').val(),
				tarjeta:$('#tarj').val(),
				monedero:$('#moned').val()
			},
			success: function(data){
				console.log(data);
				if(data != false){
					alert(data);
				}else{
					alert('agregado correctamente');
					$('#bandera').val(1);
					$('#abonar').modal('hide');
					window.open('ticket_apn.php','_target');
				}
				
			}
		});
	};
		
	$(".pagar").click(function(){
		if($('[name=tpago]:checked').val() == 3 && $(this).val()!='pagar' ){
			$('#myModal').modal('show');
			return false;
		}else{
			var idProd=new Array;
			var cantidad=new Array;
			var precio=new Array;
			$("#tabla tbody tr").each(function (index) {			
				$(this).children("td").each(function (index2) {
					switch (index2) {
						case 0:
							idProd[index] = $(this).text();
						break;
						case 2:
							cantidad[index] = $(this).text();
						break;
						case 3:
							precio[index] = $(this).text();
						break;
					}
				})
			})
			if(idProd.length <= 0){
					return false;
				}
			if( ($('#cambio').val() >= parseFloat( $('[name=apagar]').val() )) || $('[name=tpago]:checked').val() != 1 ){
				if( $('[name=tpago]:checked').val() == 2 ){
					if(!confirm('¿Desea pagar con tarjeta?')){
						return false;
					}
				}
				if( $('[name=tpago]:checked').val() == 1 ){
					var cambio=parseFloat( $('#cambio').val() ) - parseFloat( $('[name=apagar]').val() );
					if(cambio > 0){
						$('#myModalLabelerror').text('Cambio');
						$('.contenido-msj').html('<font color="#4444ff" size="42" >Cambio:<br>$' + cambio + '</font>');
						$('#error').modal('show');
					}
				}
				if( $('[name=tpago]:checked').val() == 3){
					if( parseInt($('[name=mpago]').val()) >= parseInt($('[name=mefectivo]').val()) ){
						var cambio=parseFloat( $('[name=mpago]').val() ) - parseFloat( $('[name=mefectivo]').val() );
						if(cambio > 0){
							$('#myModalLabelerror').text('Cambio');
							$('.contenido-msj').html('<font color="#4444ff" size="42" >Cambio:<br>$' + cambio + '</font>');
							$('#error').modal('show');
						}
					}
				}
				$.ajax({
					type:"POST",
					url:"Controlador/registrarPago.php", 
					data:{
						ID_Cliente:$("#ID_Cliente").val(),
						idProd:idProd,
						cantidad:cantidad,
						precio:precio,
						tipoPago:$('[name=tpago]:checked').val(),
						apagar:parseFloat($('[name=apagar]').val()),
						mefectivo:parseFloat($('[name=mefectivo]').val())
					},
					success: function(data){
						if(data){
							alert(data);
						}else{
							$('#formulario')[0].reset();
							$('[name=cliente]').val('');
							$('#cuerpo').html('');
							$('[name=total]').val(0);
							$('[name=monedero]').val(0);
							$('#monedero').text('');
							$('[name=apagar]').val(0);
							$('[name=cliente]').focus();
							$('#total').val(0);
							$('#mon').val(0);
							$('#total').val(0);
							$('#cambio').val(0);
							$('#producto').attr('readonly',true);
							$('#cantidad').attr('readonly',true);
							$('#Agregar').attr('readonly',true);
							$('#myModal').modal('hide');
							$('[name=mpago]').val(0)
							window.open('ticket_v2.php','_target');
							//$('#imprimir').modal('show');
						}
					}
				})
			}
			else{
				$('#myModalLabelerror').text('Falta efectivo');
				$('.contenido-msj').text('Hace falta efectivo para cubrir con la compra');
				$('#error').modal('show');
				return false;
			}
		}
	});
	
	$('#formulario').submit(function(){
		addProd();
		return false;
	});
	
	$("[name=cliente]").keyup(function(){
		habilitarBtn();
	});
	
	$("#producto").keyup(function(){
		habilitarBtn();
	});
	
	$("#cantidad").change(function(){
		habilitarBtn();
	});
	
	$("#cantidad").keyup(function(){
		habilitarBtn();
	});
	
	$("#cantidad").focus(function(){
		habilitarBtn();
	});
	
	$(function() {
	    var projects = [
	      {
	        value: "jquery",
	        label: "jQuery",
	        desc: "the write less, do more, JavaScript library",
	        icon: "jquery_32x32.png"
	      },
	      {
	        value: "jquery-ui",
	        label: "jQuery UI",
	        desc: "the official user interface library for jQuery",
	        icon: "jqueryui_32x32.png"
	      },
	      {
	        value: "sizzlejs",
	        label: "Sizzle JS",
	        desc: "a pure-JavaScript CSS selector engine",
	        icon: "sizzlejs_32x32.png"
	      }
	    ];

 
	    $( "#producto" ).autocomplete({source:"Controlador/obtenerProducto2.php?"}).autocomplete({
	      minLength: 0,
	      focus: function( event, ui ) {
	        $( "#producto" ).val( ui.item.label );
	        return false;
	      },
	      select: function( event, ui ) {
	        $( "#producto" ).val( ui.item.label );
	        $( "#producto-id" ).val( ui.item.value );
	        $( "#producto-description" ).html( ui.item.desc );
	        $( "#producto-icon" ).attr( "src", "images/" + ui.item.icon );
	 
	        return false;
	      }
	    })
	    .autocomplete( "instance" )._renderItem = function( ul, item ) {
	      return $( "<li>" )
	        .append( "<a style='width:313px;'>" + item.label + "<br><span style='font-size:10px;'>" + item.desc + "</span></a>" )
	        .appendTo( ul );
	    };
  	});

	$(function(){
		$('[name=cliente]').autocomplete({
			source:"Controlador/obtenerCliente.php?opc=2",
			select : function(event, ui){
                       // agregamos un valor por defacto a nuestro campo "resultadosa" 
                       // si necesitas mas campos solo agregalos al array y despues hubicalos es esta parte del codigo
                       //cambiando el identificador por el id del campo y el value por el nombre que le diste a tu dato obtenido dentro del array
                       $('#ID_Cliente').val(ui.item.ID_Cliente);
					   getMonedero();
                   }
		});
	}); //autocomplete
	
	getMonedero=function(){
		$.ajax({
			type:"POST",
			url:"Controlador/obtenerCliente.php?opc=1", 
			data:{
				ID_Cliente:$("#ID_Cliente").val()	
			},
			success: function(data){
				datos=JSON.parse(data);
				$('#monedero').text(datos.saldoMonedero)
				$('.promocioncliente').val(datos.Promocion);
				
			}
		})
	}; // monedero

}); 

crea_link_ticket=function ()
	{	console.log('holi')
		var var_transaccion = $("#carga_transaccion").text();
		$(".pagar").attr("href","crea_ticket.php?transaccion="+1);
	}

habilitarBtn=function(){
	if($("#producto").val() != "" && $("#cantidad").val() !="0" && $("#cantidad").val() !="" && $("[name=cliente]").val() !="" ){
		$("#Agregar").attr('class','btn btn-info');
	}else{
		$("#Agregar").attr('class','btn btn-info disabled');
	}
	
	if( $('[name=cliente]').val() == "" ){
		$('[name=producto]').attr('readonly',true);
		
	}
	else{
		$('[name=producto]').attr('readonly',false);
	}

	if( $('[name=producto]').val() == "" || $('[name=cliente]').val() == "" ){
		$('[name=cantidad]').attr('readonly',true);
		
	}
	else{
		$('[name=cantidad]').attr('readonly',false);
	}
}