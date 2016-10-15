<script type="text/javascript">$(document).ready( function () {
	$('#table_id').DataTable();
	} );
</script>

<?php
	$CadenaSQL="select * from GastosDiarios where 1=1";
	$res=mysql_query($CadenaSQL);
	include_once('../../Config/connect.php');
	$sql=('select ID_Corte, SaldoFinalEfectivo,SaldoFinalTarjeta sft,SaldoFinalMonedero sfm from caja order by ID_Corte desc limit 1;');
	$result=mysql_query($sql);
	$saldocaja=mysql_fetch_array($result);
	$ID_Corte=$saldocaja['ID_Corte'];
	
 ?>

<!-- Banner que muestra el saldo-->
<li class="list-group-item list-group-item-success">
    Saldo Caja: $<span id="elbuensaldo"><?php echo $saldocaja['SaldoFinalEfectivo'];?></span><br>
    Saldo Tarjeta: $<span id="elbuensaldo"><?php echo $saldocaja['sft'];?></span><br>
    Saldo Monedero: $<span id="elbuensaldo"><?php echo $saldocaja['sfm'];?></span><br>
</li>
<br>

<button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar">
	Agregar Gasto
</button>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#abonar">
    Abonar a Caja
</button>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#corte">
    Hacer Corte
</button>

<!-- Tabla de consulta-->
<table id="table_id" class="display">
<thead>
    <tr>
        <th>Numero de gasto</th>
        <th>Fecha</th>
        <th>Descripcion</th>
        <th>Cantidad</th>
    </tr>
</thead>
<tbody>
	<?php while($otmp=mysql_fetch_object($res)){?>
    <tr>
            <td><?=htmlentities ($otmp->ID_Gasto);?></td>
            <td><?=htmlentities ($otmp->FechaGasto);?></td>
            <td><?=htmlentities ($otmp->Descripcion);?></td>
            <td><?=htmlentities ($otmp->CantidadGasto);?></td>
   </tr>
    <? }#while ?>
	</tbody>
</table>

<!-- Modal  Agregar gasto-->
<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Nuevo Gasto</h4>
            </div>
            <div class="modal-body">
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group input-group">
                        <span class="input-group-addon"  name="desc">Descripción:</span>
                        <input type="text" name="desc" class="form-control" id="desc">
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group input-group">
                        <span class="input-group-addon"  name="monto">Monto: $</span>
                        <input type="text" name="monto" class="form-control" id="monto">
                    </div>
                </div>
                <div class="container" id="alerta"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onClick="addGasto()">Agregar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                
            </div>
        </div>
	</div>
</div>

<!-- Modal  2-->
<div class="modal fade" id="abonar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Agregar saldo</h4>
            </div>
            <div class="modal-body">
                <div class="col-xs-12 col-sm-12">
                    <div class="form-group input-group">
                        <span class="input-group-addon"  name="abono">Abono a Caja: $</span>
                        <input type="hidden" value="<?php echo $ID_Corte;?>" name="ID_Corte" id="ID_Corte">
                        <input type="hidden" value="<?php echo $saldocaja['SaldoFinalEfectivo'];?>" id="totalcaja">
                        <input type="text" name="abono" class="form-control" id="abono" >
                    </div>
                    <div class="container" id="alerta2"></div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-success" onClick="addCaja()">Agregar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal de corte -->
<div class="modal fade" id="corte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Hacer Corte</h4>
            </div>
            <div class="modal-body">
                <li class="list-group-item list-group-item-danger">
                    Únicamente se podrá realizar un corte de caja por día
                </li>
                <div class="col-xs-12 col-sm-12">
                    <div class="form-group">
                        <label for="retiro">Retiro</label>
                        <br>
                        <br>
                        <br>
                        Cantidad actual:
                        <h1><?php echo $saldocaja['SaldoFinalEfectivo'];?></h1>
                        <input type="number" class="form-control" id="retiro" placeholder="Cantidad a retirar">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-success cortar">Aceptar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>