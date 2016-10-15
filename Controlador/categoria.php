<?php
switch($_GET['opc']){
    case 'cat':
        include_once('../config/connect.php');
        $sql="SELECT * FROM categoria WHERE ID_Categoria='" . $_POST['ID'] . "'";
        $result=mysql_query($sql);
        $tupla=mysql_fetch_array($result);
        if(!mysql_error()){
            echo json_encode($tupla);
        }else{
            echo mysql_error();
        }
    break;
    case 'Subcat':
        include_once('../config/connect.php');
        $ID=$_POST['ID'];
        $sql = 'SELECT * from Subcategoria  where ID_Subcategoria="' . $ID . '"';
        $result=mysql_query($sql);
        $tupla=mysql_fetch_array($result);
        if(!mysql_error()){
            echo json_encode($tupla);
        }else{
            echo mysql_error();
        }
    break;
};
?>