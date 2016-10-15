$(document).ready(function(e) {
    modificarUsuario=function(){
		tipo=$('#tipo').val();
		nombre=$('#nombre').val();
				
		if (nombre.trim()==''){
			alert('Falta NOMBRE');
		}
		$.ajax({
			type: "POST",
			url: 'Controlador/modificarUsuario_proc.php',
			data: {
				ID_Usuario:$('#ID_Usuario').val(),
				tipo:$('#tipo').val(),
				nombre:$('#nombre').val()
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