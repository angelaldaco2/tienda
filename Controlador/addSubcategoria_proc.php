
<?php
include_once('../Config/connect.php');
print_r($_POST);
$clavesubcat=strtoupper(ltrim($_POST['ID']));
$nomsubcat=strtoupper(ltrim($_POST['nombre']));

$sql="CALL AnadirSubcategoria ('" . $clavesubcat . "','" . $nomsubcat . "');";
mysql_query($sql);
	if(mysql_error())
		echo "Mensaje de error " . mysql_error();
?>
