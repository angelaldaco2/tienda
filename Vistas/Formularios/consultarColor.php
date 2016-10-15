<?
		$CadenaSQL="select * from Color where 1=1";
		
		$res=mysql_query($CadenaSQL);

  ?>
  <div class="col-xs-12">
	<legend>Colores</legend>
</div>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar">
	Agregar Color
</button>
<div class="col-xs-12 scroll">
    <table class="table table-bordered table-hover">
    	<thead>
    		<tr>
                <th>Clave Color</th>
                <th>Nombre</th>
                <th>Acciones</th>
        	</th>
        </thead>
        <? while($otmp=mysql_fetch_object($res)){?>
        <tr>
        	<td><?=htmlentities ($otmp->ID_Color);?></td>
            <td><?=htmlentities ($otmp->NombreColor);?></td>
            <td>
                <div class="btn-group btn-group-xs" data-toggle="modal" data-target="#editar">
                    <button type="button" div class="btn btn-default editar" value="<?php echo $otmp->ID_Color;?>">
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
                <h4 class="modal-title" id="myModalLabel">Editar Color</h4>
            </div>
            <div class="modal-body">    
                <div class="container" >
                    <div class="col-md-6 col-md-offset-3 ">
                        <table class="table table-bordered">
                            <tbody>
                               <div class="container" style="padding-top: 1em;">
                                    <tr>
                                        <td>Clave Color:</td>
                                        <td>
                                            <input type="text" id="cvc" readonly class="form-control" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nombre:</td>
                                        <td>
                                            <input type="text" id="nombrec" class="form-control" >
                                        </td>
                                    </tr>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="edColor()" >Guardar</button>
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
                <h4 class="modal-title" id="myModalLabel">Agregar Color</h4>
            </div>
            <div class="modal-body">    
                <div class="container" >
                    <div class="col-md-6 col-md-offset-3 ">
                        <table class="table table-bordered">
                            <tbody>
                               <div class="container" style="padding-top: 1em;">
                                    <tr>
                                        <td>Clave:</td>
                                        <td>
                                            <input type="text" id="aclave" class="form-control" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nombre:</td>
                                        <td>
                                            <input type="text" id="anombre" class="form-control" >
                                        </td>
                                    </tr>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="addColor()" >Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>