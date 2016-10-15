<?php
include_once('../Config/connect.php');
$sql="SELECT ID_Producto, DescripcionProducto d  FROM Producto WHERE ExistenciaTienda>0 AND (ID_Producto LIKE '" . $_GET['term'] . "%' OR Estilo LIKE '" . $_GET['term'] . "%')";
$result=mysql_query($sql);
//echo mysql_error();
while($row=mysql_fetch_array($result)){
	$prod[]=array('label'=>$row['ID_Producto'],'desc'=>$row['d']);
}
echo json_encode($prod);
?>