<?php
  session_start();
  include "connect.php";
  if (isset($_SESSION['user'])) {
    $getId = $_POST['id'];
  $sql = "select id,title, price, image from product where id = ".$getId;
  $result = $con->query($sql);
  $data = [];
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = $row;
    $data['qty'] = 1;
  }
  if (isset($_SESSION['cart'][$getId])) {
    $_SESSION['cart'][$getId]['qty'] += 1;
  }else{
    $_SESSION['cart'][$getId] = $data;
  }
  echo count($_SESSION['cart']);
  } else echo "Vui lòng đăng nhập để mua hàng!";
?>