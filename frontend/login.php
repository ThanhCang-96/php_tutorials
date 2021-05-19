<?php
	session_start();
	ob_start();
	include "connect.php";
	if (isset($_POST['login'])) {

		// biến kiểm tra
		$flash = true;

		// kiểm tra email
		if (isset($_POST['email'])) {
			$email = $_POST['email'];
		} else $flash = false;

		// kiểm tra mật khẩu
		if (isset($_POST['pass'])) {
			// $pass = md5($_POST['pass']);
			$pass = $_POST['pass'];
		}else $flash = false;

		if ($flash) {
			$sql = "select id, email, password from `user` 
				where email = '".$email."' and password = '".$pass."'";
			$result = $con->query($sql);
			if ($result->num_rows == 0) {
				echo "Tài khoản không tồn tại!";
  		} else {
				$row = $result->fetch_assoc();
				$_SESSION['user'] = $row['id'];
				header("Location: http://localhost/php_tutorials/frontend/account.php");
			}
		} else echo "Vui lòng nhập đầy đủ thông tin đăng nhập";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | E-Shopper</title>
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
	<?php include 'shared/_header.php'; ?>
  <section><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form method="POST">
							<input type="text" name="email" placeholder="Email Address" />
							<input type="password" name="pass" placeholder="Password" />
							<!-- <span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span> -->
              
							<button type="submit" name="login" class="btn btn-default">Login</button>
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