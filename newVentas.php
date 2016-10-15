<?php 
$titulo="Iniciar Venta";
$js=array(
	//'otro'=>'//code.jquery.com/jquery-1.10.2.js',
	'uijs'=>'assets/js/ui/jquery-ui.js',
	'venta'=>'assets/js/venta.js'
);

$link=array(
	'scroll'=>'assets/css/Scroll.css',
	'uicss'=>'assets/css/ui-lightness/jquery-ui-1.10.4.custom.css',
);

include_once ('Vistas/Header.php');
include_once('Vistas/Formularios/newVenta.php');
include_once ('Vistas/Footer.php');

?>
