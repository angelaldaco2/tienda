<?php
include_once ('../Config/connect.php');
$sql='call CancelarApartado(' . $_POST['id'] . ');';
mysql_query($sql);
if(mysql_error()){
	$data['error']="Hubo un problema al eliminar el apartado\n" . mysql_error();
}
else{
	$data['mensaje']="Operación realizada correctamente";
}
echo json_encode($data);
?>