<!DOCTYPE html>
<html>
<head>
    <title>Sistem Informasi Akademik::Tambah Data Mahasiswa</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styleku.css">
    <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <script src="bootstrap-5.1.3-dist/js/bootstrap.js"></script>
    <script src="bootstrap-5.1.3-dist/jquery/jquery-3.3.1.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

</head>
<style> /* In your css/styleku.css file */
#nim {
    width: 140px;  /* Adjust the width to match 14 characters length */
}
</style>

<body>
    <?php
        require "head.html";
    ?>
    <div class="utama">
        <br><br><br>
        <h3>TAMBAH DATA MAHASISWA</h3>

        <form method="post" action="sv_addMhs.php" enctype="multipart/form-data" onsubmit="validateNim(event)">

        <div class="form-group">
    <label for="nim">NIM:</label>
    <input class="form-control" type="text" name="nim" id="nim" required maxlength="15" size="14" oninput="checkNimLength()" onblur="checkDuplicateNim()">
</div>


            <div class="form-group">
                <label for="nama">Nama:</label>
                <input class="form-control" type="text" name="nama" id="nama">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input class="form-control" type="email" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <input class="form-control" type="file" name="foto" id="foto">
            </div>
            <div>
                <button type="submit" class="btn btn-primary" value="Simpan">Simpan</button>
            </div>
        </form>
    </div>

    <script>
    function validateNim(event) {
    event.preventDefault(); // Mencegah submit form default

    const nimInput = document.getElementById('nim');
    const form = document.querySelector('form');

    // Pengecekan panjang NIM
    if (nimInput.value.length < 14 || nimInput.value.length > 14) {
        alert("Isian NIM tidak sesuai, silahkan isi kembali");
        nimInput.focus();
        return false;
    }

    // Pengecekan duplikat NIM menggunakan AJAX
    $.ajax({
        url: 'cekNim.php',
        type: 'POST',
        data: { nim: nimInput.value },
        success: function(response) {
            if (response.trim() === 'exists') {
                alert("NIM sudah terdaftar, silahkan gunakan NIM lain.");
                nimInput.value = ''; // Kosongkan input NIM
                nimInput.focus(); // Fokuskan kembali ke input NIM
            } else {
                // Jika NIM tidak terdaftar, submit form
                alert("Data berhasil disimpan!");
                form.submit();
            }
        },
        error: function() {
            alert("Terjadi kesalahan saat memeriksa NIM. Silakan coba lagi.");
        }
    });

    return false; // Mencegah submit form sampai AJAX selesai
}

    </script>
</body>
</html>
