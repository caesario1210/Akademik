<?php
require_once __DIR__ . '/vendor/autoload.php'; // Include mPDF library

// Database connection
$koneksi = mysqli_connect("localhost", "root", "", "pegawai06910");

// Fetch data from the database
$data = mysqli_query($koneksi, "SELECT * FROM mhs");
$no = 0;

// Create an mPDF instance
$mpdf = new \Mpdf\Mpdf();

// HTML content for the PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Mahasiswa</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            position: relative; /* Menjadi referensi posisi elemen anak */
            height: 100px; /* Tinggi header */
        }
        .logo-left {
            position: absolute;
            top: 0;
            left: 0; /* Gambar di pojok kiri */
            width: 80px;
        }
        .logo-right {
            position: absolute;
            top: 0;
            right: 0; /* Gambar di pojok kanan */
            width: 80px;
        }
        .title {
            position: absolute;
            top: 50%; /* Posisi vertikal di tengah */
            left: 50%; /* Posisi horizontal di tengah */
            transform: translate(-50%, -50%); /* Pusatkan elemen */
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="header">
    <img src="foto/1024px-Logo_udinus1.jpg" alt="Logo Kiri" class="logo-left">
    <div class="title">
        Laporan Data Mahasiswa<br>Universitas Dian Nuswantoro
    </div>
    <img src="foto/1024px-Logo_udinus1.jpg" alt="Logo Kanan" class="logo-right">
</div>

<table>
    <tr>
        <th>No</th>
        <th>N I M</th>
        <th>Nama</th>
        <th>Email</th>
    </tr>';

while ($row = mysqli_fetch_assoc($data)) {
    $no++;
    $html .= '
    <tr>
        <td>' . $no . '</td>
        <td>' . $row["nim"] . '</td>
        <td>' . $row["nama"] . '</td>
        <td>' . $row["email"] . '</td>
    </tr>';
}

$html .= '</table>
</body>
</html>';

// Write HTML to PDF
$mpdf->WriteHTML($html);

// Output the PDF to browser
$mpdf->Output();
?>
