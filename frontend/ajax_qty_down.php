<?php
  session_start();
  ob_start();
  include "connect.php";
  $getId = $_POST['getId'];
  $_SESSION['cart'][$getId]['qty'] -= 1;
  $qty = $_SESSION['cart'][$getId]['qty'];
  if ($qty == 0) {
    if (count($_SESSION['cart']) == 1) {
      unset($_SESSION['cart']);
      header("Location: index.php");
    }
    unset($_SESSION['cart'][$getId]);
  }
?>