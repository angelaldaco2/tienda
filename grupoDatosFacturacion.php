<?php 
include_once ('Config/connect.php');
$id=base64_decode($_GET['id']);
switch ($id){
	case 1:
		$titulo='Consultar Datos de Facturacion';
		$js=array(
			'jquery'=>'assets/js/jquery-2.1.0.js',
			'colorbox'=>'assets/js/jquery.colorbox.js'
		);

		$link=array(
			'colorbox'=>'assets/css/colorbox.css'
		);
		
		$script=array(
			'iframes'=>'
				$(document).ready(function(){
					$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
					$("#click").click(function(){ 
						$("#click").css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
					});
				});		
		'
		);
		include_once('Vistas/Header.php');
		include_once('Vistas/Formularios/consultarDatosFacturacion.php');
		include_once('Vistas/Footer.php');
		
		break;
	case 2:
		$sql=('SELECT * FROM DatosFacturacion WHERE RFC="'.base64_decode($_GET['RFC']).'"');
		$result=mysql_query($sql);
		$tupla=mysql_fetch_array($result);
			
		echo mysql_error();
		$titulo='Detalles del Cliente';
		include_once('Vistas/Header.php');
		include_once('Vistas/Formularios/consultarDetallesDatosFacturacion.php');
		include_once('Vistas/Footer.php');
		break;
	case 3:
		$titulo='Modificar Datos de Facturacion';
		$js=array(
			'jquery'=>'assets/js/jquery-2.1.0.js',
			'modifcar'=>'assets/js/datosFacturacion.js'
		);
		include_once('Vistas/Header.php');
		include_once('Vistas/Formularios/modificarDatosFacturacion.php');
		include_once('Vistas/Footer.php');
	break;
	case 4:
		$titulo="Datos de Facturacion";
		$js=array(
			'jquery'=>'assets/js/jquery-2.1.0.js',
		);
		
		include_once ('Vistas/Header.php');
		include_once ('Vistas/Formularios/addDatosFacturacion.php');
		include_once ('Vistas/Footer.php');
	break;
	default:
		include_once('Vistas/Errores/404.php');
}