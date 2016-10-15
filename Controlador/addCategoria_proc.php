
<?php
include_once('../Config/connect.php');
print_r($_POST);
$clavecat=strtoupper(ltrim($_POST['ID_Categoria']));
$nomcat=strtoupper(ltrim($_POST['nombre']));

$sql="CALL AnadirCategoria ('" . $clavecat . "','" . $nomcat . "');";

mysql_query($sql);
if(mysql_error()){
		echo "Mensaje de error " . mysql_error();
	}else{

	}	
?>