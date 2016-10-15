<?php 
	include_once('../Config/connect.php');
	$desc=strtoupper($_POST['desc']);
	$monto=$_POST['monto'];
	if(preg_match('/^[[:digit:]]*\.{0,1}[[:digit:]]+$/',$monto)){
		$monto=(double)$monto;
		$sql="SELECT SaldoFinalEfectivo FROM Caja ORDER BY ID_Corte DESC LIMIT 1;";
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		if(($row['SaldoFinalEfectivo']-$monto)>=0){
			$sql="CALL RegistrarGasto ('" . $desc . "'," . $monto . ");";
			mysql_query($sql);
			//echo $sql;
			if(mysql_error()){
				echo mysql_error();
			}
			else{
				echo false;
			}
		}else{
			echo "Saldo INSUFICIENTE en caja";
		}
	}else{
		echo 'Valor no numérico';
	}
?>