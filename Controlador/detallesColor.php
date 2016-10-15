<?php
switch($_GET['opc']){
	case 'editar':
		include_once('../config/connect.php');
		$sql="select * from Color where ID_Color='" . $_POST['ID'] . "'";
		$result=mysql_query($sql);
        $tupla=mysql_fetch_array($result);
        if(!mysql_error()){
            echo json_encode($tupla);
        }else{
            echo mysql_error();
        }
		
	break;
};		
?>