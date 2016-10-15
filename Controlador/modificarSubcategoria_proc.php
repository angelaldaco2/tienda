<?php
	$ID_Subcategoria=$_POST['ID'];
	$nombre=strtoupper(ltrim($_POST['nombre']));
	
	$sql="CALL ModificarSubcategoria('" . $ID_Subcategoria . "','" . $nombre . "')";
	include_once ('../Config/connect.php');
	mysql_query($sql);
	if(mysql_error())
		echo "Mensaje de error " . mysql_error();
		
?>