<?php
include_once('../Config/connect.php');
$sql="select RFC 'RFC',RAZONSOCIAL 'RAZON SOCIAL',CALLE 'CALLE',Nointerior 'No',NoExterior 'No Ext',COLONIA 'COLONIA',CODIGOPOSTAL 'CODIGO POSTAL',CIUDAD 'CIUDAD',ESTADO 'ESTADO',Correoelectronico 'EMAIL' from datosfacturacion where id_cliente='" . $_POST['id'] . "';";
$result=mysql_query($sql);
if(!mysql_error()){
	$data['contenido']='';
	while($row=mysql_fetch_array($result)){
		$data['contenido'].='<tr>
			<td>' . $row['RFC'] . '</td>
	        <td>' . $row['RAZON SOCIAL'] . '</td>
	        <td>' . $row['CALLE'] . '</td>
	        <td>' . $row['No'] . '</td>
	        <td>' . $row['No Ext'] . '</td>
	        <td>' . $row['COLONIA'] . '</td>
	        <td>' . $row['CODIGO POSTAL'] . '</td>
	        <td>' . $row['CIUDAD'] . '</td>
	        <td>' . $row['ESTADO'] . '</td>
	        <td>' . $row['EMAIL'] . '</td>
        </tr>';
	}
}
else{
	$data['error']="Hay un problema al encontrar la información solicitada\n" . mysql_error();
}
echo json_encode($data);
?>