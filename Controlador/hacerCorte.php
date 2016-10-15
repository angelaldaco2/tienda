<?php
include_once('../Config/connect.php');
$cantidad=$_POST['cantidad'];
$sql="call add_corte(" . $cantidad . ");";
mysql_query($sql);
if(mysql_error()){
	$data['error'] = mysql_error();
}
else{
	$data['mensaje'] = 'Proceso terminado correctamente';
}
echo json_encode($data);
?>