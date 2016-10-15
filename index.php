<?php 
$titulo="Página Principal";
include_once ('Vistas/Header.php');
?>

<div class="col-xs-12">
  <legend>Menú Principal</legend>
  <div class="row" >
    <div class="col-sm-4 col-md-4 col-xs-12">
      <a target="_blank" href="grupoApartado.php?id=<?php echo base64_encode (1);?>" class="dashboard-stat primary">
        <div class="container">
            <span class="content">APARTADOS</span>
            <span class="value"><span class="glyphicon glyphicon-inbox"></span>
        </div> <!-- /.details -->
      </a>
    </div>
    <div class="col-sm-4 col-md-4 col-xs-12">
      <a target="_blank" href="grupoVenta.php?id=<?php echo base64_encode (1);?>" class="dashboard-stat primary" >
        <div class="container">
          <span class="content" >VENTAS REALIZADAS</span>
          <span class="value"><span class="glyphicon glyphicon-check"></span>
        </div> <!-- /.details -->
      </a>
    </div>
    <div class="col-sm-4 col-md-4 col-xs-12">
      <a target="_blank" href="grupoCliente.php?id=<?php echo base64_encode (1);?>" class="dashboard-stat primary" >
        <div class="container">
          <span class="content" >Clientes</span>
          <span class="value"><span class="glyphicon glyphicon-user"></span>
        </div> <!-- /.details -->
      </a>
    </div>
  </div>

  </br>
  <div class="row" >
    <div class="col-sm-4 col-md-4 col-xs-12">
      <a target="_blank" href="grupoGastos.php?id=<?php echo base64_encode (1);?>" class="dashboard-stat primary" >
        <div class="container">
          <span class="content">CAJA</span>
          <span class="value"><span class="glyphicon glyphicon-usd"></span>
        </div> <!-- /.details -->
      </a>
    </div>
    <div class="col-sm-4 col-md-4 col-xs-12">
       <a target="_blank" href="grupoProducto.php?id=<?php echo base64_encode (1);?>" class="dashboard-stat primary" >
        <div class="container">
            <span class="content" >PRODUCTOS</span>
            <span class="value"><span class="glyphicon glyphicon-th-list"></span>
        </div> <!-- /.details -->
        </a>
    </div>
    <div class="col-sm-4 col-md-4 col-xs-12">
      <a target="_blank" href="grupoCategoria.php?id=<?php echo base64_encode (1);?>" class="dashboard-stat primary" >
        <div class="container">
            <span class="content" >CATEGORÍAS</span>
            <span class="value"><span class="glyphicon glyphicon-tag"></span>
        </div> <!-- /.details -->
        </a>
    </div>
  </div>
</br>
  <div class="row" >
    <div class="col-sm-4 col-md-4 col-xs-12">
      <a target="_blank" href="grupoSubcategoria.php?id=<?php echo base64_encode (1);?>" class="dashboard-stat primary">
        <div class="container">
          <span class="content">SUBCATEGORÍAS</span>
          <span class="value"><span class="glyphicon glyphicon-tags"></span>
        </div> <!-- /.details -->
      </a>
    </div>
    <div class="col-sm-4 col-md-4 col-xs-12">
      <a target="_blank" href="grupoColor.php?id=<?php echo base64_encode (1);?>" class="dashboard-stat primary" >
        <div class="container">
          <span class="content" >COLORES</span>
          <span class="value"><span class="glyphicon glyphicon-eye-open"></span>
        </div> <!-- /.details -->
      </a>
    </div>
    <div class="col-sm-4 col-md-4 col-xs-12">
      <a target="_blank" href="grupoMarca.php?id=<?php echo base64_encode (1);?>" class="dashboard-stat primary" >
        <div class="container">
          <span class="content" >MARCAS</span>
          <span class="value"><span class="glyphicon glyphicon-certificate"></span>
        </div> <!-- /.details -->
      </a>
    </div>
  </div>
<?php
include_once ('Vistas/Footer.php');
?>
