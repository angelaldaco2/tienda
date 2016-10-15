<?
		$CadenaSQL="select * from Marca where 1=1";
		$res=mysql_query($CadenaSQL);

  ?>
  <div class="col-xs-12">
	<legend>Marcas</legend>
</div>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar">
	Agregar Marca
</button>

<div class="col-xs-12 scroll">
    <table class="table table-bordered table-hover">
    	<thead>
        	<tr>
                <th>Clave Marca</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Correo Electronico</th>
                <th>Pagina Web</th>
                <th>Acciones</th>
            </tr>
        	</thead>
        <? while($otmp=mysql_fetch_object($res)){?>
        <tr>
        	<td><?=htmlentities ($otmp->ID_Marca);?></td>
            <td><?=htmlentities ($otmp->NombreMarca);?></td>
            <td><?=htmlentities ($otmp->TelefonoMarca);?></td>
            <td><?=htmlentities ($otmp->CorreoElectronicoMarca);?></td>
            <td><?=htmlentities ($otmp->PaginaWebMarca);?></td>
            <td>
                <div class="btn-group btn-group-xs" data-toggle="modal" data-target="#editar">
                    <button type="button" div class="btn btn-default editar" value="<?php echo $otmp->ID_Marca;?>">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                </div>
    		</td>
        </tr>
        <? }#while ?>
   </table>
</div>


<!-- Modal Editar-->
<div class="modal fade " id="editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Editar Marca</h4>
            </div>
            <div class="modal-body">    
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                           <div class="container" style="padding-top: 1em;">
                                <tr>
                                    <td>Clave Marca:</td>
                                    <td><input type="text" class="form-control" readonly id="ID_Marca"></td>
                                </tr>
                                <tr>
                                    <td>Nombre:</td>
                                    <td><input type="text" class="form-control" id="nombre"></td>
                                </tr>
                                <tr>
                                    <td>Teléfono:</td>
                                    <td><input type="text" class="form-control" id="tel"></td>
                                </tr>
                                <tr>
                                    <td>Correo Electrónico:</td>
                                    <td><input type="email" class="form-control" id="correo"></td>
                                </tr>
                                <tr>
                                    <td>Página WEB:</td>
                                    <td><input type="text" class="form-control" id="pagina"></td>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="modificarMarca()" >Guardar</button>
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
                <h4 class="modal-title" id="myModalLabel">Agregar Marca</h4>
            </div>
            <div class="modal-body">    
                <div class="container" >
                    <div class="col-md-6 col-md-offset-3 ">
                        <table class="table table-bordered">
                        <tbody>
                           <div class="container" style="padding-top: 1em;">
                                <tr>
                                    <td>Clave Marca:</td>
                                    <td><input type="text" class="form-control"  id="aID_Marca"></td>
                                </tr>
                                <tr>
                                    <td>Nombre:</td>
                                    <td><input type="text" class="form-control" id="anombre"></td>
                                </tr>
                                <tr>
                                    <td>Teléfono:</td>
                                    <td><input type="text" class="form-control" id="atel"></td>
                                </tr>
                                <tr>
                                    <td>Correo Electrónico:</td>
                                    <td><input type="email" class="form-control" id="acorreo"></td>
                                </tr>
                                <tr>
                                    <td>Página WEB:</td>
                                    <td><input type="text" class="form-control" id="apagina"></td>
                        </tbody>
                    </table>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="addMarca()" >Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>