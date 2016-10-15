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
		$CadenaSQL="select * 
	    from producto
	    where ".likes('producto.ID_Producto',explode(" OR ",$val));
	    echo mysql_error();
		$res=mysql_query($CadenaSQL);
		if(mysql_affected_rows()>0){
			while($otmp=mysql_fetch_object($res)){?>
        <tr>
        	<td><?=htmlentities ($otmp->ID_Producto);?></td>
            <td><?=htmlentities (utf8_decode($otmp->DescripcionProducto));?></td>
            <td><?=htmlentities ($otmp->Precio);?></td>
            <td><?=htmlentities ($otmp->Promocion);?></td>
            <td><?=htmlentities ($otmp->ExistenciaTienda);?></td>
            
            <td>
                <div class="btn-group btn-group-xs" data-toggle="modal" data-target="#detalle">
                    <button type="button" div class="btn btn-default detalles" value="<?php echo $otmp->ID_Producto;?>">
                        <span class="glyphicon glyphicon-list-alt">
                        </span>
                    </div>

                    <div class="btn-group btn-group-xs" data-toggle="modal" data-target="#editar">
                    <button type="button" div class="btn btn-default editars" value="<?php echo $otmp->ID_Producto;?>">
                        <span class="glyphicon glyphicon-pencil">
                        </span>
                    </div>
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