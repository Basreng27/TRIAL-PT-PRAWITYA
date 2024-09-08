<?php include('conn.php');

if (isset($_POST['sell'])) {
    $tgl_faktur = $_POST['tgl_faktur'];
    $no_faktur = $_POST['no_faktur'];
    $nama_konsumen = $_POST['nama_konsumen'];
    $kode_barang = $_POST['kode_barang'];
    $jumlah = $_POST['jumlah'];

    $barang = $conn->query("SELECT harga_jual FROM master_barang WHERE kode_barang='$kode_barang'")->fetch_assoc();
    $harga_satuan = $barang['harga_jual'];
    $harga_total = $harga_satuan * $jumlah;

    $sql = "INSERT INTO penjualan (tgl_faktur, no_faktur, nama_konsumen, kode_barang, jumlah, harga_satuan, harga_total) 
        VALUES ('$tgl_faktur', '$no_faktur', '$nama_konsumen', '$kode_barang', '$jumlah', '$harga_satuan', '$harga_total')";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success" role="alert">Penjualan berhasil!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
    }
}

$barang = $conn->query("SELECT * FROM master_barang");
$result = $conn->query("SELECT b.kode_barang, b.nama_barang, a.nama_konsumen, a.no_faktur, a.tgl_faktur, a.jumlah, a.harga_satuan, a.harga_total FROM penjualan a LEFT JOIN master_barang b ON a.kode_barang = b.kode_barang"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <nav class="nav justify-content-center mb-4">
            <a class="nav-link btn btn-primary mx-2" href="index.php">Dashboard</a>
            <a class="nav-link btn btn-secondary mx-2" href="master_barang.php">Pengolahan Master Barang</a>
            <a class="nav-link btn btn-secondary mx-2" href="penjualan.php">Transaksi Penjualan</a>
        </nav>

        <h2 class="mb-4">Form Penjualan</h2>
        <form method="POST" action="" class="row g-3">
            <div class="col-md-6">
                <label for="tgl_faktur" class="form-label">Tanggal Faktur</label>
                <input type="date" class="form-control" id="tgl_faktur" name="tgl_faktur" required>
            </div>
            <div class="col-md-6">
                <label for="no_faktur" class="form-label">No Faktur</label>
                <input type="text" class="form-control" id="no_faktur" name="no_faktur" required>
            </div>
            <div class="col-md-6">
                <label for="nama_konsumen" class="form-label">Nama Konsumen</label>
                <input type="text" class="form-control" id="nama_konsumen" name="nama_konsumen" required>
            </div>
            <div class="col-md-6">
                <label for="kode_barang" class="form-label">Kode Barang</label>

                <select class="form-control" id="kode_barang" name="kode_barang" required>
                    <?php foreach ($barang as $key => $value) { ?>
                        <option value="<?= $value['kode_barang']; ?>"><?= $value['kode_barang']; ?> - <?= $value['nama_barang']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" required min="1">
            </div>
            <div class="col-12">
                <button type="submit" name="sell" class="btn btn-primary">Proses Penjualan</button>
                <a href="master_barang.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>

        <h3 class="mt-5">Daftar Penjualan</h3>
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Nama Konsumen</th>
                    <th>No Faktur</th>
                    <th>Tanggal Faktur</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Harga Total</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($result as $key => $row) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['kode_barang']); ?></td>
                        <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                        <td><?= htmlspecialchars($row['nama_konsumen']); ?></td>
                        <td><?= htmlspecialchars($row['no_faktur']); ?></td>
                        <td><?= htmlspecialchars($row['tgl_faktur']); ?></td>
                        <td><?= htmlspecialchars($row['jumlah']); ?></td>
                        <td><?= htmlspecialchars($row['harga_satuan']); ?></td>
                        <td><?= htmlspecialchars($row['harga_total']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>