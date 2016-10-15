
<?php
include_once('../Config/connect.php');
$nombre=strtoupper(ltrim($_POST['nombre']));
$ap=strtoupper(ltrim($_POST['apellidop']));
$am=strtoupper(ltrim($_POST['apellidom']));
$tel=ltrim($_POST['tel']);
$cel=ltrim($_POST['cel']);
$fecha=$_POST['fecha'];
$coments=$_POST['coments'];
$sql="CALL AnadirCliente ('" . $nombre . "','" . $ap . "','" . $am . "','" . $tel . "','" . $cel . "','" . $fecha . "','" . $coments . "');";
echo $sql;
mysql_query($sql);
if(mysql_error()){
		echo "Mensaje de error " . mysql_error();
	}else{
		echo "Datos agregados correctamente";
	}		
?>
