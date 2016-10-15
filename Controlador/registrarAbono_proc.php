<?php 
	include_once('../Config/connect.php');
	$claveap=$_POST['clave'];
	$montoefectivo=$_POST['efectivo'];
	$montotarjeta=$_POST['tarjeta'];
	$montomonedero=$_POST['monedero'];
	
	//if(preg_match('/^[[:digit:]]*\.{0,1}[[:digit:]]+$/',$monto)){
		$monto=(double)$monto;
		$sql="CALL RegistrarAbonoApartado (" . $claveap . "," . $montoefectivo . "," . $montotarjeta . "," . $montomonedero . ");";
			mysql_query($sql);
			//echo $sql;
			if(mysql_error()){
				echo mysql_error();
			}
			else{
				echo false;
			}
	//}else{
		//echo 'Valor no numérico';
	//}
?>