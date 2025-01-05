<?php
// Memanggil file koneksi atau fungsi
require "fungsi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Memindahkan data kiriman dari AJAX ke variabel biasa
    $idmatkul = $_POST['idmatkul'];

    // Validasi data
    if (!empty($idmatkul)) {
        // Membuat query hapus data
        $sql = "DELETE FROM matkul WHERE idmatkul = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("s", $idmatkul);

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
