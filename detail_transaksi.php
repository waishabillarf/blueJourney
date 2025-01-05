<?php
include 'koneksi.php';
session_start();

if (isset($_GET['idtransaksi'])) {
    $idtransaksi = $_GET['idtransaksi'];

    $sql = mysqli_query($connection, "SELECT pelanggan.nama, pelanggan.NIK, pelanggan.no_telp, jadwal.nama_kapal, jadwal.rute, jadwal.jam_berangkat, qty, harga, id_transaksi
                                        FROM transaksi 
                                        JOIN jadwal ON transaksi.id_jadwal = jadwal.id_jadwal 
                                        JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan 
                                        WHERE transaksi.id_transaksi = $idtransaksi");

    $transactionDetails = mysqli_fetch_assoc($sql);
} else {
    echo "Error: Transaction not found";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>transaction page</title>
    <link rel="stylesheet" href="assets/transaksi.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    <img src="assets/image/Journey.png" alt="logo">
    <div class="transaksi">
        <form action="" method="post">
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
                    <!-- Add more columns as needed -->
                </tr>
                <?php
                // Check if transaction details are available
                if ($transactionDetails) {
                    echo "<tr>";
                    echo "<td>{$transactionDetails['id_transaksi']}</td>";
                    echo "<td>{$transactionDetails['nama']}</td>";
                    echo "<td>{$transactionDetails['NIK']}</td>";
                    echo "<td>{$transactionDetails['no_telp']}</td>";
                    echo "<td>{$transactionDetails['nama_kapal']}</td>";
                    echo "<td>{$transactionDetails['rute']}</td>";
                    echo "<td>{$transactionDetails['jam_berangkat']}</td>";
                    echo "<td>{$transactionDetails['qty']}</td>";
                    echo "<td>{$transactionDetails['harga']}</td>";
                    // Add more columns as needed
                    echo "</tr>";
                } else {
                    // Handle the case when transaction details are not available
                    echo "<tr><td colspan='6'>Transaction details not found.</td></tr>";
                }
                ?>
            </table>
        </form>
        <br>
    </div>
    <div class="balik">
        <a href="customer_homepage.php"><button>Back to homepage</button></a>
    </div>
</body>

</html>