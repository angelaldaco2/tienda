<?php 

mysqli_connect('localhost','root','1234',false,65536) or die(mysqli_error());
//mysql_connect('192.168.1.71','user','1234',false,65536) or die(mysql_error());
mysqli_select_db('tiendamini') or die(mysqli_error());
//mysql_select_db('tienda2') or die(mysql_error());

?>