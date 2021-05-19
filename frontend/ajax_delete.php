<?php
  // echo ("abc");
  session_start();
  include "connect.php";
  $productId = $_POST['proId'];
  if (count($_SESSION['cart']) == 1) {
    unset($_SESSION['cart']);
  }
  unset($_SESSION['cart'][$productId]);

  // // if (!empty($_SESSION["cart"])) {
  // //   foreach ($_SESSION["cart"] as $keys => $val) {
  // //       if($val["id"] == $productId)
  // //       {
  // //           unset($_SESSION["cart"][$keys]);
  // //       }
  // //   }
  // // }
  // $_SESSION['cart'][$productId]['qty'] += 1;
  // echo $_SESSION['cart'][$productId]['qty'];
?>