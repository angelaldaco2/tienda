<?php 
include_once('../config/connect.php');		
$ID=$_POST['ID'];
$sql=('SELECT * from Producto_Venta left join producto on producto.ID_Producto=Producto_venta.ID_Producto where ID_Venta="'.$ID.'"');
$result=mysql_query($sql);
if(!mysql_error()){
	while($row=mysql_fetch_array($result)){
	 	$tupla[]=$row;
	}
}
else{
	echo mysql_error();
}

echo json_encode($tupla);
?>