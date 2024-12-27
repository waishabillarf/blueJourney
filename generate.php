<?php
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";

  // Buat Koneksi
  $connection   = mysqli_connect($dbhost,$dbuser,$dbpass);
  if(!$connection){
    die ("Koneksi dengan database gagal: ".mysqli_connect_errno()." - ".mysqli_connect_error());
  }

  // Buat Database
  $query = "CREATE DATABASE IF NOT EXISTS tubes_pemweb";
  $result = mysqli_query($connection, $query);
  if(!$result){
    die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
  }
  else {
    echo "Database <b>'tubes_pemweb'</b> berhasil dibuat... <br>";
  }

  // Pilih Database
  $result = mysqli_select_db($connection, "tubes_pemweb");
  if(!$result){
    die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
  }
  else {
    echo "Database <b>'tubes_pemweb'</b> berhasil dipilih... <br>";
  }

//   // Insert Data Admin
//   $username = "admin";
//   $password = sha1("adminmahasiswa");
//   $query  = "INSERT INTO admin VALUES ('$username','$password')";
//   $query_result = mysqli_query($connection, $query);
//   if(!$query_result){
//       die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
//   }
//   else {
//     echo "Tabel <b>'admin'</b> berhasil diisi... <br>";
//   }

//   mysqli_close($connection);
?>

