<!DOCTYPE html>
<html>
<head>
	 <title>Laporan</title>
</head>
<body>
			<style type="text/css">
						body{
						font-family: sans-serif;
						}
						table{
						margin: 20px auto;
						border-collapse: collapse;
						}
						table th,
						table td{
						border: 1px solid #3c3c3c;
						padding: 3px 8px;

						}
						a{
						background: blue;
						color: #fff;
						padding: 8px 10px;
						text-decoration: none;
						border-radius: 2px;
						}

							.tengah{
								text-align: center;
							}
			</style>
	<table>
	<tr>
	<th>No</th>
	<th>ID kultawar</th>
	<th>Kode</th>
	<th>NPP</th>
    <th>Kelompok</th>
    <th>Hari</th>
    <th>Jam</th>
    <th>Ruang</th>
	</tr>
	<?php 
	// koneksi  database
	$koneksi = mysqli_connect("localhost","root","","pwlgenap2019-akademik");

	// menampilkan data pegawai
	$data = mysqli_query($koneksi,"select * from kultawar");
    $no=0;
    while ($row = mysqli_fetch_assoc($data)) {
    $no++;
?>	
    <tr>
    <td><?php echo $no?></td>
    <td><?php echo $row["idkultawar"]?></td>
    <td><?php echo $row["idmatkul"]?></td>
    <td><?php echo $row["npp"]?></td>
    <td><?php echo $row["klp"]?></td>
    <td><?php echo $row["hari"]?></td>
    <td><?php echo $row["jamkul"]?></td>
    <td><?php echo $row["ruang"]?></td>
    </tr>
<?php	
}
?>

		</table>
		<script>
	window.print();
	</script>
</body>
</html>