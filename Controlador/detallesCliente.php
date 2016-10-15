<?php 
include_once('../config/connect.php');
$ID=$_POST['ID'];
$sql=('SELECT * FROM Cliente WHERE ID_Cliente="'.$ID.'"');
$result=mysql_query($sql);
$tupla=mysql_fetch_array($result);
if(!mysql_error()){
echo json_encode($tupla);
}
?>