<?php
    include 'koneksi.php';
    if (isset($_POST["submit"])) {
    $username = $_POST['username'];
    $new_password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    //  $password_sha1 = sha1($password);
    // $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    $query_sql = "SELECT * FROM register where username='$username'";
    $result = mysqli_query($connection, $query_sql);

    $count = mysqli_num_rows($result);

    if ($count >= 1) {
        $queryD = "UPDATE register set password='$new_password' where username='$username'";
        $result = mysqli_query($connection, $queryD);
        if($queryD){
            header("location: login_page.php");
        }else{
            die('gagal');
        }
    }
}
?>
<!-- ?>
// if (isset($_POST["submit"])) {
//     $name = htmlentities(strip_tags(trim($_POST["name"])));
//     $email = htmlentities(strip_tags(trim($_POST["email"])));
//     $password = htmlentities(strip_tags(trim($_POST["password"])));

//     $error_message = "";

//     if (empty($name)) {
//         $error_message .= "- name belum diisi ";
//     }
//     if (empty($email)) {
//         $error_message .= "- email belum diisi";
//     }
//     if (empty($password)) {
//         $error_message .= "- Password belum diisi <br>";
//     }

//     include("connection.php");

//     $name = mysqli_real_escape_string($connection, $name);
//     $email = mysqli_real_escape_string($connection, $email);
//     $password = mysqli_real_escape_string($connection, $password);

//     //    $password_sha1 = sha1($password);

//     $query = "
//       SELECT * FROM admin 
//       WHERE name = '$name' AND password = '$password' AND email = $email'";
//     $result = mysqli_query($connection, $query);

//     if (mysqli_num_rows($result) == 0) {
//         $error_message .= "- name , email dan/atau Password tidak sesuai";
//     }

//     mysqli_free_result($result);
//     mysqli_close($connection);

//     if ($error_message === "") {
//         session_start();
//         $_SESSION["name"] = $name;
//         header("Location: student_view.php");
//     }
// } else {
//     $error_message = "";
//     $name = "";
//     $email = "";
//     $password = "";
// }
?> -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>forgot password</title>
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
        <h1>Forgot your password?</h1>
        <form action="forgot_password.php" method="post">
            <p>
                <label for="username">Username : </label><br>
                <input class="username" type="text" name="username" id="username" placeholder="enter your username">
            </p>
            <p>
                <label for="password">New Password : </label><br>
                <input class="password" type="password" name="password" id="password" placeholder="enter your password">
            </p>
            <p>
                <label for="password">Confirm your new password : </label><br>
                <input class="password" type="password" name="password" id="password" placeholder="enter your password">
            </p>
            <p class="submit">
                <input class="submit2" type="submit" name="submit" value="Confirm">
            </p>
            </div>
        </form>
    </div>
</body>

</html>