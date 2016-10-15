<?php 
include_once('../Config/connect.php');
$idProd=$_POST['idProd'];
$idCliente=$_POST['ID_Cliente'];
$cantidad=$_POST['cantidad'];
$precio=$_POST['precio'];
$promocion=$$_POST['promocion'];
$f=count($idProd);
$ta=0;
$tp=0;
for( $i=0; $i<=($f-1); $i++){
	if($promocion>0){
		$monedero=$promocion/100;
	}else{
		$monedero=0;
	}
	$st=$cantidad[$i] * $precio[$i];
	$ta+=$st;
	$tt=$cantidad[$i] * $precio[$i] * $monedero;
	$tp+=$tt;
	$sql.='insert into producto_apartado(ID_Producto,ID_Apartado,Cantidad,Precio,Subtotal,SubPremonedero) values("' . $idProd[$i] . '",mysql_insert_id(), ' . $cantidad[$i] . ', ' . $precio[$i] . ', ' . $st . ',' . $tt . ');';
}
$sql2="insert into apartado (FechaInicio, FechaFin, FechaDescuento, TotalApartado, ID_Cliente, Estado, TotalPremonedero, TipoApartado, SaldoApartado) 
values(CURDATE(),DATE_SUB(CURDATE(),INTERVAL -1 MONTH),DATE_SUB(CURDATE(),INTERVAL -1 MONTH)," . $ta . "," . $idCliente . ",'Pendiente'," . $tp . ",'Normal'," . $ta . ");";
mysql_query($sql2);
if(mysql_error()){
	$datos['error']=mysql_error();
}
$row=mysql_fetch_array(mysql_query('select ID_Apartado from apartado order by ID_Apartado DESC LIMIT 1;'));
$sql=str_replace('mysql_insert_id()',$row['ID_Apartado'],$sql);
mysql_query($sql);
if(mysql_error()){
	$datos['error']=mysql_error();
}
if( !array_key_exists('error',$datos) ){
	$datos['id']=$row['ID_Apartado'];
	$datos['total']=$ta;
}
echo json_encode($datos);
?>