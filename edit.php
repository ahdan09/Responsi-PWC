<?php
include 'koneksi.php';

$id = $_GET['id'];

$query_get = "SELECT * FROM warga WHERE id=$id";
$result_get = mysqli_query($koneksi, $query_get);
$warga = mysqli_fetch_assoc($result_get);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = $_POST['nama_lengkap'];
    $nomor_kk = $_POST['nomor_kk'];
    $nik = $_POST['nik'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];
    $iuran = $_POST['iuran'];

    $query_update = "UPDATE warga SET 
        nama_lengkap='$nama_lengkap', 
        nomor_kk='$nomor_kk', 
        nik='$nik', 
        alamat='$alamat', 
        status='$status',
        iuran='$iuran'
        WHERE id=$id";

    if (mysqli_query($koneksi, $query_update)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $query_update . "<br>" . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Warga</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <h2>Edit Data Warga</h2>
        <form action="edit.php?id=<?php echo $id; ?>" method="post">
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" value="<?php echo htmlspecialchars($warga['nama_lengkap']); ?>" required>
            </div>
            <div class="form-group">
                <label for="nomor_kk">Nomor KK</label>
                <input type="text" id="nomor_kk" name="nomor_kk" class="form-control" value="<?php echo htmlspecialchars($warga['nomor_kk']); ?>" required>
            </div>
            <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" id="nik" name="nik" class="form-control" value="<?php echo htmlspecialchars($warga['nik']); ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" class="form-control" rows="3" required><?php echo htmlspecialchars($warga['alamat']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="Kepala Keluarga" <?php if($warga['status'] == 'Kepala Keluarga') echo 'selected'; ?>>Kepala Keluarga</option>
                    <option value="Anggota Keluarga" <?php if($warga['status'] == 'Anggota Keluarga') echo 'selected'; ?>>Anggota Keluarga</option>
                </select>
            </div>
            <div class="form-group">
                <label for="iuran">Iuran (Rp)</label>
                <input type="number" id="iuran" name="iuran" class="form-control" value="<?php echo htmlspecialchars($warga['iuran']); ?>" required>
            </div>
            <button type="submit" class="btn btn-green btn-submit">Simpan Perubahan</button> <div class="form-links">
                <a href="index.php">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>