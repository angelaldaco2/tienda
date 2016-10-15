<?php 
include_once ('Config/connect.php');
$id=base64_decode($_GET['id']);
switch ($id){
	case 1:
$js=array(
			
			'color'=>'assets/js/colores.js',
	
		);
		$link=array(
		);
		

		include_once('Vistas/Header.php');
		include_once('Vistas/Formularios/consultarColor.php');
		include_once('Vistas/Footer.php');
		
		break;

}