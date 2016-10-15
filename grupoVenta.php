<?php 
include_once ('Config/connect.php');
$id=base64_decode($_GET['id']);
switch ($id){
	case 1:
		$titulo='Consultar Ventas';
		$js=array(

			'venta'=>'assets/js/consultarVenta.js',
			'productos'=>'assets/js/consultarProductoVenta.js'

		);
		$link=array(
		);
		
		
		include_once('Vistas/Header.php');
		include_once('Vistas/Formularios/consultarVenta.php');
		include_once('Vistas/Footer.php');
		
		break;
	
		/* Modificar una Venta */

}