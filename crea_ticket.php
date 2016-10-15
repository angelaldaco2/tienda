<?php 
ob_end_clean();
require('fpdf.php'); //para crear el pdf
require("('../Config/connect.php");

$fecha = date(d)."/".date(m)."/".date(Y);
$hora = date(H).":".date(i).":".date(s);
$transaccion=$_REQUEST[transaccion];

mysql_select_db($mysql_database,$conexion) or die("Error");
		
$registrosX=mysql_query("select * from parametros",$conexion) or die("Error:".mysql_error());
while ($regX=mysql_fetch_array($registrosX))
      {
        $razon = utf8_decode($regX['razon_social']);
		//$rfc = $regX['rfc'];
		$domicilio = utf8_decode($regX['domicilio']);
		//$iva = $regX['iva'];
		$moneda = $regX['moneda'];
		$ancho_celda = $regX['papel_ancho'];
		
		$ancho_celda=$ancho_celda/10;
		$ancho_papel = $ancho_celda+20;
		$alto_papel = $ancho_papel*3;
		
		$pos_x = $ancho_papel/3.6;
		$tamaño = $ancho_papel/2.3;
	}
	//$iva = $iva/100;		
			
class PDF extends FPDF
{
    //Encabezado de página
    function Header()
    {   
    } 
}
        	
    $pdf=new PDF('P','mm',array($ancho_papel,$alto_papel));
    $pdf->AliasNbPages();
    $pdf->AddPage();    
	$pdf->SetFont('Arial','',10);
	
	$pdf->Image('images/Logo.png',$pos_x,10,$tamaño);
	$pdf->setY($tamaño+15);  
	$pdf->MultiCell($ancho_celda,5,$razon,0,'C');
	$pdf->MultiCell($ancho_celda,5,$domicilio,0,'C');
	$pdf->MultiCell($ancho_celda,5,/*$rfc,*/0,'C');
	$pdf->Ln(10);
	$pdf->MultiCell($ancho_celda,5,$fecha." ".$hora,0,'C');
    $pdf->Ln(10);
	
	$registros=mysql_query("select * from salidas where transaccion = '$transaccion'",$conexion) or die("Error:".mysql_error());
	while ($reg=mysql_fetch_array($registros))
      {
        $precio = $reg['precio'];
		$cantidad = $reg['cantidad'];			
		$monto = $reg['monto'];
		$codigo = $reg['codigo'];
		$folio = $reg['folio'];
		$total = $total + $monto;
		
		$registros2=mysql_query("select descripcion from articulos where codigo ='$codigo'",$conexion) or die("Error:".mysql_error());
		while ($reg2=mysql_fetch_array($registros2)){$descripcion =  utf8_decode($reg2['descripcion']);}
		
		$ancho_cantidad=$ancho_celda/7;
		$ancho_descripcion=$ancho_celda/2;
		$ancho_precio=$ancho_celda/5;
		$chars_max = $ancho_precio+10;
		
		$pdf->SetFont('Arial','',9);
		$descripcion = substr($descripcion, 0, $chars_max);
		$pdf->Cell($ancho_cantidad,5,$cantidad,0,0,'C');
		$pdf->Cell($ancho_descripcion,5,$descripcion,0,0,'L');
		$pdf->Cell($ancho_precio,5,$moneda.number_format($precio,2,".",","),0,0,'R');
		$pdf->Cell($ancho_precio,5,$moneda.number_format($monto,2,".",","),0,1,'R');
}

		$pdf->Ln(5);
		$pdf->Cell($ancho_cantidad,5,"",0,0,'C');
		$pdf->Cell($ancho_descripcion,5,"",0,0,'L');
		$pdf->Cell($ancho_precio,5,"Subtotal:",0,0,'R');
		$pdf->Cell($ancho_precio,5,$moneda.number_format(($total/($iva+1)),2,".",","),0,1,'R');
		
		$pdf->Cell($ancho_cantidad,5,"",0,0,'C');
		$pdf->Cell($ancho_descripcion,5,"",0,0,'L');
		$pdf->Cell($ancho_precio,5,"IVA:",0,0,'R');
		$pdf->Cell($ancho_precio,5,$moneda.number_format(($iva*$total),2,".",","),0,1,'R');
		
		$pdf->Cell($ancho_cantidad,5,"",0,0,'C');
		$pdf->Cell($ancho_descripcion,5,"",0,0,'L');
		$pdf->Cell($ancho_precio,5,"Total:",0,0,'R');
		$pdf->Cell($ancho_precio,5,$moneda.number_format($total,2,".",","),0,1,'R');
		
		$pdf->Ln(5);
		$pdf->Cell($ancho_celda,5,"#TR: ".$transaccion,0,1,'C');
		$pdf->Ln(5);
		$pdf->Cell($ancho_celda,5,"Gracias por su compra!",0,1,'C');
		$pdf->Ln(10);
		$pdf->Cell($ancho_celda,5,".",0,1,'C');

mysql_close($conexion);	
	                           
    $pdf->Output();//muestro el pdf
?>