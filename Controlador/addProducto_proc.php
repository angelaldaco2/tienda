
<?php
include_once('../Config/connect.php');

$sql_categoria="SELECT NombreCategoria FROM Categoria Where ID_Categoria='". strtoupper($_POST['categoria']."'");
$res_categoria=mysql_query($sql_categoria);
$nom_categoria=mysql_fetch_array($res_categoria);

$sql_subcategoria1="SELECT NombreSubCategoria FROM Subcategoria Where ID_Subcategoria='". strtoupper($_POST['subcat1']."'");
$res_subcategoria1=mysql_query($sql_subcategoria1);
$nom_subcategoria1=mysql_fetch_array($res_subcategoria1);

$sql_subcategoria2="SELECT NombreSubCategoria FROM Subcategoria Where ID_Subcategoria='". strtoupper($_POST['subcat2']."'");
$res_subcategoria2=mysql_query($sql_subcategoria2);
$nom_subcategoria2=mysql_fetch_array($res_subcategoria2);

$sql_subcategoria3="SELECT NombreSubCategoria FROM Subcategoria Where ID_Subcategoria='". strtoupper($_POST['subcat3']."'");
$res_subcategoria3=mysql_query($sql_subcategoria3);
$nom_subcategoria3=mysql_fetch_array($res_subcategoria3);


$color=ltrim($_POST['color']);
$sql_color="SELECT NombreColor from Color where ID_Color='".$color."'";
$res_color=mysql_query($sql_color);
$obj_color=mysql_fetch_array($res_color);


switch ($_POST['talla']){
	case '1': $_POST['talla']='01';
	break;
	case '3': $_POST['talla']='03';
	break;
	case '5': $_POST['talla']='05';
	break;
	case '7': $_POST['talla']='07';
	break;
	case '9': $_POST['talla']='09';
	break;
	case '11': $_POST['talla']='11';
	break;
	case '13': $_POST['talla']='13';
	break;
	case '15': $_POST['talla']='15';
	break;
}

$clave=strtoupper(ltrim($_POST['marca']) . '-' . ($_POST['estilo']) . ($_POST['color']) . ($_POST['talla']));

$descripcion=strtoupper(ltrim($nom_categoria['NombreCategoria']) . ' ' .($obj_color['NombreColor']) . ' ' .($nom_subcategoria1['NombreSubCategoria']) . ' ' .($nom_subcategoria2['NombreSubCategoria']) . ' ' .($nom_subcategoria3['NombreSubCategoria']) . ' ' .($_POST['talla']));
$costo=strtoupper(ltrim($_POST['precio']/2));
$precio=strtoupper(ltrim($_POST['precio']));

$marca=strtoupper(ltrim($_POST['marca']));
$estilo=strtoupper(ltrim($_POST['estilo']));
$categoria=ltrim($_POST['categoria']);

$subcat1=ltrim($_POST['subcat1']);
$subcat2=ltrim($_POST['subcat2']);
$subcat3=ltrim($_POST['subcat3']);
$talla=strtoupper(ltrim($_POST['talla']));
$cantidad=strtoupper(ltrim($_POST['cantidad']));

$sql="CALL RegistrarProductos ('" . $clave . "','" . $descripcion . "','" . $precio . "','" . $costo . "','" . $talla . "','" . $marca . "','" . $estilo . "','" . $categoria . "','" . $color . "','" . $subcat1 . "','" . $subcat2 . "','" . $subcat3 . "','" . $cantidad . "');";
mysql_query($sql);
if(mysql_error()){
		echo "Mensaje de error " . mysql_error();
	}else{
echo "Datos agregados correctamente";
	}	
?>