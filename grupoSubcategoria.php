<?php 
include_once ('Config/connect.php');
$id=base64_decode($_GET['id']);
switch ($id){
	case 1:
		$titulo='Consultar Subcategorias';
	$js=array(
			'tabla'=>'tabla/media/js/jquery.dataTables.js',
			'Subcat'=>'assets/js/subcategorias.js',
			'colorbox'=>'assets/js/jquery.colorbox.js'
		);
		$link=array(
			'tabla'=>'tabla/media/css/jquery.dataTables.css',
			'colorbox'=>'assets/css/colorbox.css'
		);
		
		include_once('Vistas/Header.php');
		include_once('Vistas/Formularios/consultarSubcategoria.php');
		include_once('Vistas/Footer.php');
		break;
	case 3:
		$titulo='Modificar Categoria';
		$js=array(
			'jquery'=>'assets/js/jquery-2.1.0.js',
			'modifcar'=>'assets/js/subcategorias.js'
		);
		include_once('Vistas/Header.php');
		include_once('Vistas/Formularios/modificarSubcategoria.php');
		include_once('Vistas/Footer.php');
	break;
}