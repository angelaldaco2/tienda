<script language="javascript">	

	$(document).ready( function () {
    $('#table_id').DataTable();
} );

</script>


<?php
	$CadenaSQL="select * from Subcategoria where 1=1";
	$res=mysql_query($CadenaSQL);
?>
  <div class="col-xs-12">
	<legend>Subcategría</legend>
</div>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar">
	Agregar Subcategoría
</button>
<div class="col-xs-12 scroll">
    <table class="table table-bordered table-hover">
    	<thead>
    		<tr>
            	<th>Clave</strong></th>
                <th>Nombre</strong></th>
                <th>Acciones</strong></th>
            </tr>
        </thead><tbody>
        <? while($otmp=mysql_fetch_object($res)){?>
        <tr>
        	<td><?=htmlentities ($otmp->ID_Subcategoria);?></td>
            <td><?=htmlentities ($otmp->NombreSubCategoria);?></td>
            <td>
                <div class="btn-group btn-group-xs" data-toggle="modal" data-target="#editar">
                    <button type="button" div class="btn btn-default editarSub" value="<?php echo $otmp->ID_Subcategoria;?>">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                </div>
            </td>
        </tr>
        <? }#while ?></tbody>
   </table>




<!-- Modal Editar-->
<div class="modal fade " id="editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Editar Subcategoría</h4>
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
                                            <input readonly type="text" id="clavesc" class="form-control" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nombre:</td>
                                        <td>
                                            <input type="text" id="nombresc" class="form-control" >
                                        </td>
                                    </tr>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="modificarSub()">Guardar</button>
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
                <h4 class="modal-title" id="myModalLabel">Editar Subcategoría</h4>
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
                <button type="button" class="btn btn-success" onclick="addSub()">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
