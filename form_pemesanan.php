<?php
include "koneksi.php";
session_start();

if (isset($_POST['add'])) {
    // Get data from the form
    $nama = $_POST['name'];
    $NIK = $_POST['nik'];
    $no_telp = $_POST['telp'];
    $nama_kapal = $_POST['nama'];
    $jenis_kapal = $_POST['jenis'];
    $rute = $_POST['rute'];
    $tanggal_berangkat = date('Y-m-d', strtotime($_POST['tanggal']));
    $jumlah = $_POST['jumlah'];

    $id_register = $_SESSION['id_register'];
    $result_pelanggan = mysqli_query($connection, "INSERT INTO pelanggan (nama, NIK, no_telp, id_register) VALUES ('$nama', $NIK, $no_telp, $id_register)");

    if ($result_pelanggan) {
        $idpelanggan = mysqli_insert_id($connection);
        $id_admin = mysqli_insert_id($connection);

        $sql_jadwal = "SELECT * FROM jadwal WHERE id_jadwal = $nama_kapal";
        $result_jadwal = mysqli_query($connection, $sql_jadwal);

        if ($result_jadwal->num_rows > 0) {
            $rowjadwal = $result_jadwal->fetch_assoc();
            $idjadwal = $rowjadwal['id_jadwal'];

            $sqltrans = "INSERT INTO transaksi (id_pelanggan, id_jadwal, jenis_kapal, qty) VALUES ($idpelanggan, $idjadwal, '$jenis_kapal', $jumlah)";
            $result_trans = mysqli_query($connection, $sqltrans);

            if ($result_trans) {
                $transaksi = mysqli_insert_id($connection);
                header("location:detail_transaksi.php?idtransaksi=$transaksi");
                exit();
            } else {
                echo "Error: " . mysqli_error($connection);
            }
        } else {
            echo "Error: Jadwal data not found";
        }
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form pemesanan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/form_pemesanan.css">
</head>

<body>
    <div>
        <img src="assets/image/Journey.png" alt="">
    </div>
    <div class="form">
        <form action="" method="post">
            <p>
                <label for="name">Name :</label><br>
                <input class="name" type="text" name="name" id="name" placeholder="Enter your Name" value="<?php echo isset($_SESSION['logged_in_user']) ? $_SESSION['logged_in_user'] : ''; ?>" readonly>
            </p>
            <p>
                <label for="nik">NIK :</label><br>
                <input class="nik" type="text" name="nik" id="nik" placeholder="Enter your NIK">
            </p>
            <p>
                <label for="phone">Phone number :</label><br>
                <input class="telp" type="number" name="telp" id="telp" placeholder="Enter your Phone Number">
            </p>
            <p>
                <label for="jenis_kapal">Transportation type :</label>
                <select name="jenis" id="">
                    <option value="VIP">Ship</option>
                    <option value="Ekonomi">Plane</option>
                </select>
            </p>
            <p>
                <label for="nama_kapal">Transportation name :</label>
                <select name="nama" id="pilih" onchange="isiOtomatis()">
                    <?php
                    $query = mysqli_query($connection, "SELECT * FROM jadwal");
                    while ($data = mysqli_fetch_array($query)) {
                        echo "<option value='{$data['id_jadwal']}' data-rute='{$data['rute']}' data-jam='{$data['jam_berangkat']}' data-harga='{$data['harga']}'>{$data['nama_kapal']}</option>";
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="rute">Route :</label>
                <input type="text" name="rute" id="rute">
            </p>
            <p>
                <label for="tanggal_berangkat">Date :</label>
                <input type="date" name="tanggal" id="">
            </p>
            <p>
                <label for="jam_berangkat">Time :</label>
                <input type="text" name="jam" id="jam">
            </p>
            <p>
                <label for="harga">Harga :</label>
                <input type="text" name="harga" id="harga">
            </p>
            <p>
                <label for="jumlah">Quantity :</label>
                <input type="number" name="jumlah">
            </p>
            <div class="mitek">
            <a href="customer_homepage.php"><button>Back to homepage</button></a>
                <button name="add">Pesan tiket</button>
            </div>
        </form>
    </div>

    <script>
        function isiOtomatis() {
            var selectedkapal = document.getElementById("pilih");
            var rute = document.getElementById("rute");
            var jam = document.getElementById("jam");
            var harga = document.getElementById("harga");

            var selectedOption = selectedkapal.options[selectedkapal.selectedIndex];

            rute.value = selectedOption.getAttribute("data-rute");
            jam.value = selectedOption.getAttribute("data-jam");
            harga.value = selectedOption.getAttribute("data-harga");
        }
    </script>

</body>

</html>