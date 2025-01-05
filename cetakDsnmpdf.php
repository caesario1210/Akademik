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
	<th>NPP</th>
	<th>Nama</th>
	<th>Homebase</th>
	</tr>
	<?php 
	// koneksi  database
	$koneksi = mysqli_connect("localhost","root","","pwlgenap2019-akademik");

	// menampilkan data pegawai
	$data = mysqli_query($koneksi,"select * from dosen");
    $no=0;
    while ($row = mysqli_fetch_assoc($data)) {
    $no++;
?>	
    <tr>
        <td><?php echo $no?></td>
        <td><?php echo $row["npp"]?></td>
        <td><?php echo $row["namadosen"]?></td>
        <td><?php echo $row["homebase"]?></td>
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