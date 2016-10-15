<?php
switch($_GET['opc']){
	case 1:
		include_once('../config/connect.php');
		$ID=$_POST['ID'];
		$sql=('SELECT * FROM Apartado WHERE ID_Apartado="'.$ID.'"');
		$result=mysql_query($sql);
		$tupla=mysql_fetch_array($result);
		if(!mysql_error()){
			echo json_encode($tupla);
		}
	break;
	case 2:
		include_once('../config/connect.php');
		$ID=$_POST['ID'];
		$sql=('SELECT FechaAbono f,MontoEfectivo e,MontoTarjeta t,MontoMonedero m FROM abono WHERE ID_Apartado="'.$ID.'"');
		$result=mysql_query($sql);
		while($row=mysql_fetch_array($result)){
			echo '<tr><td>' . $row['f'] . '</td><td>' . $row['e'] . '</td><td>' . $row['t'] . '</td><td>' . $row['m'] . '</td></tr>';
		}
	break;
	case 3:
		include_once('../config/connect.php');
		$ID=$_POST['ID'];
		echo $sql=('SELECT producto_apartado.ID_Producto id, ID_Apartado, producto_apartado.Cantidad f,producto.DescripcionProducto e,producto.Precio t,producto_apartado.Subtotal m, producto_apartado.SubPremonedero sp FROM producto_apartado JOIN producto ON producto_apartado.ID_Producto=producto.ID_Producto WHERE ID_Apartado='.$ID);
		$result=mysql_query($sql);
		while($row=mysql_fetch_array($result)){
			echo '<tr>
			<td>' . $row['e'] . '</td>
			<td>' . $row['t'] . '</td>
			<td>' . $row['f'] . '</td>
			<td>' . $row['m'] . '</td>
			<td>' . $row['sp'] . '</td>
			<td>
				<div class="btn-group btn-group-xs">
	                <button type="button" class="btn btn-default delApartado" value="' . $row['id'] . '">
	                    <span class="glyphicon glyphicon-remove-circle"></span>
	                </button>
	            </div>
            </td></tr>';
		}
	break;
	case 4:
		include_once('../config/connect.php');
		//print_r($_POST);
		$producto=$_POST['id'];
		$cantidad=$_POST['cantidad'];
		$apartado=$_POST['venta'];
		$cantidadR=mysql_fetch_array(mysql_query('select cantidad c from producto_apartado where id_producto="' . $producto . '" and id_apartado=' . $apartado . ';'));
		$cantidadR=$cantidadR['c'];
		$cantidadF=$cantidadR - $cantidad;
		//$data['error']="Errores";
		$sql='update producto_apartado set cantidad=' . $cantidadF . ', subtotal=' . $cantidadF .'*precio where id_producto="' . $producto . '" and id_apartado=' . $apartado . ';';
		mysql_query($sql);
		if(mysql_error()){
			$data['error'].="\nHubo un error al editar la cantidad y el subtotal :\n" . mysql_error();
		}
		else{
			$data['mensaje']='El proceso finalizó con éxito';
		}

		$abono=mysql_fetch_array(mysql_query('select sum(subtotal) s from producto_apartado where id_apartado=' . $apartado . ';'));
		$abono=$abono['s'];

		$abono1=mysql_fetch_array(mysql_query('select sum(montoEfectivo + montoTarjeta + montomonedero) s  from abono where id_apartado=' . $apartado . ';'));
		$abono1=$abono1['s'];

	 	if ($abono<$abono1){
			$cliente=mysql_fetch_array(mysql_query('select id_cliente i from apartado where id_apartado=' . $apartado . ';'));
			$cliente=$cliente['i'];
			$monedero=$abono1-$abono;

			$sql='update apartado set SaldoApartado=0, estado="Pagado" where id_apartado=' . $apartado . ';';
			mysql_query($sql);
			if(mysql_error()){
				$data['error'].="\nHubo un error al asignar cero al saldo del apartado :\n" . mysql_error();
			}
			else{
				$data['mensaje']='El proceso finalizó con éxito';
			}
			
			$sql='update cliente set saldomonedero=saldomonedero+' . $monedero . ' where id_cliente=' . $cliente . ';';
			mysql_query($sql);
			if(mysql_error()){
				$data['error'].="\nHubo un error al editar el saldo del monedero :\n" . mysql_error();
			}
			else{
				$data['mensaje']='El proceso finalizó con éxito';
			}
		}else{
			$abono=$abono-$abono1;
			if($abono==0){
				$sql='update apartado set SaldoApartado=' . $abono . ', estado="Pagado" where id_apartado=' . $apartado . ';';
			}else{
				$sql='update apartado set SaldoApartado=' . $abono . ' where id_apartado=' . $apartado . ';';
			}
			mysql_query($sql);
			if(mysql_error()){
				$data['error'].="\nHubo un error al editar el saldo del apartado:\n" . mysql_error();
			}
			else{
				$data['mensaje']='El proceso finalizó con éxito';
			}
		}

		/*$sql='update producto set existenciatienda=existenciatienda+' . $cantidad . ' where id_producto="' . $producto . '";';
		mysql_query($sql);
		if(mysql_error()){
			$data['error'].="\nHubo un error al editar la existencia en la tienda :\n" . mysql_error();
		}
		else{
			$data['mensaje']='El proceso finalizó con éxito';
		}*/

		$sql = 'update apartado set totalapartado=(select sum(subtotal) s from producto_apartado where id_apartado=' . $apartado . ') where id_apartado=' . $apartado . ';';
		mysql_query($sql);
		if(mysql_error()){
			$data['error'].="\nHubo un error al editar el total del apartado :\n" . mysql_error();
		}
		else{
			$data['mensaje']='El proceso finalizó con éxito';
		}

		echo json_encode($data);
	break;
	case 5:
		include_once('../config/connect.php');
		if($_POST['tipo'] == 0){
			$condicion='FechaInicio="' . $_POST['fecha'] . '"';
		}
		elseif( $_POST['tipo'] == 1 ){
			$condicion='FechaFin="' . $_POST['fecha'] . '"';
		}
		$sql='select id_apartado id, nombrecliente nombre, fechainicio inicio,fechafin fin,totalapartado total,saldoapartado saldo
		from apartado a join cliente c on
		a.id_cliente=c.id_cliente where ' . $condicion . ';';
		$result=mysql_query($sql);
		if(!mysql_error()){
			if(mysql_affected_rows()>0){
				$data['result']='';
				while($row=mysql_fetch_array($result)){
					$data['result'].='<tr>
						<td>' . $row['id'] . '</td>
						<td>' . $row['nombre'] . '</td>
						<td>' . $row['inicio'] . '</td>
						<td>' . $row['fin'] . '</td>
						<td>' . $row['total'] . '</td>
						<td>' . $row['saldo'] . '</td>
						<td></td>
					</tr>';
				}
			}
			else{
				$data['error']="No se encontraron resultados en la búsqueda";
			}
		}
		else{
			$data['error'] = "Hubo un error al realizar la búsqueda\n" . mysql_error();
		}
		echo json_encode($data);
	break;
	case 'buscar':
		function likes($campo,$val){
			if(is_array($val)){
				foreach($val as $nombre){
					$final[]=$campo . " " . $nombre;
				}
				$final=implode(" OR ", $final);
			}
			else{
				$final=$campo . " " . $val;
			}
			return $final;
		};
		include_once('../config/connect.php');
		$match=$_POST['match'];
		$match = explode(" ",$match);
		foreach($match as $val):
			if(trim($val) != ""){
				$newMatch .= "LIKE '%" . $val . "%' OR ";
			}
		endforeach;
		$val=substr($newMatch,0,-4);
		//echo likes('NombreCliente',explode(" OR ",$val));
		$sql='select ID_Apartado, NombreCliente, ApellidoP, ApellidoM, FechaInicio, FechaFin, TotalApartado, SaldoApartado 
		from Apartado left join Cliente
	    on Apartado.ID_Cliente=Cliente.ID_Cliente 
	    where ' . likes('ID_Apartado',explode(" OR ",$val)) . ' OR
	    ' . likes('NombreCliente',explode(" OR ",$val)) . ' OR
	    ' . likes('ApellidoP',explode(" OR ",$val)) . ' OR
	    ' . likes('ApellidoM',explode(" OR ",$val))/* . ' OR
	    ' . likes('FechaInicio',explode(" OR ",$val)) . ' OR
	    ' . likes('FechaFin',explode(" OR ",$val)) . ' OR
	    ' . likes('TotalApartado',explode(" OR ",$val)) . ' OR
	    ' . likes('SaldoApartado',explode(" OR ",$val))*/;
	    $res=mysql_query($sql);
	    echo mysql_error();
	    while($otmp=mysql_fetch_object($res)){?>
        <tr>
            <td><?=htmlentities ($otmp->ID_Apartado);?></td>
            <td><?=htmlentities ($otmp->NombreCliente);?>&nbsp;<?=($otmp->ApellidoP);?>&nbsp;<?=($otmp->ApellidoM); ?></td>
            <td><?=htmlentities ($otmp->FechaInicio);?></td>
            <td><?=htmlentities ($otmp->FechaFin);?></td>
            <td><?=htmlentities ($otmp->TotalApartado);?></td>
            <td><?=htmlentities ($otmp->SaldoApartado);?></td>
            <td>            
                <div class="btn-group btn-group-xs" data-toggle="modal" data-target="#detalle">
                   	<button type="button" div class="btn btn-default detalles"  value="<?php echo $otmp->ID_Apartado;?>">
                   		<span class="glyphicon glyphicon-list-alt">
    					</span>
                </div>

                <div class="btn-group btn-group-xs" data-toggle="modal" data-target="#abonar">
                    <button type="button" class="btn btn-default abonos" value="<?php echo $otmp->ID_Apartado;?>">
                        <span class="glyphicon glyphicon-usd">
                        </span>
                </div>
                 <div class="btn-group btn-group-xs" data-toggle="modal" data-target="#productos">
                    <button type="button" div class="btn btn-default productos" value="<?php echo $otmp->ID_Apartado;?>">
                        <span class="glyphicon glyphicon-list">
                        </span>
                </div>
    		</td>
       </tr>
        <?php }#while */
	break;
};		
?>