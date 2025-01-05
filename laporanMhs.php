<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header img {
            width: 80px;
            height: auto;
        }
        .title {
            text-align: center;
            margin-top: -60px;
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
    <img src="foto/logo_UDINUS.png" alt="Logo Udinus">
        <div class="title">
            <h1>Laporan Data Mahasiswa<br>Universitas Dian Nuswantoro</h1>
        </div>
        <img src="foto/UDINUS_unggul.png" alt="Logo Kanan">
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Email</th>
        </tr>
        {{table_data}}
    </table>
</body>
</html>
