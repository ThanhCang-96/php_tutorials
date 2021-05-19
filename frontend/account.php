<?php 
	session_start();
	include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Account</title>
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

		if (isset($_SESSION['user'])) {
			$id = $_SESSION['user'];

			$sql = "select email, password, name, avatar from user where id = ".$id;
			$result  = $con->query($sql);
			if ($result->num_rows > 0) {
				$row = $result -> fetch_assoc();
				$getEmai = $row['email'];
				$getPass = $row['password'];
				$getName = $row['name'];
				$getAvatar = $row['avatar'];
			}
		}
		
		if (isset($_POST['update'])) {
			// biến kiểm tra
			$flash = true;

			// kiểm tra mật khẩu
			if (!empty($_POST['pass'])) {
				$pass = $_POST['pass'];
			}else $flash = false;

			// kiểm tra họ tên
			if (!empty($_POST['name'])) {
				$name = $_POST['name'];
			}else $flash = false;

		// kiểm tra avatar
			if (!empty($_FILES['avatar']['name']))
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
				$imgName = $getAvatar;
			}	

			if ($flash) {
				$sql = "UPDATE `user` SET 
				`password`='".$pass."',
				`name`='".$name."',
				`avatar`='".$imgName."' 
				WHERE id = ".$id;

				if ($con->query($sql) == true) {
					echo "<h1> Sửa đổi dữ liệu thành công </h1>";
				} else {
					echo "<h1>Không thành công!</h1>";
				}
      } else echo "Thông tin cập nhật không hợp lệ";
		}
	?>
	
	<section><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<h2>New User Signup!</h2>
					<div class="left" >
						<a href="account.php">Account</a><i class="fa fa fa-plus"></i>
					</div>		
					<div class="left" >
						<a href="list_product.php?id='<?php $id ?>'" >Products	</a><i class="fa fa fa-plus"></i>
					</div>	
				</div>	
				<div class="col-sm-9">
					<div class="signup-form"><!--sign up form-->
						<h2>Update user!</h2>
						<form action="#" method="POST" enctype="multipart/form-data">
							<input type="text" placeholder="Email" name="email" readonly="readonly" value="<?php echo $getEmai ?>"/>
							<input type="text" placeholder="Password" name="pass" value="<?php echo $getPass ?>"/>
              <input type="text" placeholder="Name" name="name" value="<?php echo $getName ?>"/>
              <input type="file" name="avatar" value="<?php $getAvatar ?>"/>
							<img src="../frontend/images/avatar/<?php echo $getAvatar ?>" alt="" width="50px" height="50px">
							<button type="submit" class="btn btn-default" name="update">Update</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe1.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe2.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe3.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe4.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Online Help</a></li>
								<li><a href="">Contact Us</a></li>
								<li><a href="">Order Status</a></li>
								<li><a href="">Change Location</a></li>
								<li><a href="">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">T-Shirt</a></li>
								<li><a href="">Mens</a></li>
								<li><a href="">Womens</a></li>
								<li><a href="">Gift Cards</a></li>
								<li><a href="">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Terms of Use</a></li>
								<li><a href="">Privecy Policy</a></li>
								<li><a href="">Refund Policy</a></li>
								<li><a href="">Billing System</a></li>
								<li><a href="">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Company Information</a></li>
								<li><a href="">Careers</a></li>
								<li><a href="">Store Location</a></li>
								<li><a href="">Affillate Program</a></li>
								<li><a href="">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
  <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
  <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.prettyPhoto.js"></script>
  <script src="js/main.js"></script>
</body>
</html>