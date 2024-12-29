<?php
if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $username = $_POST["username"];
    $nik = $_POST["nik"];
    $alamat = $_POST["alamat"];
    $telp = $_POST["telp"];
    $birth_date = $_POST["birth_date"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);


    include("koneksi.php");
    $sql = mysqli_query($connection, "insert into register (username, email, no_telp, password) values ('$username', '$email', '$telp', '$password')");
    if ($sql) {
        header("location:login_page.php");
    }
}


?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>sign in page</title>
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
        <h1>Get Started Now</h1>
        <!-- <?php
                if ($error_message !== "")
                    echo "<div class='error'>$error_message</div>";
                ?> -->
        <form action="signin_page.php" method="POST">
            <p>
                <label for="username">Username : </label><br>
                <input class="username" type="text" name="username" id="username" placeholder="enter your Username">
            </p>
            <p>
                <label for="email">Email : </label><br>
                <input class="email" type="email" name="email" id="email" placeholder="enter your email">
            </p>
            <p>
                <label for="phone">Phone number : </label><br>
                <input class="telp" type="number" name="telp" id="telp" placeholder="enter your Phone Number">
            </p>
            <p>
                <label for="password">Password : </label><br>
                <input class="password" type="password" name="password" id="password" placeholder="enter your password">
            </p>
            <p class="submit">
                <input class="submit2" type="submit" name="submit" value="Sign Up">
            </p>

        </form>
    </div>
</body>

</html>