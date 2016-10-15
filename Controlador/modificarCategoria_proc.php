<?php
	$ID_Categoria=$_POST['ID'];
	$nombre=strtoupper(ltrim($_POST['nombre']));
	
	$sql="CALL ModificarCategoria('" . $ID_Categoria . "','" . $nombre . "')";
	echo $sql;
	include_once ('../Config/connect.php');
	mysql_query($sql);
	if(mysql_error())
		echo "Mensaje de error " . mysql_error();
?>