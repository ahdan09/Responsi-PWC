<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Data Warga RT</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Daftar Warga RT</h2>

        <div class="header">
            <a href="tambah.php" class="btn btn-blue">+ Tambah Warga</a>
            <form action="index.php" method="get" class="search-form">
                <input type="text" name="cari" placeholder="Cari nama">
                <button type="submit">Cari</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Iuran (Rp)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM warga";
                if (isset($_GET['cari']) && $_GET['cari'] != '') {
                    $cari = mysqli_real_escape_string($koneksi, $_GET['cari']);
                    $query .= " WHERE nama_lengkap LIKE '%$cari%'";
                }

                $result = mysqli_query($koneksi, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['nama_lengkap']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nik']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        echo "<td>" . number_format($row['iuran'], 0, ',', '.') . "</td>";
                        echo "<td class='action-links'>";
                        echo "<a href='edit.php?id=" . $row['id'] . "' class='edit-link'>Edit</a> | ";
                        echo "<a href='hapus.php?id=" . $row['id'] . "' class='hapus-link' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?');\">Hapus</a>"; 
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center;'>Tidak ada data warga.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>