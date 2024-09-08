<?php include('conn.php');

if (isset($_GET['kode_barang'])) {
    $kode_barang = $_GET['kode_barang'];

    $stmt = $conn->prepare("SELECT * FROM master_barang WHERE kode_barang = ?");
    $stmt->bind_param("s", $kode_barang);
    $stmt->execute();
    $result = $stmt->get_result();
    $barang = $result->fetch_assoc();

    if (!$barang) {
        echo '<div class="alert alert-danger">Data barang tidak ditemukan!</div>';
        exit;
    }
}

if (isset($_POST['update'])) {
    $kode = $_POST['kode_barang'];
    $nama = $_POST['nama_barang'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $satuan = $_POST['satuan'];
    $kategori = $_POST['kategori'];

    $stmt = $conn->prepare("UPDATE master_barang SET nama_barang = ?, harga_jual = ?, harga_beli = ?, satuan = ?, kategori = ? WHERE kode_barang = ?");
    $stmt->bind_param("sddsss", $nama, $harga_jual, $harga_beli, $satuan, $kategori, $kode);

    if ($stmt->execute()) {
        echo '<div class="alert alert-success" role="alert">Data berhasil diperbarui!</div>';
        header("Location: master_barang.php");
        exit;
    } else {
        echo '<div class="alert alert-danger" role="alert">Error: ' . $stmt->error . '</div>';
    }
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <nav class="nav justify-content-center mb-4">
            <a class="nav-link btn btn-primary mx-2" href="index.php">Dashboard</a>
            <a class="nav-link btn btn-secondary mx-2" href="master_barang.php">Pengolahan Master Barang</a>
            <a class="nav-link btn btn-secondary mx-2" href="penjualan.php">Transaksi Penjualan</a>
        </nav>

        <h2>Edit Barang</h2>
        <form method="POST" action="" class="row g-3">
            <div class="col-md-6">
                <label for="kode_barang" class="form-label">Kode Barang</label>
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= htmlspecialchars($barang['kode_barang']); ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= htmlspecialchars($barang['nama_barang']); ?>" required>
            </div>
            <div class="col-md-6">
                <label for="harga_jual" class="form-label">Harga Jual</label>
                <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="<?= htmlspecialchars($barang['harga_jual']); ?>" required min="0" step="0.01">
            </div>
            <div class="col-md-6">
                <label for="harga_beli" class="form-label">Harga Beli</label>
                <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="<?= htmlspecialchars($barang['harga_beli']); ?>" required min="0" step="0.01">
            </div>
            <div class="col-md-6">
                <label for="satuan" class="form-label">Satuan</label>
                <input type="text" class="form-control" id="satuan" name="satuan" value="<?= htmlspecialchars($barang['satuan']); ?>" required>
            </div>
            <div class="col-md-6">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori" value="<?= htmlspecialchars($barang['kategori']); ?>" required>
            </div>
            <div class="col-12">
                <button type="submit" name="update" class="btn btn-primary">Update Barang</button>
                <a href="master_barang.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>