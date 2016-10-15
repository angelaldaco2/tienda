<?php
switch($_GET['opc']){
	case 0:
		$ID_Cliente=$_POST['ID_Cliente'];
		$nombre=$_POST['nombre'];
		$apellidop=$_POST['apellidop'];
		$apellidom=$_POST['apellidom'];
		$tel=$_POST['tel'];
		$cel=$_POST['cel'];
		$fecha=$_POST['fecha'];
		$promo=$_POST['promo'];
		
		$sql="CALL ModificarCliente(" . $ID_Cliente . ",'" . $nombre . "','" . $apellidop . "','" . $apellidom . "','" . $tel . "','" . $cel . "','" . $fecha . "'," . $promo . ")";
		echo $sql;
		include_once ('../Config/connect.php');
		mysql_query($sql);
		if(mysql_error()){
			echo "Mensaje de error " . mysql_error();
		}
		else{
			echo "Datos actualizados correctamente";
		}
	break;
	case 1:
	include_once ('../Config/connect.php');
		$sql='update cliente set descripcion="' . $_POST['texto'] . '" where ID_Cliente=' . $_POST['id'];
		mysql_query($sql);
		if(mysql_error()){
			$data['error']="Ocurrió un error al editar la descripcion del cliente\n" . mysql_error();
			echo json_encode($data);
		}

	break;
}
?>