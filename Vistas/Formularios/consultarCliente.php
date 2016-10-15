
<?
		$CadenaSQL="select * from Cliente order by nombrecliente,apellidop,apellidom";
		
		$res=mysql_query($CadenaSQL);
	
  ?>


<div class="col-xs-12">
	<legend>Clientes</legend>
</div>
<div class="row">
    <div class="col-xs-4 col-xs-offset-3">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar">
	       Agregar Cliente
        </button>
    </div>
    <div class="col-xs-3">
        <input type="search" id="buscaTabla" placeholder="Búsqueda" class="form-control ui-autocomplete-input">
    </div>
    <div class="col-xs-2">
        <a href="#" class="btn btn-success buscar">Buscar</a>
    </div>
</div>
<div class="row">
    <div class="scroll col-xs-12">
        <table class="table table-bordered table-hover tablesorter orig">
            <thead>
        		<tr>
                    <th>Clave Cliente</th>
                    <th>Nombre</th>
                    <th>Apellido 1</th>
                    <th>Apellido 2</th>
                    <th>Teléfono</th>
                    <th>Celular</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
        		</tr>
    	   </thead>
        	<tbody>
        		<?php while($otmp=mysql_fetch_object($res)){?>
                <tr>
                    <td><?=htmlentities ($otmp->ID_Cliente);?></td>
                    <td><?=htmlentities ($otmp->NombreCliente);?></td>
                    <td><?=htmlentities ($otmp->ApellidoP);?></td>
                    <td><?=htmlentities ($otmp->ApellidoM);?></td>
                    <td><?=htmlentities ($otmp->Telefono);?></td>
                    <td><?=htmlentities ($otmp->Celular);?></td>
                    <td><ol class="descliente" id="<?=htmlentities ($otmp->ID_Cliente);?>" contenteditable="true"><?=htmlentities ($otmp->Descripcion);?></li></td>
                    <td>
                        <div class="btn-group btn-group-xs" data-toggle="modal" data-target="#detalle">
                        <button type="button" div class="btn btn-default detalles" value="<?php echo $otmp->ID_Cliente;?>">
                            <span class="glyphicon glyphicon-list-alt">
                            </span>
                        </div>

                        <div class="btn-group btn-group-xs" data-toggle="modal" data-target="#editar">
                        <button type="button" div class="btn btn-default editar" value="<?php echo $otmp->ID_Cliente;?>">
                            <span class="glyphicon glyphicon-pencil">
                            </span>
                        </div>
                        <div class="btn-group btn-group-xs" data-toggle="modal" data-target="#facturar">
                        <button type="button" div class="btn btn-default facturacion" value="<?php echo $otmp->ID_Cliente;?>">
                            <span class="glyphicon glyphicon-qrcode">
                            </span>
                        </div>
                    </td>
                </tr>
                <? }#while ?>
            </tbody>
        </table>
        

        </table>
        <table class="table table-bordered table-hover busq">
            <thead>
                <tr>
                    <th>Clave Cliente</th>
                    <th>Nombre</th>
                    <th>Apellido 1</th>
                    <th>Apellido 2</th>
                    <th>Fecha de nacimiento</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
                </tr>
            </thead><tbody class="search"></tbody>
        </table>
    </div>
</div>




<!-- Modal  Detalle-->
<div class="modal fade " id="detalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Detalles del Cliente</h4>
            </div>
            <div class="modal-body">    
                <div class="container" >
                    <div class="col-md-6 col-md-offset-3 ">
                        <table class="table table-bordered">
                            <tbody>
                               <div class="container" style="padding-top: 1em;">
                                    <tr>
                                        <td>ID_Cliente:</td>
                                        <td id="idc"></td>
                                    </tr>
                                    <tr>
                                        <td>Nombre del Cliente:</td>
                                        <td id="nombrec"></td>
                                    </tr>
                                    <tr>
                                        <td>Apellido 1:</td>
                                        <td id="ap1"></td>
                                    </tr>
                                    <tr>
                                        <td>Apellido 2:</td>
                                        <td id="ap2"></td>
                                    </tr>
                                    <tr>
                                        <td>Teléfono:</td>
                                        <td id="tel"></td>
                                    </tr>
                                    <tr>
                                        <td>Celular:</td>
                                        <td id="cel"></td>
                                    </tr>
                                    <tr>
                                        <td>Fecha de nacimiento:</td>
                                        <td id="fechan"></td>
                                    </tr>
                                    <tr>
                                        <td>Saldo Monedero:</td>
                                        <td id="salm"></td>
                                    </tr>
                                    <tr>
                                        <td>Promoción:</td>
                                        <td id="prom"></td>
                                    </tr>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar-->
<div class="modal fade " id="editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Editar Cliente</h4>
            </div>
            <div class="modal-body">    
                <div class="container" >
                    <div class="col-md-6 col-md-offset-3 ">
                        <table class="table table-bordered">
                            <tbody>
                               <div class="container" style="padding-top: 1em;">
                                    <tr>
                                        <td>ID_Cliente:</td>
                                        <td id="cid"></td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nombre del Cliente:</td>
                                        <td>
                                            <input type="text" id="cnombre" class="form-control" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Apellido 1:</td>
                                        <td>
                                            <input type="text" id="cap1" class="form-control" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Apellido 2:</td>
                                        <td>
                                            <input type="text" id="cap2" class="form-control" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Teléfono:</td>
                                        <td ><input type="text" id="ctel" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>Celular:</td>
                                        <td><input type="text" id="ccel" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>Fecha de nacimiento:</td>
                                        <td><input type="date" id="cfechan" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>Saldo Monedero:</td>
                                        <td id="csalm"></td>
                                    </tr>
                                    <tr>
                                        <td>Promoción:</td>
                                        <td><input type="text" id="cprom" class="form-control" ></td>
                                    </tr>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="modificarCliente()">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal factura-->
<div class="modal fade " id="facturar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Datos de Facturación</h4>
            </div>
            <div class="modal-body"> 
                <div class="row">
                    <div class "col-lg-12">
                        <div class="btn-group btn-group-justified">
                            <a href="#" class="btn btn-primary btn-lg" id="btn-agregar">Agregar datos de facturación</a>
                            <a href="#" class="btn btn-default btn-lg" id="btn-datos">Datos de factuación guardados</a>
                        </div>
                    </div>
                </div><br>   
                <div class="container agregar-mod" >
                    <div class="col-md-6 col-md-offset-3">
                        <table class="table table-bordered">
                            <tbody>
                               <div class="container" style="padding-top: 1em;">
                                    <tr>
                                        <td>Número de cliente:</td>
                                        <td id="nc">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>RFC:</td>
                                        <td>
                                            <input type="text" id="rfc" class="form-control" value="quinceletras" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Razón social:</td>
                                        <td>
                                            <input type="text" id="rc" class="form-control" value="algo para guardar" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Calle:</td>
                                        <td>
                                            <input type="text" id="ca" class="form-control" value="algo para guardar" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No. Exterior:</td>
                                        <td ><input type="text" id="ne" class="form-control" value="21" ></td>
                                    </tr>
                                    <tr>
                                        <td>No.Interior:</td>
                                        <td><input type="text" id="ni" class="form-control" value="12" ></td>
                                    </tr>
                                    <tr>
                                        <td>Colonia:</td>
                                        <td><input type="text" id="co" class="form-control" value="algo para guardar" ></td>
                                    </tr>
                                    <tr>
                                        <td>Código Postal:</td>
                                        <td><input type="text" id="cp" class="form-control" value="28000" ></td>
                                    </tr>
                                    <tr>
                                        <td>Ciudad:</td>
                                        <td><input type="text" id="ci" class="form-control" value="algo para guardar" ></td>
                                    </tr>
                                    <tr>
                                        <td>Estado:</td>
                                        <td><input type="text" id="es" class="form-control" value="algo para guardar" ></td>
                                    </tr>
                                    <tr>
                                        <td>Correo Electrónico:</td>
                                        <td><input type="text" id="ce" class="form-control" value="algo para guardar" ></td>
                                    </tr>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="container datos-mod" >
                    <div class="table-responsive col-lg-12 col-md-12">
                        <table id="table_id" class="table display">
                            <thead>
                                <tr>
                                    <th>RFC</th>
                                    <th>RAZON SOCIAL</th>
                                    <th>CALLE</th>
                                    <th>No</th>
                                    <th>No Ext</th>
                                    <th>COLONIA</th>
                                    <th>CÓDIGO POSTAL</th>
                                    <th>CIUDAD</th>
                                    <th>ESTADO</th>
                                    <th>EMAIL</th>
                                </tr>
                            </thead>
                           <tbody id="fact">
                           </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-success datos" onclick="addDatos()">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Agregar-->
<div class="modal fade " id="agregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Editar Cliente</h4>
            </div>
            <div class="modal-body">    
                <div class="container" >
                    <div class="col-md-6 col-md-offset-3 ">
                        <table class="table table-bordered">
                            <tbody>
                               <div class="container" style="padding-top: 1em;">
                                    <tr>
                                        <td>Nombre del Cliente:</td>
                                        <td>
                                            <input type="text" id="anombre" class="form-control" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Apellido 1:</td>
                                        <td>
                                            <input type="text" id="aap1" class="form-control" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Apellido 2:</td>
                                        <td>
                                            <input type="text" id="aap2" class="form-control" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Teléfono:</td>
                                        <td ><input type="text" id="atel" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>Celular:</td>
                                        <td><input type="text" id="acel" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>Fecha de nacimiento:</td>
                                        <td><input type="date" id="afechan" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>Notas del cliente:</td>
                                        <td><textarea class="form-control" rows="3" id="coments"></textarea></td>
                                    </tr>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="agregarCliente()">Guardar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>