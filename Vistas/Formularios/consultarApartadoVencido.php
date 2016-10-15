<?php
    $CadenaSQL="select * from Apartado left join Cliente
	           on Apartado.ID_Cliente=Cliente.ID_Cliente where Estado='Vencido'";
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