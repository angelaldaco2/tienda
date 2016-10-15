<?php 
include_once ('Config/connect.php');
$id=base64_decode($_GET['id']);
switch ($id){
	case 1:
		$titulo='Consultar Productos';
		$js=array(
			'apartado'=>'assets/js/productos.js',
		);
		$link=array(
		);
		

		include_once('Vistas/Header.php');
		include_once('Vistas/Formularios/consultarProducto.php');
		include_once('Vistas/Footer.php');
		
		break;
	case 2:
		$sql=('SELECT * FROM Producto WHERE ID_Producto="'.base64_decode($_GET['ID_Producto']).'"');
		$result=mysql_query($sql);
		$tupla=mysql_fetch_array($result);
			
		echo mysql_error();
		$titulo='Detalles del Producto';
		include_once('Vistas/Header.php');
		include_once('Vistas/Formularios/consultarDetallesProducto.php');
		include_once('Vistas/Footer.php');
		break;
	case 3:
		$titulo='Modificar Producto';
		$js=array(
			'jquery'=>'assets/js/jquery-2.1.0.js',
			'modifcar'=>'assets/js/productos.js'
		);
		include_once('Vistas/Header.php');
		include_once('Vistas/Formularios/modificarProducto.php');
		include_once('Vistas/Footer.php');
	break;
}