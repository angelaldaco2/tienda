$(document).ready(function(e) {
    modificarMarca=function(){
		if($('#nombre').val()=="")
			alert("Hacen falta datos");
		else{
			$.ajax({
				type: "POST",
				url: 'Controlador/modificarMarca_proc.php',
				data: {
					ID:$('#ID_Marca').val(),
					nombre:$('#nombre').val(),
					tel:$('#tel').val(),
					correo:$('#correo').val(),
					pagina:$('#pagina').val(),
				},
				success: function(data){
					alert("Datos actualizados correctamente");
				}
			});
		}
	};


	addMarca=function(){
		if($('#aID_Marca').val()=="" || $('#anombre').val()=="")
			alert("Hacen falta datos");
			
		else{
			$.ajax({
				type: "POST",
				url: 'Controlador/addMarca_proc.php',
				data: {
					ID:$('#aID_Marca').val(),
					nombre:$('#anombre').val(),
					tel:$('#atel').val(),
					email:$('#acorreo').val(),
					web:$('#apagina').val(),
				},
				success: function(data){
					$('#aID_Marca').val("");
					$('#anombre').val("");
					$('#atel').val("");
					$('#acorreo').val("");
					$('#apagina').val("");
					alert("Datos guardados correctamente");
				}
			});
		}
	}

	$('.editar').click(function(){
		$.ajax({
			type: "POST",
			url: 'Controlador/detallesMarca.php?opc=marca',
			data: {
				ID_Marca:$(this).val(),
			},
			success: function(data){
				datos=JSON.parse(data);
				$('#ID_Marca').val(datos.ID_Marca);
				$('#nombre').val(datos.NombreMarca);
				$('#tel').val(datos.TelefonoMarca);
				$('#correo').val(datos.CorreoElectronicoMarca);
				$('#pagina').val(datos.PaginaWebMarca);
			}
		});
	});
});