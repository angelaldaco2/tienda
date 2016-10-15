<?php
 
	$CadenaSQL="select venta.ID_Venta v, venta.FechaVenta f, venta.TotalVenta t, cliente.nombreCliente n, cliente.ApellidoP ap, cliente.ApellidoM am 
    from Venta JOIN cliente on venta.ID_Cliente = cliente.ID_Cliente where FechaVenta=curdate()";
    echo mysql_error();
	$res=mysql_query($CadenaSQL);
    $hoy = "select curdate()";
    echo mysql_error();
    $res2=mysql_query($hoy);
?>
<div class="col-xs-12">
	<legend>Ventas Realizadas</legend>
</div>
<div class="row">
    <div class="col-xs-3 col-xs-offset-7">
        <input type="date" value="<?php echo date('Y-m-d'); ?>" id="buscaTabla" placeholder="Búsqueda" class="form-control ui-autocomplete-input">
    </div>
    <div class="col-xs-2">
        <a href="#" class="btn btn-default buscaventa">Buscar</a>
    </div>
</div>
<div class="scroll col-xs-12" >
  <table class="table table-bordered table-hover orig">
    <thead>
        <tr>
            <th>Numero de Venta</th>
            <th>Fecha</th>
            <th>Total de la venta</th>
            <th>Cliente</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody id="ContenidoVenta">
   	<?php while($otmp=mysql_fetch_object($res)){?>
    <tr>
        <td><?=htmlentities ($otmp->v);?></td>
        <td><?=htmlentities ($otmp->f);?></td>
        <td><?=htmlentities ($otmp->t);?></td>
        <td><?=htmlentities ($otmp->n);?> <?=htmlentities ($otmp->ap);?> <?=htmlentities ($otmp->am);?></td>
        <td>
        	<div class="btn-group btn-group-xs" data-toggle="modal" data-target="#detalle">
                <button title="El buen título" type="button" class="btn btn-default ventas" value="<?php echo $otmp->v;?>">
                    <span class="glyphicon glyphicon-list-alt"></span>
                </button>
            </div>
            <div class="btn-group btn-group-xs" data-toggle="modal" data-target="#producto">
                <button title="El buen título" type="button" class="btn btn-default productos" value="<?php echo $otmp->v;?>">
                    <span class="glyphicon glyphicon-list"></span>
                </button>
            </div>
        </td>
   </tr>
   
        <?php }#while ?>
    </tbody>
   </table>
   <table class="table table-bordered bye">
   <thead>
        <tr>
            <th>Numero de Venta</th>
            <th>Fecha</th>
            <th>Total de la venta</th>
            <th>Cliente</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody class="search"></tbody>
</table>
</div>


<!-- Modal Detalle-->
<div class="modal fade " id="detalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Detalle de la Venta</h4>
            </div>
            <div class="modal-body">    
                <div class="container" >
                    <div class="col-md-6 col-md-offset-3">
                        <table class="table table-bordered">
                            <tbody>
                               <div class="container" style="padding-top: 1em;">
                                    <tr>
                                        <td>Número de venta:</td>
                                        <td id="numerov"></td>
                                    </tr>
                                    <tr>
                                        <td>Nombre del cliente:</td>
                                        <td id="nombrec"></td>
                                    </tr>
                                    <tr>
                                        <td>Fecha de la venta:</td>
                                        <td id="fechav"></td>
                                    </tr>
                                    <tr>
                                        <td>Total de la venta:</td>
                                        <td id="totalv"></td>
                                    </tr>
                                    <tr>
                                        <td>Tipo de pago:</td>
                                        <td id="tipop"></td>
                                    </tr>
                                    <tr>
                                        <td>Monto pagado en efectivo:</td>
                                        <td id="montoe"></td>
                                    </tr>
                                    <tr>
                                        <td>Monto pagado con tarjeta:</td>
                                        <td id="montot"></td>
                                    </tr>
                                    <tr>
                                        <td>La venta dejó en monedero:</td>
                                        <td id="montom"></td>
                                    </tr>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal  Productos-->
<div class="modal fade " id="producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Detalle de productos Vendidos</h4>
            </div>
            <div class="modal-body">    
                <div class="container" >
                    <div class="col-md-12">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Descripción:</th>
                                    <th>Precio:</th>
                                    <th>Cantidad:</th>
                                    <th>Subtotal:</th>
                                    <th>Dejó en monedero:</th>
                                    <th>opciones</th>
                                </tr>
                            </thead>
                            <tbody id="contenido"></tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>