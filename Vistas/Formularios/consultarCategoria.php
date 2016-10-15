<?
	$CadenaSQL="select * from Categoria where 1=1";
	
	$res=mysql_query($CadenaSQL);
?>
<div class="col-xs-12">
	<legend>Categoría</legend>
</div>
<form class="form-inline" role="form">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar">
        Agregar Categoría
    </button>
</form>
</button>

  <!--  Tablas donde se mostrará el listado de Categorías consultadas -->
<div class="scroll col-xs-12" >
    <table class="table table-bordered table-hover orig">
    	<thead>
    		<tr>
    <!--  Encabezados de la tabla -->
    			<th >Clave</th>
    			<th >Nombre</th>
    			<th >Acciones</th>
    		</tr>
    	</thead>
    	<tbody>
    	<? while($otmp=mysql_fetch_object($res)){?>
    		<tr>
    <!-- Ciclo para traer los datos desde la Base de Datos -->
    			<td><?=htmlentities ($otmp->ID_Categoria);?></td>
                <td><?=htmlentities ($otmp->NombreCategoria);?></td>
                <td>
    				
                    <div class="btn-group btn-group-xs" data-toggle="modal" data-target="#editar">
                    <button type="button" div class="btn btn-default editar" value="<?php echo $otmp->ID_Categoria;?>">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </div>
                </div>
    			</td>
    		</tr>
            <? }#while ?>
    	</tbody>
    </table>
</div>


<!-- Modal Editar-->
<div class="modal fade " id="editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Editar Categoría</h4>
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
                                            <input type="text" readonly id="clavec" class="form-control" >
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
                <button type="button" class="btn btn-success" onclick="modificarCategoria()">Guardar</button>
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
                <h4 class="modal-title" id="myModalLabel">Agregar Categoria</h4>
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
                <button type="button" class="btn btn-success" onclick="addCategoria()">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>