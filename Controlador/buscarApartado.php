<?php
include_once('../config/connect.php');
$sql="SELECT a.ID_Venta id, a.FechaVenta fecha, a.TotalVenta total, concat(c.NombreCliente,' ',c.ApellidoP,' ',c.ApellidoM) nombre FROM tienda2.venta a join tienda2.cliente c on a.ID_Cliente = c.ID_Cliente where FechaVenta='" . $_POST['fecha'] . "';";
$result=mysql_query($sql);
if(mysql_affected_rows()>0){
	$respuesta=array();
	while($row=mysql_fetch_array($result)){
		$respuesta['contenido'] .= '<tr>
			<td>' . $row['id'] . '</td>
			<td>' . $row['fecha'] . '</td>
			<td>' . $row['total'] . '</td>
			<td>' . $row['nombre'] . '</td>
			<td>
				<div class="btn-group btn-group-xs" data-toggle="modal" data-target="#detalle">
					<button type="button" div="" class="btn btn-default ventas" value="' . $row['id'] . '">
						<span class="glyphicon glyphicon-list-alt"></span>
					</button>
				</div>
				<div class="btn-group btn-group-xs" data-toggle="modal" data-target="#producto">
					<button type="button" div="" class="btn btn-default productos" value="' . $row['id'] . '">
						<span class="glyphicon glyphicon-list"></span>
					</button>
				</div>
			</td>
		</tr>';
	}
}else{
	$sql="SELECT a.ID_Venta id, a.FechaVenta fecha, a.TotalVenta total, concat(c.NombreCliente,' ',c.ApellidoP,' ',c.ApellidoM) nombre FROM tienda2.venta a join tienda2.cliente c on a.ID_Cliente = c.ID_Cliente where FechaVenta=CURDATE();";
	$result=mysql_query($sql);
	while($row=mysql_fetch_array($result)){
		$respuesta['contenido'] .= '<tr>
			<td>' . $row['id'] . '</td>
			<td>' . $row['fecha'] . '</td>
			<td>' . $row['total'] . '</td>
			<td>' . $row['nombre'] . '</td>
			<td>
				<div class="btn-group btn-group-xs" data-toggle="modal" data-target="#detalle">
					<button type="button" div="" class="btn btn-default ventas" value="' . $row['id'] . '">
						<span class="glyphicon glyphicon-list-alt"></span>
					</button>
				</div>
				<div class="btn-group btn-group-xs" data-toggle="modal" data-target="#producto">
					<button type="button" div="" class="btn btn-default productos" value="' . $row['id'] . '">
						<span class="glyphicon glyphicon-list"></span>
					</button>
				</div>
			</td>
		</tr>';
	}
	$respuesta['mensaje']='No se encontró la busqueda';
}
echo json_encode($respuesta);
?>