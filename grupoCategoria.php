<?php 
/*Se incluye la conexión a la Base de Datos*/
include_once ('Config/connect.php');
$id=base64_decode($_GET['id']);
/* Se crea un Switch que contendrá las opciones a seleccionar */ 
switch ($id){
	/* Se muestran los resultados de la consulta */ 
	case 1:
		$titulo='Consultar Categorias';
		$js=array(
			'tabla'=>'tabla/media/js/jquery.dataTables.js',
			'categorias'=>'assets/js/categorias.js',
		);

		$link=array(
			'tabla'=>'tabla/media/css/jquery.dataTables.css',
		);
		
		include_once('Vistas/Header.php');
		include_once('Vistas/Formularios/consultarCategoria.php');
		include_once('Vistas/Footer.php');
		
		break;
}