$(document).ready(function(e) {
	$('.buscar').on('click',function(){
		var context=$(this);
		if( $('#buscaTabla').val()!="" ){
			$.ajax({
				type:"POST",
				data:{match: $('#buscaTabla').val()},
				url:"Controlador/buscarCliente.php?opc=1",
				success:function(data){
					console.log(data);
					datos=JSON.parse(data);
					if(datos.error){
						alert(datos.error);
					}
					$('.orig tbody').html(datos.contenido);
				}
			});
		}else{
			$.ajax({
				type:"POST",
				url:"Controlador/buscarCliente.php?opc=0",
				success:function(data){
					datos=JSON.parse(data);
					if(datos.error){
						alert(datos.error);
					}
					$('.orig tbody').html(datos.contenido);
				}
			});
		}
	});
    modificarCliente=function(){

		$.ajax({
			type: "POST",
			url: 'Controlador/modificarCliente_proc.php?opc=0',
			data: {
				ID_Cliente:$('#cid').text(),
				nombre:$('#cnombre').val(),
				apellidop:$('#cap1').val(),
				apellidom:$('#cap2').val(),
				tel:$('#ctel').val(),
				cel:$('#ccel').val(),
				fecha:$('#cfechan').val(),
				promo:$('#cprom').val(),
			},
			success: function(data){
				console.log(data);
				if(data != false){
					alert(data);
				}else{
					
				}
			}
		});
	}

	agregarCliente=function(){
		$.ajax({
			type: "POST",
			url: 'Controlador/addCliente_proc.php',
			data: {
				nombre:$('#anombre').val(),
				apellidop:$('#aap1').val(),
				apellidom:$('#aap2').val(),
				tel:$('#atel').val(),
				cel:$('#acel').val(),
				fecha:$('#afechan').val(),
				coments:$('#coments').val(),
			},
			success: function(data){
				$('#anombre').val("");
				$('#aap1').val("");
				$('#aap2').val("");
				$('#atel').val("");
				$('#acel').val("");
				$('#afechan').val("");
				$('#coments').val("");
			}
		});
	}
	$('.bye').hide();
	$('.datos-mod').hide();
	$('#btn-agregar').click(function(){
		$('.agregar-mod').show(500);
		$('.datos-mod').hide(500);
		$(this).removeClass();
		$(this).addClass('btn btn-primary btn-lg');
		$('#btn-datos').removeClass();
		$('#btn-datos').addClass('btn btn-default btn-lg');
		$('#send-abono').show();
	});
	$('#btn-datos').click(function(){
		$('.agregar-mod').hide(500);
		$('.datos-mod').show(500);
		$(this).removeClass();
		$(this).addClass('btn btn-primary btn-lg');
		$('#btn-agregar').removeClass();
		$('#btn-agregar').addClass('btn btn-default btn-lg');
		$('#send-abono').hide();
	});


	$('.busq').hide();

	addDatos=function(){
    	
    	if($('#rfc').val()=="" 
				|| $('#rc').val()=="" || $('#ca').val()=="" || $('#ne').val()==""
				|| $('#ce').val()=="" || $('#co').val()=="" || $('#cp').val()==""
				|| $('#ci').val()=="" || $('#es').val()=="")
			alert("Hacen falta datos");
		else{
			$.ajax({
				type: "POST",
				url: 'Controlador/addDatosFacturacion_proc.php',
				data: {
					RFC:$('#rfc').val(),
					ID_Cliente:$('#nc').text(),
					RazonSocial:$('#rc').val(),
					Calle:$('#ca').val(),
					NoEx:$('#ne').val(),
					NoIn:$('#ni').val(),
					Col:$('#co').val(),
					CodPostal:$('#cp').val(),
					Ciudad:$('#ci').val(),
					Estado:$('#es').val(),
					Correo:$('#ce').val()
				},
				success: function(data){
					var datos=JSON.parse(data);
					if(datos.error){
						alert(datos.error);
					}else{
						alert(datos.mensaje);
						$('#rfc').val("");
						$('#rc').val("");
						$('#ca').val("");
						$('#ne').val("");
						$('#ni').val("");
						$('#co').val("");
						$('#cp').val("");
						$('#ci').val("");
						$('#es').val("");
						$('#ce').val("");
					}
				}
			});
		}
	}

	modificarDatos=function(){
		$.ajax({
			type: "POST",
			url: 'Controlador/modificarDatosFacturacion_proc.php',
			data: {
				RFC:$('#rfc').val(),
				ID_Cliente:$('#nc').text(),
				RazonSocial:$('#rc').val(),
				Calle:$('#ca').val(),
				NoEx:$('#ne').val(),
				NoIn:$('#ni').val(),
				Col:$('#co').val(),
				CodPostal:$('#cp').val(),
				Ciudad:$('#ci').val(),
				Estado:$('#es').val(),
				Correo:$('#ce').val()
			},
			success: function(data){
				console.log(data);
				if(data != false){
					alert(data);
				}else{
					$('#tbg').append('<tr><td>' + $('#desc').val() + '</td><td>' + $('#monto').val() + '</td></tr>');
				}
			}
		});
	}
	$('.facturacion').click(function(){
		ID_Cliente:$('#nc').text($(this).val());
		$.ajax({
			type:"POST",
			url:"Controlador/consultarfacturacion.php",
			data:{
				id:$(this).val()
			},
			success:function(data){
				console.log(data);
				datos=JSON.parse(data);
				if(datos.error){
					alert(datos.error);
				}
				else{
					$('#fact').html(datos.contenido);
				}
			}
		});
		console.log($(this).val());
	});


	$('.detalles').click(function(){
		console.log($(this).val());
		$.ajax({
			type:"POST",
			url:"Controlador/detallesCliente.php", 
			data:{ID:$(this).val()},		
			success: function(data){
				datos = JSON.parse(data);
				$('#idc').text( datos.ID_Cliente );
				$('#nombrec').text( datos.NombreCliente );
				$('#ap1').text( datos.ApellidoP );
				$('#ap2').text( datos.ApellidoM );
				$('#tel').text( datos.Telefono );
				$('#cel').text( datos.Celular );
				$('#fechan').text( datos.FechaNacimiento );
				$('#salm').text( datos.SaldoMonedero );
				$('#prom').text( datos.Promocion );
			}
		});
	});

	$('.editar').click(function(){
		console.log($(this).val());
		$.ajax({
			type:"POST",
			url:"Controlador/detallesCliente.php", 
			data:{ID:$(this).val()},		
			success: function(data){
				datos = JSON.parse(data);
				$('#cid').text( datos.ID_Cliente );
				$('#cnombre').val( datos.NombreCliente );
				$('#cap1').val( datos.ApellidoP );
				$('#cap2').val( datos.ApellidoM );
				$('#ctel').val( datos.Telefono );
				$('#ccel').val( datos.Celular );
				$('#cfechan').val( datos.FechaNacimiento );
				$('#csalm').text( datos.SaldoMonedero );
				$('#cprom').val( datos.Promocion );
			}
		});
	});
	$('.descliente').on('focusout',function(){
		$.ajax({
			type:"POST",
			url:"Controlador/modificarCliente_proc.php?opc=1",
			data:{
				id:$(this).attr('id'),
				texto:$(this).text()
			},
			success:function(data){
				console.log(data);
				if(data){
					datos = JSON.parse(data);
					if(datos.error){
						alert(datos.error);
					}
				}
			}
		});
		console.log($(this).attr('id'));
	});




});