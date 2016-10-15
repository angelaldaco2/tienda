<?php 
include_once('../config/connect.php');		
$ID=$_POST['ID'];
$sql= "select * from Producto left join Marca on Marca.ID_Marca=Producto.ID_Marca left join Categoria on Categoria.ID_Categoria=Producto.ID_Categoria 
left join Color on Color.ID_Color=Producto.ID_Color left join subcategoria on Subcategoria.ID_SubCategoria=Producto.Subcategoria1 where Producto.ID_Producto='". $ID ."'";


$result=mysql_query($sql);
$tupla=mysql_fetch_array($result);
if(!mysql_error()){
 echo json_encode($tupla);
}

?>