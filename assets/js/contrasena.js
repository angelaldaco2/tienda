$(document).ready(function(e){
    ConfContra=function(){
		if($('#contra').val() == $('#ccontra').val()){
			
			$.ajax({
				type: "POST",
				url: 'Controlador/addUsuario_proc.php',
				data:{
					clave:$("#clave").val(),
					tipo:$("#tipo").val(),
					nombre:$("#nombre").val(),
					contra:$("#contra").val()
				},
				success: function(data){
					alert(data);
				}
			});
		}
		else{
			alert('La CONTRASEÑA no coincide. Vuelve a intentarlo.');	
		}
	};
});