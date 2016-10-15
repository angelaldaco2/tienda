<?php 
include_once ('Config/connect.php');
$id=base64_decode($_GET['id']);
switch ($id){
	case 1:
		$titulo='Consultar Gastos';
		$js=array(
			'tabla'=>'tabla/media/js/jquery.dataTables.js',
			'gasto'=>'assets/js/gastos.js',	
			'caja'=>'assets/js/caja.js'	
		);

		$link=array(
			'tabla'=>'tabla/media/css/jquery.dataTables.css',
			);
		
		include_once('Vistas/Header.php');
		include_once('Vistas/Formularios/consultarGastos.php');
		include_once('Vistas/Footer.php');
		break;
}