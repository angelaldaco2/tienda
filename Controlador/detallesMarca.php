<?php
switch($_GET['opc']){
	case 'marca':
		include_once ('../Config/connect.php');
		$sql="SELECT * FROM marca WHERE ID_Marca='" . $_POST['ID_Marca'] ."'";
		$row=mysql_fetch_array(mysql_query($sql));
		echo json_encode($row);
	break;
};
?>