<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = $_POST['nama_lengkap'];
    $nomor_kk = $_POST['nomor_kk'];
    $nik = $_POST['nik'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];
    $iuran = $_POST['iuran'];

    $query = "INSERT INTO warga (nama_lengkap, nomor_kk, nik, alamat, status, iuran) VALUES ('$nama_lengkap', '$nomor_kk', '$nik', '$alamat', '$status', '$iuran')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php"); 
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Warga</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <h2>Tambah Data Warga</h2>
        <form action="tambah.php" method="post">
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label> <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nomor_kk">Nomor KK</label> <input type="text" id="nomor_kk" name="nomor_kk" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nik">NIK</label> <input type="text" id="nik" name="nik" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label> <textarea id="alamat" name="alamat" class="form-control" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="status">Status</label> <select id="status" name="status" class="form-control" required>
                    <option value="Kepala Keluarga">Kepala Keluarga</option>
                    <option value="Anggota Keluarga">Anggota Keluarga</option>
                </select>
            </div>
            <div class="form-group">
                <label for="iuran">Iuran</label> <input type="text" id="iuran" name="iuran" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-blue btn-submit">Simpan</button>
            <div class="form-links">
                <a href="index.php">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>