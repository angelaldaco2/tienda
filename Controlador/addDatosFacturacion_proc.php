<?php
include_once('../Config/connect.php');
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

//validar la información del formulario
$sql="CALL AnadirDatosFacturacion ('" . $RFC . "','".$ID_Cliente."','".$RazonSocial."','".$Calle."','".$NoEx."','".$NoIn."','".$Col."','".$CodPostal."','".$Ciudad."','".$Estado."','".$Correo."');";
if(mysql_error()){
	$data['error']="No se pudo agregar la información de facturación\n" . mysql_error();
}
else{
	$data['mensaje']="Los datos se agregaron correctamente";
}
echo json_encode($data);
?>