<?
		$CadenaSQL=('SELECT * FROM DatosFacturacion WHERE ID_Cliente="'.base64_decode($_GET['ID_Cliente']).'"');
		
		$res=mysql_query($CadenaSQL);
		if(mysql_num_rows($res)>0){
  ?>
  <table width="100%" border="0" align"center">
  	<a href="grupoDatosFacturacion.php?id=<?php echo base64_encode(4);?>&RFC=<?php echo base64_encode($otmp->RFC);?>&ID_Cliente=<?php echo $_GET['ID_Cliente']; ?>" class="iframe"><img src="images/Facturacion.png" width="52" height="52" title="Agregar datos"></a>
		</tr>
  	<tr>
    	<td width="20%"><strong>RFC</strong></td>
        <td width="20%"><strong>Acciones</strong></td>
    </tr>
    <? while($otmp=mysql_fetch_object($res)){?>
    <tr>
    	<td><?=htmlentities ($otmp->RFC);?></td>
        <td>
        <a href="grupoDatosFacturacion.php?id=<?php echo base64_encode(2);?>&RFC=<?php echo base64_encode($otmp->RFC);?>" class="iframe"><img src="images/Search.png" width="52" height="52" title="Consultar datos"></a>&nbsp;
        <a href="grupoDatosFacturacion.php?id=<?php echo base64_encode(3);?>&RFC=<?php echo base64_encode($otmp->RFC);?>" class="iframe"><img src="images/Modify.png" width="47" height="52" style="cursor:pointer" title="Modificar" ></a>
        </td>
        <tr>
        
    </tr>
    <? }#while ?>
   </table>
   <?
		}else{
	?>
    <table width="100%" border="0" align="center">
    	<tr>
        	<td align="center"><font color="#CC0000"><strong>NO SE ENCONTRARON RESULTADOS</strong></font></td>
        </tr>
        
        <tr>
        <a href="grupoDatosFacturacion.php?id=<?php echo base64_encode(4);?>&RFC=<?php echo base64_encode($otmp->RFC);?>&ID_Cliente=<?php echo $_GET['ID_Cliente']; ?>" class="iframe"><img src="images/Facturacion.png" width="52" height="52" title="Agregar datos"></a>
		</tr>
    </table>
    <?
	}#if(mysql_num_rows()}
	?>
