$(document).ready(function(e) {
    modificarDatosFacturacion=function(){
		rfc=$('#rfc').val();
		ID_Cliente=$('#ID_Cliente').val();
		razonSocial=$('#razonSocial').val();
		calle=$('#calle').val();
		noExterior=$('#noExterior').val();
		noInterior=$('#noInterior').val();
		colonia=$('#colonia').val();
		codigoPostal=$('#codigoPostal').val();
		ciudad=$('#ciudad').val();
		estado=$('#estado').val();
		correo=$('#correo').val();
		
		$.ajax({
			type: "POST",
			url: 'Controlador/modificarDatosFacturacion_proc.php',
			data: {
				RFC:$('#rfc').val(),
				ID_Cliente:$('#ID_Cliente').val(),
				razonSocial:$('#razonSocial').val(),
				calle:$('#calle').val(),
				noExterior:$('#noExterior').val(),
				noInterior:$('#noInterior').val(),
				colonia:$('#colonia').val(),
				codigoPostal:$('#codigoPostal').val(),
				ciudad:$('#ciudad').val(),
				estado:$('#estado').val(),
				correo:$('#correo').val()
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
});