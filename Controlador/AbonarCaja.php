<?php
	include_once('../Config/connect.php');
	$totalcaja=$_POST['totalcaja'];
	$ID_Corte=$_POST['ID_Corte'];
	$monto=$_POST['abono'];
	$nuevosaldo=$totalcaja+$monto;
	
	$sql="CALL AbonarCaja (" . $ID_Corte . "," . $nuevosaldo . ");";
	//echo $sql.'<br>';
	mysql_query($sql);
	if (mysql_error()){	
		echo false;
	}
	else{
		include_once('../../Config/connect.php');
		$sql=('select ID_Corte, SaldoFinalEfectivo from caja order by ID_Corte desc limit 1;');
		$result=mysql_query($sql);
		$saldocaja=mysql_fetch_array($result);
		$ID_Corte=$saldocaja['ID_Corte'];

	}
?>