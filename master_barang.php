<?php include('conn.php');

if (isset($_POST['add'])) {
    $kode = $_POST['kode_barang'];
    $nama = $_POST['nama_barang'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $satuan = $_POST['satuan'];
    $kategori = $_POST['kategori'];

    $stmt = $conn->prepare("INSERT INTO master_barang (kode_barang, nama_barang, harga_jual, harga_beli, satuan, kategori) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssddss", $kode, $nama, $harga_jual, $harga_beli, $satuan, $kategori);

    if ($stmt->execute()) {
        echo '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error: ' . $stmt->error . '</div>';
    }
}

if (isset($_GET['delete'])) {
    $kode_barang = $_GET['kode_barang'];
    $stmt = $conn->prepare("DELETE FROM master_barang WHERE kode_barang=?");
    $stmt->bind_param("s", $kode_barang);

    if ($stmt->execute()) {
        echo '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error: ' . $stmt->error . '</div>';
    }
}

$result = $conn->query("SELECT * FROM master_barang"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <nav class="nav justify-content-center mb-4">
            <a class="nav-link btn btn-primary mx-2" href="index.php">Dashboard</a>
            <a class="nav-link btn btn-secondary mx-2" href="master_barang.php">Pengolahan Master Barang</a>
            <a class="nav-link btn btn-secondary mx-2" href="penjualan.php">Transaksi Penjualan</a>
        </nav>

        <h2>Master Barang</h2>
        <form method="POST" action="" class="row g-3">
            <div class="col-md-6">
                <label for="kode_barang" class="form-label">Kode Barang</label>
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" required>
            </div>
            <div class="col-md-6">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
            </div>
            <div class="col-md-6">
                <label for="harga_jual" class="form-label">Harga Jual</label>
                <input type="number" class="form-control" id="harga_jual" name="harga_jual" required min="0" step="0.01">
            </div>
            <div class="col-md-6">
                <label for="harga_beli" class="form-label">Harga Beli</label>
                <input type="number" class="form-control" id="harga_beli" name="harga_beli" required min="0" step="0.01">
            </div>
            <div class="col-md-6">
                <label for="satuan" class="form-label">Satuan</label>
                <input type="text" class="form-control" id="satuan" name="satuan" required>
            </div>
            <div class="col-md-6">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori" required>
            </div>
            <div class="col-12">
                <button type="submit" name="add" class="btn btn-success">Tambah Barang</button>
            </div>
        </form>

        <h3 class="mt-5">Daftar Barang</h3>
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Jual</th>
                    <th>Harga Beli</th>
                    <th>Satuan</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($result as $key => $row) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['kode_barang']); ?></td>
                        <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                        <td><?= htmlspecialchars($row['harga_jual']); ?></td>
                        <td><?= htmlspecialchars($row['harga_beli']); ?></td>
                        <td><?= htmlspecialchars($row['satuan']); ?></td>
                        <td><?= htmlspecialchars($row['kategori']); ?></td>
                        <td>
                            <a href="edit_barang.php?kode_barang=<?= $row['kode_barang']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="?delete=true&kode_barang=<?= $row['kode_barang']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>