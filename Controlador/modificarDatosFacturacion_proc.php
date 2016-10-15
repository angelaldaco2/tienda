<?php
	$RFC=strtoupper (ltrim($_POST['RFC']));
$ID_Cliente= ltrim ($_POST['ID_Cliente']);
$RazonSocial= strtoupper (ltrim ($_POST['RazonSocial']));
$Calle= strtoupper(ltrim($_POST['Calle']));
$NoEx=ltrim($_POST['NoEx']);
$NoIn= ltrim($_POST['NoIn']);
$Col= strtoupper(ltrim($_POST['Col']));
$CodPostal= ltrim($_POST['CodPostal']);
$Ciudad= strtoupper(ltrim($_POST['Ciudad']));
$Estado= strtoupper(ltrim($_POST['Estado']));
$Correo= $_POST['Correo'];
	
	echo $sql="CALL ModificarDatosFacturacion('" . $RFC . "'," . $ID_Cliente . ",'" . $razonSocial . "','" . $calle . "','" . $noExterior . "','" . $noInterior . "','" . $colonia . "'," . $codigoPostal . ",'" . $ciudad . "','" . $estado . "','" . $correo . "')";
	include_once ('../Config/connect.php');
	mysql_query($sql);
	if(mysql_error()){
		echo "Mensaje de error " . mysql_error();
	}else{
		echo "Datos actualizados correctamente";
	}	
?>