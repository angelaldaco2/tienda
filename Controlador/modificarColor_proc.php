<?php
	$ID_Color=$_POST['ID'];
	$nombre=strtoupper(ltrim($_POST['nombre']));
	
	$sql="CALL ModificarColor('" . $ID_Color . "','" . $nombre . "')";
	echo $sql;
	include_once ('../Config/connect.php');
	mysql_query($sql);
	if(mysql_error()){
		echo "Mensaje de error " . mysql_error();
	}else{
		
	}	
?>