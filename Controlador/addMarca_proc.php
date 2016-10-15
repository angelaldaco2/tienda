
<?php

$ID=strtoupper(ltrim($_POST['ID']));
$nombre=strtoupper(ltrim($_POST['nombre']));
$tel=strtoupper(ltrim($_POST['tel']));
$email=(ltrim($_POST['email']));
$web=strtoupper(ltrim($_POST['web']));
$sql="CALL AnadirMarca ('" . $ID . "','" . $nombre . "','" . $tel . "','" . $email . "','" . $web . "')";
include_once('../Config/connect.php');
mysql_query($sql);
if(mysql_error()){
		echo "Mensaje de error " . mysql_error();
	}else{

	}	
?>