<?php
	$ID_Usuario=$_POST['ID_Usuario'];
	$tipo=$_POST['tipo'];
	$nombre=$_POST['nombre'];
	
	$sql="CALL ModificarUsuario(" . $ID_Usuario . ",'" . $tipo . "','" . $nombre . "')";
	include_once ('../Config/connect.php');
	mysql_query($sql);
	if(mysql_error()){
		echo "Mensaje de error " . mysql_error();
	}else{
		echo "Datos actualizados correctamente";
	}	
?>