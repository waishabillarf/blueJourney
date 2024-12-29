<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['logged_in_user'])) {
    header("Location: login_page.php");
    exit();
}

$id_register = $_SESSION['id_register'];

$sql = mysqli_query($connection, "SELECT transaksi.id_transaksi, pelanggan.nama, pelanggan.NIK, pelanggan.no_telp, jadwal.nama_kapal, jadwal.rute, jadwal.jam_berangkat, transaksi.qty, jadwal.harga, transaksi.isVerified
                                    FROM transaksi 
                                    JOIN jadwal ON transaksi.id_jadwal = jadwal.id_jadwal 
                                    JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan 
                                    WHERE pelanggan.id_register = '$id_register'
                                    ORDER BY transaksi.id_transaksi DESC"); // Adjust the ORDER BY clause as needed

if (!$sql) {
    die("Query failed: " . mysqli_error($connection));
}

$transactionHistory = mysqli_fetch_all($sql, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link rel="stylesheet" href="assets/transaksi.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    <div>
        <img src="assets/image/Journey.png" alt="logo">
    </div>
    <div class="transaksi">
        <table>
            <tr>
                <th>ID Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>NIK</th>
                <th>No. Telepon</th>
                <th>Nama Transportasi</th>
                <th>Rute</th>
                <th>Waktu Berangkat</th>
                <th>Jumlah Tiket</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
            <?php
            if ($transactionHistory) {
                foreach ($transactionHistory as $transaction) {
                    echo "<tr>";
                    echo "<td>{$transaction['id_transaksi']}</td>";
                    echo "<td>{$transaction['nama']}</td>";
                    echo "<td>{$transaction['NIK']}</td>";
                    echo "<td>{$transaction['no_telp']}</td>";
                    echo "<td>{$transaction['nama_kapal']}</td>";
                    echo "<td>{$transaction['rute']}</td>";
                    echo "<td>{$transaction['jam_berangkat']}</td>";
                    echo "<td>{$transaction['qty']}</td>";
                    echo "<td>{$transaction['harga']}</td>";
                    echo "<td>" . ($transaction['isVerified'] == 1 ? 'Verified' : 'Not Verified') . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No transaction history found.</td></tr>";
            }
            ?>
        </table>
    </div>
    <div class="balik">
        <a href="customer_homepage.php"><button>Back to homepage</button></a>
    </div>
</body>

</html>