<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_hotel";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data
    $sql = "DELETE FROM reservasi WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    // Redirect kembali ke halaman riwayat transaksi
    header("Location:riwayat.php");
    exit();
} else {
    echo "ID tidak ditemukan.";
}
?>
