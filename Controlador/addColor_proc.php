
<?php

$ID=strtoupper(ltrim($_POST['ID']));
$nombre=strtoupper(ltrim($_POST['nombre']));
$sql="CALL AnadirColor ('". $ID . "','". $nombre ."')";
include_once('../Config/connect.php');
mysql_query($sql);
echo $sql;
if(mysql_error()){
		echo "Mensaje de error " . mysql_error();
	}else{

	}	
?>
