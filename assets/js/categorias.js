$(document).ready(function(e) {
    modificarCategoria=function(){
		$.ajax({
			type: "POST",
			url: 'Controlador/modificarCategoria_proc.php',
			data: {
				ID:$('#clavec').val(),
				nombre:$('#nombrec').val(),
			},
			success: function(data){
				alert("Datos actualizados correctamente");
			}
		});
	}

	addCategoria=function(){
		if($('#aclave').val()=="" || $('#anombre').val()=="")
			{alert("Hacen falta datos");
			$('#aclave').focus();}
		else{
			$.ajax({
				type: "POST",
				url: 'Controlador/addCategoria_proc.php',
				data: {
					ID_Categoria:$('#aclave').val(),
					nombre:$('#anombre').val(),
				},
				success: function(data){
					$('#aclave').val("");
					$('#anombre').val("");
					alert("Datos guardados correctamente");
				}
			});
		}
	}



	$('.editar').click(function(){
		console.log($(this).val());
		$.ajax({
			type: "POST",
			url: 'Controlador/categoria.php?opc=cat',
			data: {
				ID:$(this).val(),
			},
			success: function(data){
				datos = JSON.parse(data);
				console.log(datos);
				$('#clavec').val(datos.ID_Categoria);
				$('#nombrec').val(datos.NombreCategoria);
			}
		});
	});
	
});