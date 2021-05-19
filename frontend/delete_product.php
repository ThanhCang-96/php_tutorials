<?php 
	session_start();
  ob_start();
	include "connect.php";
  $idProduct = $_GET['proId'];

  $sql = "DELETE FROM `product` WHERE `id`=".$idProduct;
  $result  = $con->query($sql);
  if ($result) {
    echo "SUCCESS!";
    header("Location: http://localhost/php_tutorials/frontend/list_product.php");
  }
?>