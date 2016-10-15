<?php
	$ID_Marca=$_POST['ID'];
	$nombre=strtoupper(ltrim($nombre=$_POST['nombre']));
	$tel=$_POST['tel'];
	$correo=$_POST['correo'];
	$pagina=strtoupper(ltrim($pagina=$_POST['pagina']));
	
	$sql="CALL ModificarMarca('" . $ID_Marca . "','" . $nombre . "','" . $tel . "','" . $correo . "','" . $pagina . "')";
	include_once ('../Config/connect.php');
	mysql_query($sql);
if(mysql_error()){
		echo "Mensaje de error " . mysql_error();
	}else{

	}	
?>