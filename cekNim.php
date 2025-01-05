<?php
include 'fungsi.php';

if (isset($_POST['nim'])) {
    $nim = $_POST['nim'];
    $query = "SELECT * FROM mhs WHERE nim = '$nim'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        echo 'exists';
    } else {
        echo 'available';
    }
}
?>
