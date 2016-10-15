<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $titulo; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript" src="assets/js/jquery-2.1.0.js"></script>
<script type="text/javascript" src="Bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href=" Bootstrap/css/bootstrap.min.css" />

<link rel="stylesheet" href=" assets/css/cover.css" />
<link rel="stylesheet" href=" assets/css/App.css" />
<?php
if(isset($js)){
	foreach($js as $val):
		echo '<script type="text/javascript" src="' . $val . '"></script>' . "\n";
	endforeach;
}
if(isset($link)){
	foreach($link as $val):
		echo '<link rel="stylesheet" href=" ' . $val . '" />' . "\n";
	endforeach;
}
if(isset($script)){
	foreach($script as $val):
		?>
        <script type="text/javascript">
		<?php echo $val; ?>
        </script>
        <?php
	endforeach;
}
if(isset($style)){
	foreach($style as $val):
		?>
        <style>
		<?php echo $val; ?>
        </style>
        <?php
	endforeach;
}
?>



</head>
<body>

	<nav class="navbar navbar-inverse " role="navigation">
		<div class="container">	
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#colapsar">
					<span class="sr-only">Desplegar navegación</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
	            <div class="navbar-brand" style="padding-top:2.5px">
					<img src="images/Logo.png" style="max-height:50px">
				</div>
			</div>

			<div class="collapse navbar-collapse" id="colapsar">
				<ul class="nav navbar-nav" style="font-size:18px">
					<li><a href="index.php"><span class="glyphicon glyphicon-home" ></span> Inicio</a></li>
					<li><a href="newVentas.php"><span class="glyphicon glyphicon-shopping-cart"></span> Iniciar Venta</a></li>
					<li><a target="_blank" href="Ventas.php"><span class="glyphicon glyphicon-usd"></span> Ventas</a></li>
					<li><a target="_blank" href="grupoCliente.php?id=<?php echo base64_encode (1);?>"><span class="glyphicon glyphicon-heart"></span> Clientes</a></li>
					<li><a target="_blank" href="Catalogos.php"><span class="glyphicon glyphicon-list-alt"></span> Catálogos</a></li>
					<!--<li><a href="Empleados.php"><span class="glyphicon glyphicon-off" ></span> Salir </a></li>-->
				</ul>
			</div>
		</div>
	</nav>

<div class="container">
	<div class="row">
		<div class="col-lg-12">	
        	<div class="jumbotron" style="background: #fff">
            	<div class="row">
    				<div class="col-lg-12">