<?php
$host = "localhost";
$user = "root";
$password = "RawamA327";
$database = "sparepart_sales";

// Koneksi ke database
$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
