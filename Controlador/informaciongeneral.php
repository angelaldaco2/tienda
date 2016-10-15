<?php
switch($_GET['opc'])
{
	case 0:
		include_once('../Config/connect.php');
		echo $sql='select existenciatienda et from producto where id_producto="' . $_POST['id'] . '";';
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		echo $row['et'];
		break;
}
?>