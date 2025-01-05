<?php
    include "fungsi.php"; // masukan koneksi DB

    // ambil variable
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $email = $_POST["email"];

    // Periksa 


    // default sukses unggah foto 
    $uploadOk = 1;
    $folderupload = "foto/";
    $fileupload = $folderupload . basename($_FILES['foto']['name']);
    $filefoto = basename($_FILES['foto']['name']);
    $jenisfilefoto = strtolower(pathinfo($fileupload, PATHINFO_EXTENSION));

    // Check apakah NIM sudah ada di database
    // Check apakah NIM sudah ada di database
    $cekNimQuery = "SELECT * FROM mhs WHERE nim='$nim'";
    $result = mysqli_query($koneksi, $cekNimQuery);

    if ($result->num_rows > 0) {
        echo "<script>
                alert('NIM sudah terdaftar, silahkan gunakan NIM lain.');
                window.history.back();
            </script>";
        exit();
    }



    // Check jika file foto sudah ada
    if (file_exists($fileupload)) {
        echo "Maaf, file foto sudah ada<br>";
        $uploadOk = 0;
    }

    // Check ukuran file
    if ($_FILES["foto"]["size"] > 1000000) {
        echo "Maaf, ukuran file foto harus kurang dari 1 MB<br>";
        $uploadOk = 0;
    }

    // Seleksi extension file
    if ($jenisfilefoto != "jpg" && $jenisfilefoto != "png" && $jenisfilefoto != "jpeg" && $jenisfilefoto != "gif") {
        echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan<br>";
        $uploadOk = 0;
    }

    // Check jika terjadi kesalahan
    if ($uploadOk == 0) {
        echo "Maaf, file tidak dapat terupload<br>";
    } else {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $fileupload)) {
            $sql = "INSERT INTO mhs VALUES('', '$nim', '$nama', '$email', '$filefoto')";
            mysqli_query($koneksi, $sql);
            require "addMhs.php";
        } else {
            echo "Data gagal tersimpan";
        }
    }
?>
