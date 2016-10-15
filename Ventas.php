<?php 
$titulo="Ventas";

include_once ('Vistas/Header.php');
?>

<div class="col-xs-12">
	<legend>Menú Ventas</legend>
</div>


<div class="row" >
	<div class="col-sm-12 col-md-12 col-xs-12">
       <a target="_blank" href="newVentas.php" class="dashboard-stat primary" >
        <div class="container">
            <span class="content" >INICIAR VENTA</span>
            <span class="value"><span class="glyphicon glyphicon-shopping-cart"></span>
        </div> <!-- /.details -->
        </a>
  
<br />

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
       <a target="_blank" href="grupoGastos.php?id=<?php echo base64_encode (1);?>" class="dashboard-stat primary" >
        <div class="container">
            	<span class="content">CAJA</span>
            	<span class="value"><span class="glyphicon glyphicon-heart-empty"></span>
        	</div> <!-- /.details -->
        </a>
  
	</div>
</div>
<br />

	
	
</div>
