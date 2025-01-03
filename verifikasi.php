<?php
include 'koneksi.php'; //role Admin
$sql = "
        SELECT transaksi.id_transaksi, pelanggan.nama as nama_pelanggan, pelanggan.NIK, pelanggan.no_telp, 
            jadwal.nama_kapal, jadwal.rute, jadwal.jam_berangkat, transaksi.jenis_kapal, transaksi.qty, transaksi.isVerified, jadwal.harga
        FROM transaksi
        JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan
        JOIN jadwal ON transaksi.id_jadwal = jadwal.id_jadwal
    ";
$result = $connection->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["transactionId"])) {
    $transactionId = $_POST["transactionId"];

    $updateSql = "UPDATE transaksi SET isVerified = true WHERE id_transaksi = $transactionId";

    if ($connection->query($updateSql) === TRUE) {
        echo "Record updated successfully";
        header("location:verifikasi.php");
    } else {
        echo "Error updating record: " . $connection->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteTransaction"])) {
    $transactionId = $_POST["transactionId"];

    // Perform the delete query
    $deleteSql = "DELETE FROM transaksi WHERE id_transaksi = $transactionId";

    if ($connection->query($deleteSql) === TRUE) {
        header("location:verifikasi.php");
    } else {
        echo "Error deleting record: " . $connection->error;
    }
}

$connection->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verifikasi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/verifikasi.css">
</head>

<body>
    <div>
        <img src="assets/image/Journey.png" alt="">
    </div>
    <div class="verified">
        <table>
            <tr>
                <th>#</th>
                <th>Transaction ID</th>
                <th>Username</th>
                <th>Jumlah Tiket</th>
                <th>Ship Type</th>
                <th>Total Bayar</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                $number = 1;
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $number; ?></td>
                        <td><?php echo $row['id_transaksi'] ?></td>
                        <td><?php echo $row['nama_pelanggan'] ?></td>
                        <td><?php echo $row['qty'] ?></td>
                        <td><?php echo $row['jenis_kapal'] ?></td>
                        <td><?php echo "Rp " . number_format($row['harga'] * $row['qty'], 0, ',', '.'); ?></td>
                        <td><?php echo ($row['isVerified'] == 1) ? 'Verified' : 'No Verfified'; ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="transactionId" value="<?php echo $row['id_transaksi']; ?>">
                                <button type="submit">Verified</button>
                            </form>
                            <form method="post">
                                <input type="hidden" name="transactionId" value="<?php echo $row['id_transaksi']; ?>">
                                <button type="submit" name="deleteTransaction">Delete</button>
                            </form>
                        </td>
                    </tr>
            <?php
                    $number++;
                }
            }
            ?>
        </table>
    </div>
    <div class="balik">
        <a href="admin_homepage.php"><button>Back to homepage</button></a>
        
    </div>
</body>

</html>