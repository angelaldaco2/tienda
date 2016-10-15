<?php
    $fecha=getdate();
?>

<style>
  .ui-autocomplete {
    max-height: 250px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  /* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
    height: 250px;
  }
  </style>
    <legend > Nueva Venta</legend >

<div class="row">
    <form id="formulario" name="formulario" class="formulario" method="POST" action="#">
        <div class="col-xs-12 col-sm-3">
            <div clas="form-group">
                <label for="cliente" class="control-label">Nombre de Cliente:</label>
                <input type="hidden" class="promocioncliente">
                <input type="text" name="cliente" class="form-control">
                <input type="hidden" id="ID_Cliente" />
            </div>
        </div>
        <div class="col-xs-12 col-sm-2">
            <div clas="form-group">
                <label for="producto" class="control-label">Producto:</label>
                <input type="text" name="producto" id="producto" class="form-control" readonly >
              </div>
        </div>
        <div class="col-xs-12 col-sm-2">
            <label for="cantidad" class="control-label">Cantidad:</label>
            <div class="form-group input-group">
                <span class="input-group-addon" id="tcantidad"></span>
                <input type="number" value="0" min="0"  name="cantidad" id="cantidad" class="form-control" readonly>
            </div>
        </div> 
        <div class="col-xs-12 col-sm-3">
            <br/>
            <button type="button" id="Agregar" name="Agregar" class ='btn btn-info disabled'>
                Agregar a la compra
            </button>
        </div>
        <div class="col-xs-12 col-sm-2 ">
            <div clas="form-group">
                <label for="fecha" class="control-label">Fecha:</label>
                <input type="text" name="fecha" class="form-control" readonly value= "<?php echo $fecha['mday'].'/'.$fecha['month'].'/'.$fecha['year']?>" style="text-align:center; cursor:default">
            </div>
        </div>
    </form>
</div>              
<div class="row">
    <div id = "tabla" class="content" >
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Clave de Producto</th>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                    <th>Promcion</th>
                    <th>Opciones</th>
                    </tr>
            </thead>
            <tbody id ="cuerpo" class="scrollContent"  >
            </tbody>
        </table>
    </div>
</div>
<br>
<div class="row">
    <div class="col-xs-12 col-sm-2">
        <div clas="form-group">
            <label for="total" class="control-label">Total:</label>
            <input type="text" name="total" id="total" class="form-control" value="0" readonly="readonly"  style="text-align:center; cursor:default">
        </div>
    </div>
    <div class="col-xs-12 col-sm-2">
        <label for="monedero" class="control-label">Monedero:</label>
        <div class="form-group input-group">
        <span class="input-group-addon" id="monedero"></span>
        <input type="text" value="0" name="monedero" id="mon" class="form-control">
        </div>
    </div> 
    <div class="col-xs-12 col-sm-2">
        <div clas="form-group">
        <label for="apagar" class="control-label">Total a pagar:</label>
        <input type="text" name="apagar" class="form-control"  style="text-align:center; cursor:default" readonly>
        </div>
    </div>
    <div class="col-xs-12 col-sm-2">
        <div class="radio">
        <label><input name="tpago" type="radio" id="Tipodepago_0" value="1" checked="checked"/>
         <span class="glyphicon glyphicon-usd" ></span>
         </label>
        </div>
         <div class="radio">
        <label><input name="tpago" type="radio" id="Tipodepago_1" value="2" />
         <span class="glyphicon glyphicon-credit-card" ></span>
         </label> 
        </div>
        <div class="radio">
        <label><input type="radio" name="tpago" value="3" id="Tipodepago_2" data-toggle="modal" data-target="#myModal" />
        <span class="glyphicon glyphicon-credit-card" ></span> - <span class="glyphicon glyphicon-usd" ></span>
         </label> 
        </div>
    </div>
    <div class="col-xs-12 col-sm-4">
        <div class="btn-group btn-justified col-lg-12">
            <button type="button" class="btn btn-success pagar col-lg-6">PAGAR</button>
            <button type="button" class="btn btn-info apartar col-lg-6">APARTAR</button>
        </div>
        <div class="row" style="margin:22px 0px 0px 0px">
            <br><div class="form-group"><input type="number" class="form-control" id="cambio" placeholder="Efectivo"></div>
        </div>
    </div>
</div> 
    
    
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Pago Mixto</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group input-group">
                            <span class="input-group-addon" id="mefectivo">Efectivo</span>
                            <input type="text" name="mefectivo" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group input-group">
                            <span class="input-group-addon" id="mtarjeta">Tarjeta</span>
                            <input type="text" name="mtarjeta" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group input-group">
                            <span class="input-group-addon" id="mpago">Recibí</span>
                            <input type="text" name="mpago" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary pagar" value="pagar">Pagar</button>
            </div>
        </div>
    </div>
</div>
<div style="display :none;" id="codes"></div>

<!-- Modal Abonar-->
<div class="modal fade " id="abonar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Abonar a apartado</h4>
            </div>
            <div class="modal-body">   
                <div class="container abonar-mod" >
                    <div class="col-md-6 col-md-offset-3">
                        <table class="table table-bordered table-hover table-striped">
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
                                        <td>Cantidad Mínima</td>
                                        <td id="min"></td>
                                    </tr>
                                    <tr>
                                        <td>Efectivo</td>
                                        <td>
                                            <input type="hidden" id="bandera" value="0">
                                            <input type="text" id="efec" class="form-control" value="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tarjeta:</td>
                                        <td ><input type="text" id="tarj" class="form-control" value="0"></td>
                                    </tr>
                                    <tr>
                                        <td>Monedero:</td>
                                        <td><input type="text" id="moned" class="form-control" value="0"></td>
                                    </tr>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="send-abono" onclick="abonar()">Abonar</button>
            </div>
        </div>
    </div>
</div>
<?php include_once('Vistas/modal/mensaje.php'); ?>