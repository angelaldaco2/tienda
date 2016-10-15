$(document).ready(function(e) {
    modificarSub=function(){		
		$.ajax({
			type: "POST",
			url: 'Controlador/modificarSubcategoria_proc.php',
			data: {
				ID:$('#clavesc').val(),
				nombre:$('#nombresc').val(),
			},
			success: function(data){
				alert("Datos actualizados correctamente");
			}
		});
	}

	addSub=function(){
		if($('#aclave').val()=="" || $('#anombre').val()=="")
			alert("Hacen falta datos");
		else{
			$.ajax({
				type: "POST",
				url: 'Controlador/addSubcategoria_proc.php',
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

	$('.editarSub').click(function(){
		//console.log($(this).val());
		$.ajax({
			type: "POST",
			url: "Controlador/categoria.php?opc=Subcat",
			data:{ID:$(this).val()},
			success: function(data){
				datos = JSON.parse(data);
				console.log(data);
				$('#clavesc').val( datos.ID_Subcategoria );
				$('#nombresc').val( datos.NombreSubCategoria );
			}
		});
	});
});