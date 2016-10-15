<?php
	$ID_Producto=$_POST['ID_Producto'];
	$precio=$_POST['precio'];
	$subcat1=$_POST['subcat1'];
	$subcat2=$_POST['subcat2'];
	$subcat3=$_POST['subcat3'];
	$exist=$_POST['exist'];
	
	$sql="CALL ModificarProducto('" . $ID_Producto . "'," . $precio . ",'" . $subcat1 . "','" . $subcat2 . "','" . $subcat3 . "','" . $exist . "')";
	include_once ('../Config/connect.php');
	mysql_query($sql);
	if(mysql_error()){
		echo "Mensaje de error " . mysql_error();
	}else{
		echo "Datos actualizados correctamente";
	}		
?>