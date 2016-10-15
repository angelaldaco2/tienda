<?
		$CadenaSQL="select * from Producto join marca on producto.ID_Marca=marca.ID_Marca where 1=1";
		
		$res=mysql_query($CadenaSQL);

  ?>
<div class="col-xs-12 ">
	<legend>Productos</legend>
</div>
<div class="row">
    <div class="col-xs-3">
        <input type="search" id="buscaTabla" placeholder="Búsqueda"  class="form-control">
    </div>
    <div class="col-xs-1">
        <button type="button" class="btn btn-default buscar" onclick="buscar()">
          <span class="glyphicon glyphicon-search"></span> Buscar 
        </button>
    </div>

    <div class="col-xs-4 ">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar">
    	   Agregar Producto
        </button>
    </div>
</div>    

<div class="scroll col-xs-12">
    


    <table class="table table-bordered table-hover bye">
        <thead>
            <tr>
                <th >Clave Producto</th>
                <th >Descripcion</th>
                <th >Precio</th>
                <th >Promocion</th>
                <th >Existencia</th>
                <th >Acciones</th>
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
                <h4 class="modal-title" id="myModalLabel">Detalles del Producto</h4>
            </div>
            <div class="modal-body">    
                <div class="container" >
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tbody>
                               <div class="container" style="padding-top: 1em;">
                                    <tr>
                                        <td>ID_Producto:</td>
                                        <td id="idp"></td>
                                        <td>Descripción del producto:</td>
                                        <td id="descp"></td>
                                    </tr>
                                    <tr>
                                        <td>Precio:</td>
                                        <td id="precp"></td>
                                        <td>Talla:</td>
                                        <td id="tallap"></td>
                                    </tr>
                                    <tr>
                                        <td>Marca:</td>
                                        <td id="marcap"></td>
                                        <td>Estilo:</td>
                                        <td id="estp"></td>
                                    </tr>
                                    <tr>
                                        <td>Categoría:</td>
                                        <td id="catp"></td>
                                        <td>Color:</td>
                                        <td id="colp"></td>
                                    </tr>
                                    <tr>
                                        <td>Subcategoría 1:</td>
                                        <td id="sub1p"></td>
                                        <td>Subcategoría 2:</td>
                                        <td id="sub2p"></td>
                                    </tr>
                                    <tr>
                                        <td>Subcategoría 3:</td>
                                        <td id="sub3p"></td>
                                        <td>Existencia en tienda:</td>
                                        <td id="exisp"></td>
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
                <h4 class="modal-title" id="myModalLabel">Editar Producto</h4>
            </div>
            <div class="modal-body">    
                <div class="container" >
                    <div class="col-md-12 ">
                        <table class="table table-bordered">
                            <tbody>
                               <div class="container" style="padding-top: 1em;">
                                    <?php
                                        include_once('Config/connect.php');
                                        $sql_subcat='SELECT * FROM Subcategoria WHERE 1=1';
                                        $sub1=mysql_query($sql_subcat);
                                        $sub2=mysql_query($sql_subcat);
                                        $sub3=mysql_query($sql_subcat);
                                        
                                        $sql_cat='SELECT * FROM Categoria WHERE 1=1';
                                        $cat=mysql_query($sql_cat);
                                        
                                        $sql_marca='SELECT * FROM Marca WHERE 1=1';
                                        $mar=mysql_query($sql_marca);
                                        
                                        $sql_color='SELECT * FROM Color WHERE 1=1';
                                        $col=mysql_query($sql_color);
                                    ?>
                                      
                                    <tr>
                                        <td>ID Producto:</td>
                                        <td id="pid"></td>
                                        <td>Descripción del producto</td>
                                        <td id="pdesc"></td>
                                    </tr>
                                    <tr>
                                        <td>Precio:</td>
                                        <td>
                                            <input type="text" id="pprec" class="form-control" >
                                        </td>
                                        <td>Talla:</td>
                                        <td id="ptalla"></td>
                                    </tr>
                                    <tr>
                                        <td>Marca:</td>
                                          <td id="pmarca">
                                          </td>
                                        <td>Estilo:</td>
                                        <td id="pest"></td>
                                    </tr>
                                    <tr>
                                        <td>Categoría:</td>
                                        <td id="pcat">
                                          </td>
                                        <td>Color:</td>
                                            <td id="pcol"></td>
                                    </tr>
                                    <tr>
                                        <td>Subcategoría 1:</td>
                                        <td>
                                            <select class="form-control psub1" style="width:140">
                                            <option id="psub1" selected></option> 
                                                <?php
                                                    echo mysql_error(); 
                                                    while($subcat1=mysql_fetch_assoc($sub1)){ 
                                                    echo '<option value="'.$subcat1['ID_Subcategoria'].'">'.$subcat1['NombreSubCategoria'].'</option>'; 
                                                    } 
                                                ?> 
                                            </select>
                                        </td>
                                        <td>Subcategoría 2:</td>
                                        <td>
                                            <select class="form-control psub2" style="width:140">
                                            <option id="psub2" selected></option> 
                                                <?php
                                                    echo mysql_error(); 
                                                    while($subcat2=mysql_fetch_assoc($sub2)){ 
                                                    echo '<option value="'.$subcat2['ID_Subcategoria'].'">'.$subcat2['NombreSubCategoria'].'</option>'; 
                                                    } 
                                                ?> 
                                            </select>
                                        </td>
                                    </tr>
                                    <td>Subcategoría 3:</td>
                                        <td>
                                            <select class="form-control psub3" style="width:140">
                                            <option id="psub3" selected></option> 
                                                <?php
                                                    echo mysql_error(); 
                                                    while($subcat3=mysql_fetch_assoc($sub3)){ 
                                                    echo '<option value="'.$subcat3['ID_Subcategoria'].'">'.$subcat3['NombreSubCategoria'].'</option>'; 
                                                    } 
                                                ?> 
                                            </select>
                                        </td>
                                        <td>Existencia en Tienda:</td>
                                        <td><input type="text" id="pexis" class="form-control" ></td>
                                    </tr>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="modificarProducto()" >Guardar</button>
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
                <h4 class="modal-title" id="myModalLabel">Agregar Producto</h4>
            </div>
            <div class="modal-body">    
                <div class="container" >
                    <div class="col-md-12 ">
                       <table class="table table-bordered">
                            <tbody>
                               <div class="container" style="padding-top: 1em;">
                                    <?php
                                        include_once('Config/connect.php');
                                        $sql_subcat='SELECT * FROM Subcategoria WHERE 1=1';
                                        $sub1=mysql_query($sql_subcat);
                                        $sub2=mysql_query($sql_subcat);
                                        $sub3=mysql_query($sql_subcat);
                                        
                                        $sql_cat='SELECT * FROM Categoria WHERE 1=1';
                                        $cat=mysql_query($sql_cat);
                                        
                                        $sql_marca='SELECT * FROM Marca WHERE 1=1';
                                        $mar=mysql_query($sql_marca);
                                        
                                        $sql_color='SELECT * FROM Color WHERE 1=1';
                                        $col=mysql_query($sql_color);
                                    ?>
                                    
                                    <tr>
                                        <td>Marca:</td>
                                        <td>
                                            <select  class="form-control" id="apmarca" style="width:140">
                                                <option value="" selected>Seleccionar</option> 
                                                <?php
                                                    echo mysql_error(); 
                                                    while($marca=mysql_fetch_assoc($mar)){ 
                                                    echo '<option value="'.$marca['ID_Marca'].'">'.$marca['NombreMarca'].'</option>'; 
                                                    } 
                                                ?> 
                                            </select>
                                        </td>
                                        <td>Estilo:</td>
                                        <td ><input type="text" id="apest" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>Categoría:</td>
                                        <td>
                                        <select  class="form-control" id="apcat" style="width:140">
                                            <option value="" selected>Seleccionar</option> 
                                                <?php
                                                    echo mysql_error(); 
                                                    while($categoria=mysql_fetch_assoc($cat)){ 
                                                    echo '<option value="'.$categoria['ID_Categoria'].'">'.$categoria['NombreCategoria'].'</option>'; 
                                                    } 
                                                ?> 
                                        </select>
                                        </td>
                                        <td>Color:</td>
                                            <td>
                                                <select  class="form-control" id="apcol" style="width:140">
                                                 <option value="" selected>Seleccionar</option> 
                                                <?php
                                                    echo mysql_error(); 
                                                    while($color=mysql_fetch_assoc($col)){ 
                                                    echo '<option value="'.$color['ID_Color'].'">'.$color['NombreColor'].'</option>'; 
                                                    } 
                                                ?> 
                                                </select>
                                        </td>
                                    </tr>
                                        <td>Subcategoría 1:</td>
                                        <td>
                                            <select  class="form-control" id="apsub1" style="width:140">
                                            <option value="" selected>Seleccionar</option> 
                                                <?php
                                                    echo mysql_error(); 
                                                    while($subcat1=mysql_fetch_assoc($sub1)){ 
                                                    echo '<option value="'.$subcat1['ID_Subcategoria'].'">'.$subcat1['NombreSubCategoria'].'</option>'; 
                                                    } 
                                                ?> 
                                            </select>
                                        </td>
                                        <td>Subcategoría 2:</td>
                                        <td>
                                            <select  class="form-control" id="apsub2" style="width:140">
                                            <option value="" selected>Seleccionar</option> 
                                                <?php
                                                    echo mysql_error(); 
                                                    while($subcat2=mysql_fetch_assoc($sub2)){ 
                                                    echo '<option value="'.$subcat2['ID_Subcategoria'].'">'.$subcat2['NombreSubCategoria'].'</option>'; 
                                                    } 
                                                ?> 
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Subcategoría 3:</td>
                                        <td>
                                            <select  class="form-control" id="apsub3" style="width:140">
                                            <option value="" selected>Seleccionar</option> 
                                                <?php
                                                    echo mysql_error(); 
                                                    while($subcat3=mysql_fetch_assoc($sub3)){ 
                                                    echo '<option value="'.$subcat3['ID_Subcategoria'].'">'.$subcat3['NombreSubCategoria'].'</option>'; 
                                                    } 
                                                ?> 
                                            </select>
                                        </td>
                                        <td class="col-md-3">Talla:</td>
                                        <td class="col-md-3">
                                            <select class="form-control" id="aptalla" style="width:140">
                                                <option value="" selected>Seleccionar</option> 
                                                <option value="UN" >UNITALLA</option>
                                                <option value="CH" >CHICA</option>
                                                <option value="ME" >MEDIANA</option>
                                                <option value="GR" >GRANDE</option>
                                                <option value="1" >1</option>
                                                <option value="3" >3</option>
                                                <option value="5" >5</option>
                                                <option value="7" >7</option>
                                                <option value="9" >9</option>
                                                <option value="11" >11</option>
                                                <option value="13" >13</option>
                                                <option value="15" >15</option>
                                            </select>                                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">Precio:</td>
                                        <td class="col-md-3"><div class="form-group input-group ">
                                            <span class="input-group-addon">$</span>
                                            <input type="text" id="apprec" class="form-control" >
                                        </td>
                                        <td>Existencia en Tienda:</td>
                                        <td><input value="0" type="number" id="apexis" class="form-control" min='0' ></td>
                                    </tr>
                                </div>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary" onclick="Borrar()">Borrar</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="addProducto()">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>