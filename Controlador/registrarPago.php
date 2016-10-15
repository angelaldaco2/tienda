<?php 
include_once('../Config/connect.php');
$idProd=$_POST['idProd'];
$idCliente=$_POST['ID_Cliente'];
$cantidad=$_POST['cantidad'];
$precio=$_POST['precio'];
$promocion=$_POST['promocion'];
$tipoPago=$_POST['tipoPago'];
$apagar=$_POST['apagar'];
$mefectivo=$_POST['mefectivo'];
$f=count($idProd);
$ta=0;
$tp=0;

/******************Validate*********************/
/*for( $i=0; $i<=$($f-1); $i++){
	$id=$idProd[$i];
	for( $j=$i+1; $j<=$($f-1); $j++){
		if($id==$idProd[$j]){
			unset($idProd[$j]);
			$cantidad[$i]+=$cantidad[$j];
			unset($cantidad[$j]);
			unset($precio[$j]);
			unset($promocion[$j]);
		}
	}
}*/
foreach($idProd as $id){
	$sql='select * from producto where ID_Producto="' . $id . '"';
	mysql_query($sql);
	if(mysql_affected_rows()<1){
		echo "No existe el producto " . $id . "\n" . $sql;
		exit;
	}
}
$sql='select * from cliente where ID_Cliente=' . $idCliente;
mysql_query($sql);
if(mysql_affected_rows()<1){
	echo "No existe el Cliente ".$idCliente;
	exit;
}
/******************Validate*********************/
$sql="";


for( $i=0; $i<=($f-1); $i++){
	$subTotal=$cantidad[$i] * $precio[$i];
	$total+=$subTotal;
	if($promocion[$i] > 0){
		$proMon=$promocion[$i]/100;
	}else{
		$proMon=0;
	}
	$cmonedero=$cantidad[$i] * $precio[$i] * $proMon;
	$totalMonedero+=$cmonedero;
	$sql.='insert into producto_venta(ID_Producto,ID_Venta,Cantidad,Precio,Subtotal,SubTotalMonedero) values("' . $idProd[$i] . '","mysql_insert_id()", ' . $cantidad[$i] . ', ' . $precio[$i] . ', ' . $subTotal . ',' . $cmonedero . ');';
}
if($tipoPago==1){
	$sql2="insert into venta (FechaVenta, TotalVenta, ID_Cliente, TipoPago, MontoEfectivo, MontoMonedero, TotalMonedero) values(CURDATE(), " . $total . "," . $idCliente . ",'EFECTIVO'," . $apagar .  ",";
	$sql2.= $total-$apagar;
	$sql2.= "," . $totalMonedero . ");";
	mysql_query($sql2);
	echo mysql_error();
}
if($tipoPago==2){
	$sql2="insert into venta (FechaVenta, TotalVenta, ID_Cliente, TipoPago, MontoTarjeta, MontoMonedero, TotalMonedero) values(CURDATE(), " . $total . "," . $idCliente . ",'TARJETA'," . $apagar .  ",";
	$sql2.= $total-$apagar;
	$sql2.= "," . $totalMonedero . ");";
	mysql_query($sql2);
	echo mysql_error();
}
if($tipoPago==3){
	$mixto=$apagar-$mefectivo;
	$sql2="insert into venta (FechaVenta, TotalVenta, ID_Cliente, TipoPago, MontoEfectivo, MontoTarjeta, MontoMonedero, TotalMonedero) values(CURDATE(), " . $total . "," . $idCliente . ",'MIXTO'," . $mefectivo . "," . $mixto .  ",";
	$sql2.= $total-$apagar;
	$sql2.= "," . $totalMonedero . ");";
	mysql_query($sql2);
	echo mysql_error();
}
$row=mysql_fetch_array(mysql_query('select ID_Venta from venta order by ID_Venta DESC LIMIT 1;'));
$sql=str_replace('mysql_insert_id()',$row['ID_Venta'],$sql);
mysql_query($sql);
echo mysql_error();
?>