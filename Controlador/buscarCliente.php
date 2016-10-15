<?php
include_once('../Config/connect.php');
$data="";
$match=$_POST['match'];
switch($_GET['opc']){
	case 0:
		$sql="select id_cliente cl, nombrecliente nom, apellidop ap, apellidom am, telefono t, celular ce, descripcion dsc from cliente order by nom,ap,am;";
	break;
	case 1:
		$sql="select id_cliente cl, nombrecliente nom, apellidop ap, apellidom am, telefono t, celular ce, descripcion dsc from cliente where concat(nombrecliente,' ',apellidop,' ', apellidom) like '%" . $match . "%' order by nom,ap,am;";
	break;
}
$result=mysql_query($sql);
if(mysql_affected_rows()<1){
	$sql="select id_cliente cl, nombrecliente nom, apellidop ap, apellidom am, telefono t, celular ce, descripcion dsc from cliente order by nom,ap,am;";
	$result=mysql_query($sql);
	$data['error']='No hubo resultados en su búsqueda';
}
$data['contenido']='';
while($row=mysql_fetch_array($result)){
	$data['contenido'].='
	<tr>
		<td>' . $row['cl'] . '</td>
		<td>' . $row['nom'] . '</td>
		<td>' . $row['ap'] . '</td>
		<td>' . $row['am'] . '</td>
		<td>' . $row['t'] . '</td>
		<td>' . $row['ce'] . '</td>
		<td>' . $row['dsc'] . '</td>
		<td>
            <div class="btn-group btn-group-xs" data-toggle="modal" data-target="#detalle">
            <button type="button" div class="btn btn-default detalles" value="' . $row['cl'] . '">
                <span class="glyphicon glyphicon-list-alt">
                </span>
            </div>

            <div class="btn-group btn-group-xs" data-toggle="modal" data-target="#editar">
            <button type="button" div class="btn btn-default editar" value="' . $row['cl'] . '">
                <span class="glyphicon glyphicon-pencil">
                </span>
            </div>
            <div class="btn-group btn-group-xs" data-toggle="modal" data-target="#facturar">
            <button type="button" div class="btn btn-default facturacion" value="' . $row['cl'] . '">
                <span class="glyphicon glyphicon-qrcode">
                </span>
            </div>
        </td>
	</tr>
	';
}
echo json_encode($data);
?>