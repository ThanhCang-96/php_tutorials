<?php 
  session_start();
  ob_start();
  include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Register | E-Shopper</title>
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

    $getAllSql = "select email from `user`";
    $result = $con->query($getAllSql);
    $arrEmail = [];
    if ($result->num_rows > 0) {

      //Gắn dữ liệu lấy được vào mảng $data
      while ($row = $result->fetch_assoc()) {
          $arrEmail[] = $row;
      }
    }
    if (isset($_POST['register'])) {

      // biến kiểm tra
      $flash = true;

      // kiểm tra email
      if (isset($_POST['email'])) {
        $email = $_POST['email'];
        if (in_array($email, $arrEmail)) {
          $flash = false;
        }
      } else $flash = false;

      // kiểm tra mật khẩu
      if (isset($_POST['pass'])) {
        $pass = $_POST['pass'];
        // $pass = md5($pass);
        $pass = $pass;
      }else $flash = false;

      // kiểm tra họ tên
      if (isset($_POST['name'])) {
        $name = $_POST['name'];
      }else $flash = false;

      // kiểm tra avatar
      if (isset($_FILES['avatar']))
      { 
        $arrImg = array("jpg", "jpeg", "png");
        // Nếu file upload không bị lỗi,
        // Tức là thuộc tính error > 0
        if ($_FILES['avatar']['error'] > 0)
        {
          $flash = false;
          // echo 'File Upload Bị Lỗi';
        }
        else if ($_FILES['avatar']['size'] > 1048576){
          $flash = false;
        } else{
          $imgName = $_FILES['avatar']['name'];
          $arrImgName = explode(".",$imgName);
          $isImg = in_array($arrImgName[count($arrImgName)-1], $arrImg);
          if ($isImg) {
            move_uploaded_file($_FILES['avatar']['tmp_name'], './images/avatar/'.$_FILES['avatar']['name']);
          } else $flash = false;
        }
      } else{
        $flash = false;
      }

      if ($flash) {
        $sql = "INSERT INTO `user` (`email`, `password`, `name`, `avatar`) 
        VALUES ('".$email."','".$pass."','".$name."','".$imgName."')";

        $success = $con->query($sql);
        // printf ($success);
        if ($success) {
          echo "SUCCESS!";
          $getId = "select id from `user` where email = '".$email."'";
          $result1 = $con->query($getId);
          $data = [];
          if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
              $data = $row;
            }
          }
          $idUser = $data['id'];
          $_SESSION['user'] = $idUser;
          // echo "<h1>abc".$idUser."</h1>";
          header("Location: http://localhost/php_tutorials/frontend/");
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
						<form action="#" method="POST" enctype="multipart/form-data">
							<input type="text" placeholder="Email" name="email"/>
							<input type="text" placeholder="Password" name="pass"/>
              <input type="text" placeholder="Name" name="name"/>
							<!-- <span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span> -->
              <input type="file" name="avatar"/>
							<button type="submit" class="btn btn-default" name="register">Register</button>
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