<?php
switch($_GET['opc']){
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
		//echo likes('v',explode(" OR ",$val));
		$sql='select ID_Venta, NombreCliente, ApellidoP, ApellidoM, FechaVenta, TotalVenta 
		from Venta left join Cliente
	    on Venta.ID_Cliente=Cliente.ID_Cliente 
	   where ' . likes('ID_Venta',explode(" OR ",$val)) . ' OR
	    ' . likes('NombreCliente',explode(" OR ",$val)) . ' OR
	    ' . likes('ApellidoP',explode(" OR ",$val)) . ' OR
	    ' . likes('ApellidoM',explode(" OR ",$val));


	    
		$res=mysql_query($sql);
		echo mysql_error();
		if(mysql_affected_rows()>0){
			while($otmp=mysql_fetch_object($res)){?>
			    <tr>
			        <td><?=htmlentities ($otmp->ID_Venta);?></td>
			        <td><?=htmlentities ($otmp->FechaVenta);?></td>
			        <td><?=htmlentities ($otmp->TotalVenta);?></td>
			         <td><?=htmlentities ($otmp->NombreCliente);?>&nbsp;<?=($otmp->ApellidoP);?>&nbsp;<?=($otmp->ApellidoM); ?></td>
			        <td>
			        	<div class="btn-group btn-group-xs" data-toggle="modal" data-target="#detalle">
			                <button type="button" div class="btn btn-default ventas" value="<?php echo $otmp->ID_Venta;?>">
			                    <span class="glyphicon glyphicon-list-alt"></span>
			            </div>
			            <div class="btn-group btn-group-xs" data-toggle="modal" data-target="#producto">
			                <button type="button" div class="btn btn-default productos" value="<?php echo $otmp->ID_Venta;?>">
			                    <span class="glyphicon glyphicon-list"></span>
			            </div>
			            <div class="btn-group btn-group-xs" data-toggle="modal" data-target="#detalle">
			                <button type="button" class="btn btn-default ventas" value="<?php echo $otmp->v;?>">
			                    <span class="glyphicon glyphicon-list-alt"></span>
			            </div>
			        </td>
			   </tr>
			<? }#while */
	    }else{
	    	echo "<h1>No hay resultados</h1>";
	    }
	break;
};
?>