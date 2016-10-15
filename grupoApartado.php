<?php 
include_once ('Config/connect.php');
$id=base64_decode($_GET['id']);
switch ($id){
	case 1:
		$titulo='Consultar Apartados';
		$js=array(

			'apartado'=>'assets/js/apartados.js',
		);
		$link=array(
		);
		
		include_once('Vistas/Header.php');
		include_once('Vistas/Formularios/consultarApartado.php');
		include_once('Vistas/Footer.php');
		
		break;
	
}