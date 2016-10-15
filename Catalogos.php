<?php 
$titulo="Catálogos";

include_once ('Vistas/Header.php');
?>
<div class="col-xs-12">
	<legend>Menú Catálogos</legend>
</div>
<div class="row" >
	<div class="col-sm-4 col-md-12 col-xs-12">
       <a target="_blank" href="grupoProducto.php?id=<?php echo base64_encode (1);?>" class="dashboard-stat primary" >
        <div class="container">
            <span class="content" >PRODUCTOS</span>
            <span class="value"><span class="glyphicon glyphicon-th-list"></span>
        </div> <!-- /.details -->
        </a>
	</div>
</div>
<br  />
<div class="row" >
	<div class="col-sm-4 col-md-6 col-xs-12">
    	<a target="_blank" href="grupoCategoria.php?id=<?php echo base64_encode (1);?>" class="dashboard-stat primary" >
        <div class="container">
            <span class="content" >CATEGORÍAS</span>
            <span class="value"><span class="glyphicon glyphicon-tag"></span>
        </div> <!-- /.details -->
        </a>
	</div>
	<div class="col-sm-4 col-md-6 col-xs-12">
		<a href="grupoSubcategoria.php?id=<?php echo base64_encode (1);?>" class="dashboard-stat primary">
        	<div class="container">
            	<span class="content">SUBCATEGORÍAS</span>
            	<span class="value"><span class="glyphicon glyphicon-tags"></span>
        	</div> <!-- /.details -->
        </a>
	</div>
</div>

<br />

<div class="row" >
	<div class="col-sm-4 col-md-6 col-xs-12">
       <a target="_blank" href="grupoColor.php?id=<?php echo base64_encode (1);?>" class="dashboard-stat primary" >
        <div class="container">
            <span class="content" >COLORES</span>
            <span class="value"><span class="glyphicon glyphicon-eye-open"></span>
        </div> <!-- /.details -->
        </a>
  
	</div>
	<div class="col-sm-4 col-md-6 col-xs-12">
    	<a target="_blank" href="grupoMarca.php?id=<?php echo base64_encode (1);?>" class="dashboard-stat primary" >
        <div class="container">
            <span class="content" >MARCAS</span>
            <span class="value"><span class="glyphicon glyphicon-certificate"></span>
        </div> <!-- /.details -->
        </a>
	</div>
</div>


