<?php
  session_start();
  include "connect.php";
  $getId = $_POST['getId'];
  $_SESSION['cart'][$getId]['qty'] += 1;
  echo $_SESSION['cart'][$getId]['qty'];
?>