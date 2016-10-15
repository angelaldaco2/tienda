<?php 
include_once('../Config/connect.php');
$id=$_POST['ID_Producto'];
$sql='select * from Producto where ID_Producto="' . $id . '"';
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if(mysql_num_rows($result)>0){
	$producto=array('ID_Producto' => $row['ID_Producto'], 'Descripcion' => $row['DescripcionProducto'],'Precio'=>$row['Precio'],'cantidad'=>$row['ExistenciaTienda']);
	echo json_encode($producto);
}
?>