$(document).ready(function(e) {
    edColor=function(){
		$.ajax({
			type: "POST",
			url: 'Controlador/modificarColor_proc.php',
			data: {
				ID:$('#cvc').val(),
				nombre:$('#nombrec').val(),
			},
			success: function(data){
				alert("Datos actualizados correctamente");
			}
		});
	}


	addColor=function(){
		if($('#aclave').val()=="" || $('#anombre').val()=="")
			alert("Hacen falta datos");
		else{
			$.ajax({
				type: "POST",
				url: 'Controlador/addColor_proc.php',
				data: {
					ID:$('#aclave').val(),
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
		$.ajax({
			type: "POST",
			url: 'Controlador/detallesColor.php?opc=editar',
			data: {
				ID:$(this).val()
			},
			success: function(data){
				datos=JSON.parse(data);
				$('#nombrec').val(datos.NombreColor);
				$('#cvc').val(datos.ID_Color);
			}
		});
	});
});