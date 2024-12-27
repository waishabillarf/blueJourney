<?php
include "koneksi.php";
session_start();

if (isset($_POST["adimin"])) {
  $enteredPassword = $_POST["password"];
  $username = htmlentities(strip_tags(trim($_POST["username"])));

  if (empty($username)) {
    header("location: login_page.php");
    exit();
  }

  $username = mysqli_real_escape_string($connection, $username);
  $query_sql =  mysqli_query($connection, "SELECT * FROM admin WHERE username='$username'");
  $result = mysqli_fetch_assoc($query_sql);

  if ($result) {
    $hashedPassword = $result['password'];
    if (password_verify($enteredPassword, $hashedPassword)) {
      header("location: admin_homepage.php");
      exit();
    } else {
      echo "<script>alert('Incorrect password')</script>";
    }
  } else {
    echo "<script>alert('Username not found')</script>";
  }
}


if (isset($_POST["customer"])) {
  $enteredPassword = $_POST["password"];
  $username = htmlentities(strip_tags(trim($_POST["username"])));

  if (empty($username)) {
    header("location: login_page.php");
    exit();
  }

  $username = mysqli_real_escape_string($connection, $username);
  $query_sql =  mysqli_query($connection, "SELECT * FROM register WHERE username='$username'");
  $result = mysqli_fetch_assoc($query_sql);

  if ($result) {
    $hashedPassword = $result['password'];
    if (password_verify($enteredPassword, $hashedPassword)) {
      $_SESSION['logged_in_user'] = $username;
      $_SESSION['id_register'] = $result['id_register'];
      header("location: customer_homepage.php");
      exit();
    } else {
      echo "<script>alert('Incorrect password')</script>";
    }
  } else {
    echo "<script>alert('Username not found')</script>";
  }
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>login page</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/login_page.css">
</head>

<body>
  <div class="logo">
    <img src="assets/image/jurney putih baru.png" alt="logo">
  </div>
  <div class="container">
    <h1>Welcome Back!</h1>
    <form action="login_page.php" method="post">
      <p>
        <label for="username">Username : </label><br>
        <input class="username" type="text" name="username" id="username" placeholder="enter your username">
      </p>
      <p>
        <label for="password">Password : </label><br>
        <input class="password" type="password" name="password" id="password" placeholder="enter your password">
      </p>
      <p class="checkbox1">

        <label class="checkbox" for="checkbox"><input type="checkbox">Remember for 30 days</label>
        <a href="forgot_password.php">forgot password</a>
      </p>
      <div class="submit">
        <input class="submit2" type="submit" name="adimin" value="Admin">
        <input class="submit2" type="submit" name="customer" value="Log In">
      </div>

      <div class="or">
        <div class="huruf">or</div>
        <div class="garis"></div>
      </div>
      <div class="tulisan">
        <p>Don’t have an account? <a href="signin_page.php">Sign Up</a></p>
      </div>
    </form>
  </div>

</body>

</html>