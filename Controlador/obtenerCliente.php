 <?php 
 switch($_GET['opc']){
	 case 1:
	 $id=$_POST['ID_Cliente'];
	 	include_once('../Config/connect.php');
		$sql="select saldoMonedero, Promocion from cliente where ID_Cliente=". $id .";" ;
		$result=mysql_query($sql);
		if(mysql_error()){
			echo mysql_error();
		}else{
			$row=mysql_fetch_array($result);
			unset($row[0]);
			echo json_encode($row);
		}
	 break;
	 case 2:
		include_once('../Config/connect.php');
		$sql="SELECT ID_Cliente, NombreCliente, ApellidoP, ApellidoM FROM Cliente WHERE  CONCAT( NombreCliente, ApellidoP, ApellidoM) LIKE '%" . $_GET['term'] . "%'";
		$result=mysql_query($sql);
		while($row=mysql_fetch_array($result)){
			//$prod[$row['ID_Cliente']]=$row['NombreCliente'] . " " . $row['ApellidoP'] . " " . $row['ApellidoM'];
			$prod[] = array("value" => $row['NombreCliente'] . " " . $row['ApellidoP'] . " " . $row['ApellidoM'],
                            "ID_Cliente" => $row['ID_Cliente']);
		}
		echo json_encode($prod);
	 break;
	 default:
	 	echo 'false';
	 
}	
?>
            