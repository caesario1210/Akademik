<?php
// Memanggil file koneksi atau fungsi
require "fungsi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Memindahkan data kiriman dari AJAX ke variabel biasa
    $npp = $_POST['npp'];

    // Validasi data
    if (!empty($npp)) {
        // Membuat query hapus data
        $sql = "DELETE FROM dosen WHERE npp = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("s", $npp);

        if ($stmt->execute()) {
            echo "Data berhasil dihapus.";
        } else {
            echo "Gagal menghapus data.";
        }

        $stmt->close();
    } else {
        echo "ID matkul tidak ditemukan.";
    }
} else {
    echo "Permintaan tidak valid.";
}
?>
