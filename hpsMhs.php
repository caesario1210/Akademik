<?php
// Memanggil file koneksi atau fungsi
require "fungsi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Memindahkan data kiriman dari AJAX ke variabel biasa
    $id = $_POST['id'];

    // Validasi data
    if (!empty($id)) {
        // Membuat query hapus data
        $sql = "DELETE FROM mhs WHERE id = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("s", $id);

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
