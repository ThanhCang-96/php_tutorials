<?php
  include 'connect.php';
  $id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sửa đổi thông tin cầu thủ</title>
  <style>
    input{
      display: block;
    }
  </style>
</head>
<body>
  <?php
    if (isset($_POST['edit'])) {
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

      // $sql = "UPDATE thongtincauthu SET 
      //   `ten`='".$ten."', 
      //   `tuoi`=".$tuoi.", 
      //   `quoctich`='".$quoctich."', 
      //   `vitri`='".$vitri."', 
      //   `luong`=".$luong."
      //   WHERE `id` = ".$id;

        $sql = "UPDATE `thongtincauthu` SET 
        `ten`='".$ten."',
        `tuoi`='".$tuoi."',
        `quoctich`='".$quoctich."',
        `vitri`='".$vitri."',
        `luong`='".$luong."' 
        WHERE id = ".$_GET['id'];

      // (`ten`, `tuoi`, `quoctich`, `vitri`, `luong`) 
      // VALUES ('".$ten."',".$tuoi.",'".$quoctich."','".$vitri."',".$luong.")";

      if ($flash) {
        // if ($result = $con->query($sql)) {
        if ($result = $con->query($sql)) {
          echo "<h1> Sửa đổi dữ liệu thành công </h1>";
        } else {
          echo "<h1>Không thành công!</h1>";
        }
      }
    }
  ?>
  <form action="#" method="post">
    Tên cầu thủ: <input type="text" name="ten" id="">
    Tuổi: <input type="text" name="tuoi" id="">
    Quốc tịch: <input type="text" name="quoctich" id="">
    Vị trí: <input type="text" name="vitri" id="">
    Lương: <input type="text" name="luong">
    <button type="submit" name="edit">Sửa</button>
  </form>
</body>
</html>