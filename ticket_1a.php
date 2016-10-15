<?php
require('pdf_js.php');
require("Config/connect.php");
// se obtiene la fecha del día.
$fecha = date(d)."/".date(m)."/".date(Y);
$hora = date(H).":".date(i).":".date(s);
$transaccion=mysql_fetch_array(mysql_query("SELECT ID_Apartado id FROM Apartado ORDER BY ID_Apartado DESC LIMIT 1")) or die ("Error:Al obtener la venta".mysql_error());//$_REQUEST[transaccion];
$transaccion=$transaccion['id'];
// ************ Se obtienen los datos de la empresa
$registrosX=mysql_query("select * from parametros") or die("Error:1".mysql_error());
while ($regX=mysql_fetch_array($registrosX))
      {
        $razon = $regX['razon_social'];
        $rfc = $regX['rfc'];
        $col = $regX['colonia'];
        $tel = $regX['tel'];
        $edo = $regX['estado'];
        $domicilio = utf8_decode($regX['domicilio']);
        //$iva = $regX['iva'];
        $moneda = $regX['moneda'];
        $ancho_celda = $regX['papel_ancho'];
        
        $ancho_celda=$ancho_celda/10; //60
        $ancho_papel = $ancho_celda+20; //80
        $alto_papel = $ancho_papel*3; //240
        
        $pos_x = $ancho_papel/3.6; //22.2
        $tamaño = $ancho_papel/2.3; //34.78
    }
class PDF_AutoPrint extends PDF_JavaScript
{
function AutoPrint($dialog=false)
{
    //Open the print dialog or start printing immediately on the standard printer
    $param=($dialog ? 'true' : 'false');
    $script="print($param);";
    $this->IncludeJS($script);
}

function AutoPrintToPrinter($server, $printer, $dialog=false)
{
    //Print on a shared printer (requires at least Acrobat 6)
    $script = "var pp = getPrintParams();";
    if($dialog)
        $script .= "pp.interactive = pp.constants.interactionLevel.full;";
    else
        $script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
    $script .= "pp.printerName = '\\\\\\\\".$server."\\\\".$printer."';";
    $script .= "print(pp);";
    $this->IncludeJS($script);
}
}

$pdf=new PDF_AutoPrint('P','mm',array($ancho_papel,$alto_papel));
    $pdf->AliasNbPages();
    $pdf->AddPage();    
    $pdf->SetFont('Courier','',9);
    // Logo de la empresa
    $pdf->Image('images/Logo1.png',$pos_x,10,$tamaño);
    $pdf->setY($pos_x+10);
    // Datos de la empresa  
    $pdf->MultiCell($ancho_celda,5,"**".$razon."**",0,'C');
    $pdf->MultiCell($ancho_celda,5,$domicilio,0,'C');
    $pdf->MultiCell($ancho_celda,5,$col . "," . " " . $edo,0,'C');
    $pdf->MultiCell($ancho_celda,5,$rfc,0,'C');
    $pdf->MultiCell($ancho_celda,5,$tel,0,'C');
    $pdf->Ln(5);
    $pdf->MultiCell($ancho_celda,5,$fecha." ".$hora,0,'C');
    $pdf->Ln(5);
    
    //Se obtienen los datos de la venta.
    $registros=mysql_query("select * from Apartado left join Cliente on Apartado.ID_Cliente=Cliente.ID_Cliente where ID_Apartado = '". $transaccion ."'") or die("Error:2".mysql_error());
    while ($reg=mysql_fetch_array($registros))
    {
        $TotalA = $reg['TotalApartado'];
        $FechaI = $reg['FechaInicio'];
        $FechaF = $reg['FechaFin'];
        $TotalPM = $reg['TotalPremonedero'];
        $Saldo = $reg['SaldoApartado'];
        $FechaD = $reg['TotalMonedero'];
        $Cliente = $reg['NombreCliente'] . " " . $reg['ApellidoP'];
        $ID_Cliente = $reg['ID_Cliente'];
        $SMonedero = $reg['SaldoMonedero'];
        

        //$cantidad = $reg['Cantidad'];         

        $ancho_cantidad=$ancho_celda/7;
        $ancho_descripcion=$ancho_celda/2;
        $ancho_precio=$ancho_celda/5;
        $chars_max = $ancho_precio+10;
    
        $pdf->SetFont('Courier','',8);
        $descripcion = substr($descripcion, 0, $chars_max);

        //Encabezado de los conceptos de compra
        $pdf->Cell($ancho_cantidad,5,"Cant.",0,0,'L');
        $pdf->Cell($ancho_descripcion,5,utf8_decode("Descripción"),0,0,'C');
        $pdf->Cell($ancho_precio,5,"Precio",0,0,'C');
        $pdf->Cell($ancho_precio,5,"Subt.",0,1,'C');
        
        // se obtienen los datos de los producto.

        $registros2=mysql_query("select * from producto left join Producto_apartado on producto.ID_Producto=Producto_apartado.ID_Producto where ID_Apartado ='". $transaccion ."'") or die("Error:3".mysql_error());
        while ($reg2=mysql_fetch_array($registros2)){
            $descripcion =  utf8_decode($reg2['DescripcionProducto']);
            $cantidad = $reg2['Cantidad'];
            $precio = $reg2['Precio'];
            $monto= $reg2['Subtotal'];
        
            $ancho_cantidad=$ancho_celda/7;
            $ancho_descripcion=$ancho_celda/2;
            $ancho_precio=$ancho_celda/5;
            $chars_max = $ancho_precio+10;
        // Se ponen los conceptos de compra

            $pdf->SetFont('Arial','',8);
            //$descripcion = substr($descripcion, 0, $chars_max);
            $pdf->Cell($ancho_cantidad,5,$cantidad,0,0,'L');
            if(strlen($descripcion)>19)
            {
                $descripcion=substr($descripcion,0,16);
                $descripcion.="...";
            }

            $pdf->Cell($ancho_descripcion,5,$descripcion,0,0,'C');
            $pdf->Cell($ancho_precio,5,$moneda.number_format($precio,2,".",","),0,0,'C');
            $pdf->Cell($ancho_precio,5,$moneda.number_format($monto,2,".",","),0,1,'R');
        }

        $registros3=mysql_query("select * from abono where ID_Apartado ='". $transaccion ."'") or die("Error:4".mysql_error());
        while ($reg3=mysql_fetch_array($registros3)){
            $Abono = $reg3['ID_Abono'];
            $ME = $reg3['MontoEfectivo'];
            $MT = $reg3['MontoEfectivo'];
            $MM = $reg3['MontoEfectivo'];
            $TotalA= $ME+$MT+$MM;
            $FechaA=$reg3['FechaAbono'];
        
            $ancho_cantidad=$ancho_celda/7;
            $ancho_descripcion=$ancho_celda/2;
            $ancho_precio=$ancho_celda/5;
            $chars_max = $ancho_precio+10;

            $pdf->Cell($ancho_cantidad,5,"Abono",0,0,'L');
            $pdf->Cell($ancho_descripcion,5,"Total Abono",0,0,'C');
            $pdf->Cell($ancho_precio,5,"Fecha Abono",0,0,'C');
            $pdf->Cell($ancho_precio,5,"",0,1,'C');
        // Se ponen los conceptos de compra

            $pdf->SetFont('Arial','',8);
            //$descripcion = substr($descripcion, 0, $chars_max);
            $pdf->Cell($ancho_cantidad,5,$Abono,0,0,'L');
            $pdf->Cell($ancho_descripcion,5,$descripcion,0,0,'C');
            $pdf->Cell($ancho_precio,5,$moneda.number_format($precio,2,".",","),0,0,'C');
            $pdf->Cell($ancho_precio,5,$moneda.number_format($monto,2,".",","),0,1,'R');
        }
}

        $pdf->MultiCell($ancho_celda,5,"===================================",0,'C');
        $pdf->Cell($ancho_cantidad,5,"",0,0,'C');
        $pdf->Cell($ancho_descripcion,5,"TOTAL COMPRA:",0,0,'L');
        $pdf->Cell($ancho_precio,5,"",0,0,'L');
        $pdf->Cell($ancho_precio,5,$moneda.number_format($Total,2,".",","),0,1,'R');
        //Poner el pinchi tipo de pago
        $pdf->Cell($ancho_cantidad,5,"",0,0,'C');
        $pdf->Cell($ancho_descripcion,5,"TIPO PAGO",0,0,'L');
        $pdf->Cell($ancho_precio,5,"",0,0,'L');
        $pdf->Cell($ancho_precio,5,$TPago,0,1,'R');
        if ($MMonedero>0)
        {
            $pdf->Cell($ancho_cantidad,5,"",0,0,'C');
            $pdf->Cell($ancho_descripcion,5,"PAGO MONEDERO",0,0,'L');
            $pdf->Cell($ancho_precio,5,"",0,0,'L');
            $pdf->Cell($ancho_precio,5,$moneda.number_format($MMonedero,2,".",","),0,1,'R');
        }
        //Pago Mixto
        if($TPago=="MIXTO")
        {
            $pdf->Cell($ancho_cantidad,5,"",0,0,'C');
            $pdf->Cell($ancho_descripcion,5,"EFECTIVO",0,0,'L');
            $pdf->Cell($ancho_precio,5,"",0,0,'L');
            $pdf->Cell($ancho_precio,5,$moneda.number_format($MEfectivo,2,".",","),0,1,'R');

            $pdf->Cell($ancho_cantidad,5,"",0,0,'C');
            $pdf->Cell($ancho_descripcion,5,"TARJETA",0,0,'L');
            $pdf->Cell($ancho_precio,5,"",0,0,'L');
            $pdf->Cell($ancho_precio,5,$moneda.number_format($MTarjeta,2,".",","),0,1,'R');
        }
        if ($ID_Cliente!=1 && $SaldoMonedero>0)
        {
            $pdf->Cell($ancho_cantidad,5,"",0,0,'C');
            $pdf->Cell($ancho_descripcion,5,"SALDO MONEDERO:",0,0,'L');
            $pdf->Cell($ancho_precio,5,"",0,0,'L');
            $pdf->Cell($ancho_precio,5,"",0,1,'R');
            //Poner el pinchi Cliente
            $pdf->Cell($ancho_cantidad,5,"",0,0,'C');
            $pdf->Cell($ancho_descripcion,5,$Cliente,0,0,'L');
            $pdf->Cell($ancho_precio,5,"",0,0,'L');
            $pdf->Cell($ancho_precio,5,$SMonedero,0,1,'R');
        }
        $pdf->MultiCell($ancho_celda,5,"===================================",0,'C');

        

        //Ultimas lineas del ticket
        $pdf->Ln(5);
        $pdf->Cell($ancho_celda,5,"#Apartado: ".$transaccion,0,1,'C');
        $pdf->Ln(5);
        $pdf->Cell($ancho_celda,5,utf8_decode("¡Gracias por su compra!"),0,1,'C');

mysql_close($conexion); 
    $pdf->AutoPrint(true);                  
    $pdf->Output();//muestro el pdf
?>
?>
