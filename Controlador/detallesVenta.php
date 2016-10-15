<?php 
include_once('../config/connect.php');		
$ID=$_POST['ID'];
$sql=('SELECT * from Venta left join Cliente on Venta.ID_Cliente=Cliente.ID_Cliente where ID_Venta="'.$ID.'"');
$result=mysql_query($sql);
$tupla=mysql_fetch_array($result);
if(!mysql_error()){
 echo json_encode($tupla);
}else{
	echo mysql_error();
}

?>