
<?php
    $CadenaSQL="select * from Apartado left join Cliente
	           on Apartado.ID_Cliente=Cliente.ID_Cliente where 1=1";
	include_once ('Config/connect.php');
	$res=mysql_query($CadenaSQL);	
?>

<div class="col-xs-12">
	<legend>Apartados</legend>
    
</div>
<div class="row">
    <div class="col-lg-9">
        <form class="form-inline" role="form">
            <div class="form-group col-lg-3">
                <input type="date" class="form-control" id="buscarApartado" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="form-group col-lg-3">
                <label class="radio-inline">
                    <input type="radio" name="buscapor" id="buscapor" value="0" checked>Fecha Inicio 
                </label>
                <label class="radio-inline">
                    <input type="radio" name="buscapor" id="buscapor" value="1">Fecha Fin 
                </label>
            </div>
            <div class="form-group col-lg-3">
                <input type="button" id="buscarfecha" class="form-control btn btn-default" value="Buscar">
            </div>
            <div class="form-group col-lg-3">
                <input type="search" id="buscaTabla" placeholder="Búsqueda" class="form-control ui-autocomplete-input">
            </div>
              <div class="form-group col-lg-3">
                <input type="button" id="apartado-vencido" class="form-control btn btn-default" value="Mostrar Vencidos" onclick="concultarApartadoVencido.php">
            </div>
        </form>
    </div>
</div>
<div class="scroll col-xs-12" >
    <table class="table table-bordered table-hover orig" >
        <thead>
            <tr>
                <th>Clave Apartado</th>
                <th>Nombre de Cliente</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Total</th>
                <th>Saldo</th>
                <th>Acciones</th>
            </tr>
        </thead>
       <tbody id="contenidobusqueda">
       <?php while($otmp=mysql_fetch_object($res)){?>
        <tr>
            <td><?=htmlentities ($otmp->ID_Apartado);?></td>
            <td><?=htmlentities ($otmp->NombreCliente);?>&nbsp;<?=($otmp->ApellidoP);?>&nbsp;<?=($otmp->ApellidoM); ?></td>
            <td><?=htmlentities ($otmp->FechaInicio);?></td>
            <td><?=htmlentities ($otmp->FechaFin);?></td>
            <td><?=htmlentities ($otmp->TotalApartado);?></td>
            <td><?=htmlentities ($otmp->SaldoApartado);?></td>
            <td>            
                <div class="btn-group btn-group-xs" data-toggle="modal" data-target="#detalle">
                   	<button type="button" div class="btn btn-default detalles" value="<?php echo $otmp->ID_Apartado;?>">
                   		<span class="glyphicon glyphicon-list-alt"></span>
                    </button>
                </div>

                <div class="btn-group btn-group-xs" data-toggle="modal" data-target="#abonar">
                    <button type="button" div class="btn btn-default abonos" value="<?php echo $otmp->ID_Apartado;?>">
                        <span class="glyphicon glyphicon-usd"></span>
                    </button>
                </div>
                <div class="btn-group btn-group-xs" data-toggle="modal" data-target="#productos">
                    <button type="button" div class="btn btn-default productos" value="<?php echo $otmp->ID_Apartado;?>">
                        <span class="glyphicon glyphicon-list"></span>
                    </button>
                </div>
                <div class="btn-group btn-group-xs">
                    <button type="button" div class="btn btn-default eliminarapartado" value="<?php echo $otmp->ID_Apartado;?>">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </button>
                </div>
    		</td>
       </tr>
        <? }#while ?>
       </tbody>
    </table>
    <table class="table table-bordered table-hover bye">
        <thead>
            <tr>
                <th>Clave Apartado</th>
                <th>Nombre de Cliente</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Total</th>
                <th>Saldo</th>
                <th>Acciones</th>
            </tr>
        </thead><tbody class="search"></tbody>
    </table>
</div>



<!-- Modal  Detalle-->
<div class="modal fade " id="detalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Detalle de Apartado</h4>
            </div>
            <div class="modal-body">    
                <div class="container" >
                    <div class="col-md-6 col-md-offset-3 ">
                        <table class="table table-bordered">
                            <tbody>
                               <div class="container" style="padding-top: 1em;">
                                    <tr>
                                        <td>Número de Apartado:</td>
                                        <td id="clavea"></td>
                                    </tr>
                                    <tr>
                                        <td>Nombre del Cliente:</td>
                                        <td id="nombrec"></td>
                                    </tr>
                                    <tr>
                                        <td>Total del Apartado:</td>
                                        <td id="totala"></td>
                                    </tr>
                                    <tr>
                                        <td>Saldo del apartado:</td>
                                        <td id="saldoa"></td>
                                    </tr>
                                    <tr>
                                        <td>Total en Monedero:</td>
                                        <td id="totalm"></td>
                                    </tr>
                                    <tr>
                                        <td>Fecha de Inicio:</td>
                                        <td id="fechai"></td>
                                    </tr>
                                    <tr>
                                        <td>Fecha de Fin:</td>
                                        <td id="fechaf"></td>
                                    </tr>
                                     <tr>
                                        <td>Estado del apartado:</td>
                                        <td id="estadoa"></td>
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




<!-- Modal Abonar-->
<div class="modal fade " id="abonar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Abonar a apartado</h4>
            </div>
            <div class="modal-body"> 
                <div class="row">
                    <div class "col-lg-12">
                        <div class="btn-group btn-group-justified">
                            <a href="#" class="btn btn-primary btn-lg" id="btn-abonar">Abonar</a>
                            <a href="#" class="btn btn-default btn-lg" id="btn-abonos">Abonos</a>
                        </div>
                    </div>
                </div><br>   
                <div class="container abonar-mod" >
                    <div class="col-md-6 col-md-offset-3">
                        <table class="table table-bordered table-hover">
                            <tbody>
                               <div class="container" style="padding-top: 1em;">
                                    <tr>
                                        <td>Número de Apartado:</td>
                                        <td id="clav"></td>
                                    </tr>
                                    <tr>
                                        <td>Total de apartado:</td>
                                        <td id="tot"></td>
                                    </tr>
                                    <tr>
                                        <td>Saldo restante:</td>
                                        <td id="sal"></td>
                                    </tr>
                                    <tr>
                                        <td>Efectivo</td>
                                        <td>
                                            <input type="text" id="efec" class="form-control" value="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tarjeta:</td>
                                        <td ><input type="text" id="tarj" class="form-control" value="0"></td>
                                    </tr>
                                    <tr>
                                        <td>Monedero:</td>
                                        <td><input type="text" id="mon" class="form-control" value="0"></td>
                                    </tr>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="container abonos-mod" >
                    <div class="col-md-6 col-md-offset-3">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Efectivo</th>
                                    <th>Tarjeta</th>
                                    <th>Monedero</th>
                                </tr>
                            </thead>
                           <tbody id="detallesAbono">
                           </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="send-abono" onclick="abonar()">Abonar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal  Productos-->
<div class="modal fade " id="productos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Detalle de productos apartados</h4>
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
                            <tbody id="cuerpoProducto">
                               <!--<div class="container"  style="padding-top: 1em;"></div>-->
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