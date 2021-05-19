<?php 
	session_start();
  ob_start();
	include "connect.php";
  $idProduct = $_GET['proId'];

  $getSql = "select id, title, price, image from product where id = ".$idProduct;
  $result  = $con->query($getSql);
  if ($result->num_rows > 0) {
    $row = $result -> fetch_assoc();
    $getId = $row['id'];
    $getTitle = $row['title'];
    $getPrice = $row['price'];
    $getImage = $row['image'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Update product | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<?php 

    include 'shared/_header.php';

    if (isset($_POST['update'])) {

      // biến kiểm tra
      $flash = true;

      // kiểm tra tên sản phẩm
      if (isset($_POST['title'])) {
        $title = $_POST['title'];
      } else $flash = false;

      // kiểm tra giá
      if (isset($_POST['price'])) {
        $price = $_POST['price'];
      }else $flash = false;

      // kiểm tra hinh ảnh sản phẩm
      if (!empty($_FILES['imgProduct']['name']))
      { 
        $arrImg = array("jpg", "jpeg", "png");
        // Nếu file upload không bị lỗi,
        // Tức là thuộc tính error > 0
        if ($_FILES['imgProduct']['error'] > 0)
        {
          $flash = false;
          // echo 'File Upload Bị Lỗi';
        }
        else if ($_FILES['imgProduct']['size'] > 1048576){
          $flash = false;
        } else{
          $imgName = $_FILES['imgProduct']['name'];
          $arrImgName = explode(".",$imgName);
          $isImg = in_array($arrImgName[count($arrImgName)-1], $arrImg);
          if ($isImg) {
            move_uploaded_file($_FILES['imgProduct']['tmp_name'], './images/cart/'.$_FILES['imgProduct']['name']);
          } else $flash = false;
        }
      } else{
        $imgName = $getImage;
      }

      if ($flash) {
        $sql = "UPDATE `product` SET 
				`title`='".$title."',
				`price`='".$price."',
				`image`='".$imgName."' 
				WHERE id = ".$idProduct;

        $success = $con->query($sql);
        // printf ($success);
        if ($success) {
          header("Location: http://localhost/php_tutorials/frontend/list_product.php");
          echo "Thêm sản phẩm thành công!";
        }
      } else echo "Thông tin đăng kí không hợp lệ";
    }
  ?>
  <section><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form method="POST" enctype="multipart/form-data">
							<input type="text" placeholder="Id" name="id" readonly="readonly" value="<?php echo $getId ?>"/>

							<input type="text" placeholder="title" name="title" value="<?php echo $getTitle ?>"/>

							<input type="text" placeholder="price" name="price" value="<?php echo $getPrice ?>"/>

              <input type="file" name="imgProduct"/>

							<img src="../frontend/images/cart/<?php echo $getImage ?>" alt="" width="50px" height="50px">

							<button type="submit" class="btn btn-default" name="update">Update</button>
						</form>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
  <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
  <script src="js/jquery.prettyPhoto.js"></script>
  <script src="js/main.js"></script>
</body>
</html>