$(document).ready(function(e) {
    modificarEmpleado=function(){
		nombre=$('#nombre').val();
		apellidop=$('#ap').val();
		apellidom=$('#am').val();
		fecha=$('#fecha').val();
		tel=$('#tel').val();
		cel=$('#cel').val();
		correo=$('#Correo').val();
		est=$('#Est').val();
		gen=$('#Gen').val();
		calle=$('#Calle').val();
		NoEx=$('#NoEx').val();
		NoIn=$('#NoIn').val();
		col=$('#Col').val();
		codpostal=$('#CodPostal').val();
		ciudad=$('#Ciudad').val();
		estado=$('#Estado').val();
		
		if (nombre.trim()==''){
			alert('Falta NOMBRE');
		}
		$.ajax({
			type: "POST",
			url: 'Controlador/modificarEmpleado_proc.php',
			data: {
				ID_Empleado:$('#ID_Empleado').val(),
				nombre:$('#nombre').val(),
				apellidop:$('#ap').val(),
				apellidom:$('#am').val(),
				fecha:$('#fecha').val(),
				tel:$('#tel').val(),
				cel:$('#cel').val(),
				correo:$('#Correo').val(),
				est:$('#Est').val(),
				gen:$('#Gen').val(),
				calle:$('#Calle').val(),
				NoEx:$('#NoEx').val(),
				NoIn:$('#NoIn').val(),
				col:$('#Col').val(),
				codpostal:$('#CodPostal').val(),
				ciudad:$('#Ciudad').val(),
				estado:$('#Estado').val()
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