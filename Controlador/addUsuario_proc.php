<?php
	include_once('../Config/connect.php');
	//ID_EMpleado se va a jalar automáticamente al consultar el empleado
	$ID_Empleado=($_POST['clave']);
	$ID_TipoUsuario=($_POST['tipo']);
	$NombreUsuario=strtoupper(trim($_POST['nombre']));
	$Contrasena=md5(trim($_POST['contra']));

	$sql="CALL RegistrarUsuario (" . $ID_Empleado . "," . $ID_TipoUsuario . ",'" . $NombreUsuario . "','" . $Contrasena . "');";
	mysql_query($sql);
	if(!mysql_error()){
		echo "El usuario se ha creado satisfactoriamente.";	
	}
	else{
		echo "Error al añadir el usuario.".mysql_error();
	}
?>