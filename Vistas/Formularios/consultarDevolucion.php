<script type="text/javascript">$(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>

<?
		$CadenaSQL="select * from Venta where 1=1";
		
		$res=mysql_query($CadenaSQL);
		
  ?>
  <div class="col-xs-12">
	<legend>Devoluciones</legend>
</div>
  <table id="table_id" class="display">
    <thead>
        <tr>
            <th>Numero de Venta</th>
            <th>Fecha</th>
            <th>Total de la venta</th>
            <th>Cliente</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
   	<?php while($otmp=mysql_fetch_object($res)){?>
    <tr>
            <td><?=htmlentities ($otmp->ID_Venta);?></td>
        <td><?=htmlentities ($otmp->FechaVenta);?></td>
        <td><?=htmlentities ($otmp->TotalVenta);?></td>
        <td><?=htmlentities ($otmp->ID_Cliente);?></td>
        <td>
                <div class="btn-group btn-group-xs">
                	<a href="grupoApartado.php?id=<?php echo base64_encode (2);?>"  class="btn btn-default">
                        <span class="glyphicon glyphicon-star"></span>
                    </a>
                </div>
                <div class="btn-group btn-group-xs">
                	<a href="grupoApartado.php?id=<?php echo base64_encode (3);?>"  class="btn btn-default">
                        <span class="glyphicon glyphicon-star"></span>
                    </a>
                </div>
                </td>
   </tr>
   
        <? }#while ?>
    </tbody>
   </table>
