<?php
// Memanggil file koneksi atau fungsi
require "fungsi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Memindahkan data kiriman dari AJAX ke variabel biasa
    $klp = $_POST['klp'];

    // Validasi data
    if (!empty($klp)) {
        // Membuat query hapus data
        $sql = "DELETE FROM kultawar WHERE klp = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("s", $klp);

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
