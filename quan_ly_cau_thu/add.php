<?php
  include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thêm Cầu thủ</title>
  <style>
    input{
      display: block;
    }
  </style>
</head>
<body>
  <?php
    if (isset($_POST['add'])) {
      $flash = true;
      if (!empty($_POST['ten'])) {
        $ten = $_POST['ten'];
      } else $flash = false;
      if (!empty($_POST['tuoi'])) {
        $tuoi = $_POST['tuoi'];
      } else $flash = false;
      if (!empty($_POST['quoctich'])) {
        $quoctich = $_POST['quoctich'];
      } else $flash = false;
      if (!empty($_POST['vitri'])) {
        $vitri = $_POST['vitri'];
      } else $flash = false;
      if (!empty($_POST['luong'])) {
        $luong = $_POST['luong'];
      } else $flash = false;

      $sql = "INSERT INTO `thongtincauthu` (`ten`, `tuoi`, `quoctich`, `vitri`, `luong`) 
      VALUES ('".$ten."',".$tuoi.",'".$quoctich."','".$vitri."',".$luong.")";

      if ($flash) {
        // if ($result = $con->query($sql)) {
        if ($result = $con->query($sql)) {
          echo "Thêm dữ liệu thành công";
        } else {
            echo "Không thành công!";
        }
      }
    }
  ?>
  <form action="index.php" method="post">
    Tên cầu thủ: <input type="text" name="ten" id="">
    Tuổi: <input type="text" name="tuoi" id="">
    Quốc tịch: <input type="text" name="quoctich" id="">
    Vị trí: <input type="text" name="vitri" id="">
    Lương: <input type="text" name="luong">
    <button type="submit" name="add">Thêm cầu thủ</button>
  </form>
</body>
</html>