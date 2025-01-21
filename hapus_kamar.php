<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "db_hotel");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah parameter 'id' ada
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Pastikan parameter id berupa angka

    // Query untuk menghapus data kamar berdasarkan ID
    $sql = "DELETE FROM rooms WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Jika penghapusan berhasil, redirect ke halaman daftar_kamar
        header("Location: daftar_kamar.php?message=Kamar berhasil dihapus");
    } else {
        // Jika terjadi kesalahan, tampilkan pesan
        echo "Terjadi kesalahan: " . $conn->error;
    }

    $stmt->close();
} else {
    // Jika parameter id tidak ditemukan, redirect ke halaman daftar_kamar dengan pesan error
    header("Location: daftar_kamar.php?message=ID kamar tidak valid");
}

$conn->close();
?>
