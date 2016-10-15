<?php
include_once('../Config/connect.php');
switch($_GET['opc']){
	case 1:
		$sql='select precio t from producto where id_producto="' . $_POST['id'] . '";';
		$precio=mysql_fetch_array(mysql_query($sql));
		$precio=$precio['t'];

		$sql='select id_cliente t from venta where id_venta=' . $_POST['venta'] . ';';
		$cliente=mysql_fetch_array(mysql_query($sql));
		$cliente=$cliente['t'];

		$sql='update cliente set saldomonedero=saldomonedero+' . $precio*$_POST['cantidad'] . ' where id_cliente=' . $cliente . ';';
		mysql_query($sql);
		if(mysql_error()){
			$data['error'].="\nHubo un error en la operación:\n" . mysql_error();
		}

		$sql='update producto_venta set cantidad=cantidad-' . $_POST['cantidad'] . ', subtotal=subtotal-' . $precio*$_POST['cantidad'] . 	' where id_venta = ' . $_POST['venta'] . ' and id_producto = "' . $_POST['id'] . '";';
		mysql_query($sql);
		if(mysql_error()){
			$data['error'].="\nHubo un error en la operación:\n" . mysql_error();
		}
		
		$sql='update  producto set existenciatienda=existenciatienda+' . $_POST['cantidad'] . ' where id_producto="' . $_POST['id'] . '";';
		mysql_query($sql);
		if(mysql_error()){
			$data['error'].="\nHubo un error en la operación:\n" . mysql_error();
		}
		else{
			$data['mensaje'].="\nOperación realizada exitosamente";
		}
		echo json_encode($data);
		// print_r($_POST);
	case 2:
}
?>