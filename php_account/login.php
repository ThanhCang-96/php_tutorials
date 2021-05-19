<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <title>Login</title>
</head>
<body>
  <?php 
    $conn = mysqli_connect('localhost', 'root', '', 'online_shop') 
    or die ('Can\'t connect to database');
    $sql = 'SELECT * FROM account';
    $result = mysqli_query($conn, $sql);
     
    // while ($row = mysqli_fetch_assoc($result)){
    //     var_dump($row);
    //     echo($row['acc_email']);
    // }

    if (isset($_POST["login"])) {
      $flash = true;
      if (isset($_POST['email'])) {
        $email = $_POST['email'];
      } else $flash = false;

      if (isset($_POST['pass'])) {
        $pass = $_POST['pass'];
      } else $flash = false;

      if ($flash) {
        $success = true;
        while ($row = mysqli_fetch_assoc($result)){
          if ($email == $row['acc_email'] && $pass == $row["acc_password"]) {
            echo '<script language="javascript">';
            echo 'alert("successfully")';  //not showing an alert box.
            echo '</script>';
            exit;
            // echo "successfully";
          } else {
            $success = false;
            echo '<script language="javascript">';
            echo 'alert("Fail")';  //not showing an alert box.
            echo '</script>';
            exit;
            // echo "Fail";
          }
        }
      } else echo "xxxxxxxxxx";

      if ($success) {
        $_SESSION['account'] = $email;
      }
    }
  ?>

  <form action="index.php" method="post">
    email: <input type="text" name="email">
    password: <input type="password" name="pass">
    <button type="submit" name="login">Login</button>
  </form>
</body>
</html>