<!DOCTYPE html>
<html>
<head>
	<title>Sistem Informasi Akademik::Edit Data Mata Kuliah</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styleku.css">
	<script src="bootstrap-5.1.3-dist/jquery/3.3.1/jquery-3.3.1.js"></script>
	<script src="bootstrap-5.1.3-dist/js/bootstrap.js"></script>
</head>
<body>
	<?php
	require "fungsi.php";
	require "head.html";
	$idmatkul=$_GET['kode'];
	$sql="select * from matkul where idmatkul='$idmatkul'";
	$qry=mysqli_query($koneksi,$sql);
	$row=mysqli_fetch_assoc($qry);
	?>
	<div class="utama">
		<h2 class="mb-3 text-center">EDIT DATA MATA KULIAH</h2>			
			<form enctype="multipart/form-data" method="post" action="sv_editMatkul.php">
				<div class="form-group">
				<label for="idmatkul">Kode:</label>				
				<input class="form-control" type="text" name="idmatkul" id="idmatkul" value="<?php echo $row['idmatkul']?>" readonly>
				</div>
				<div class="form-group">
					<label for="nama">Nama mata kuliah:</label>
					<input class="form-control" type="text" name="nama" id="nama" value="<?php echo $row['namamatkul']?>">
				</div>
				<div class="form-group">
					<label for="sks">SKS:</label>
					<select class="form-control" name="sks" id="sks">
					<option value=''>--- pilih ---
					<?php
					for($i=1;$i<=6;$i++){
						if ($i==$row['sks']){
							echo "<option value=$i selected>$i";
						}else{
							echo "<option value=$i>$i";
						}	
					}
					?>
					</select>
				</div>
				<div class="form-group">
					<label for="jns">Jenis</label> 
					<select class="form-control" name="jns" id="jns">
					<option value=''>--- pilih ---
					<?php
					$arrjns=array('T','P','T/P');
					foreach($arrjns as $jns){
						if ($jns==$row['jns']){
							echo "<option value=$jns selected>$jns";
						}else{
							echo "<option value=$jns>$jns";
						}
					}
					?>
					</select>
				</div>
				<div class="form-group">
					<label for="smt">Semester</label> 
					<select class="form-control" name="smt" id="smt">
					<option value=''>--- pilih ---
					<?php
					for($i=1;$i<=8;$i++){
						if ($i==$row['smt']){
							echo "<option value=$i selected>$i";
						}else{
							echo "<option value=$i>$i";
						}
					}
					?>
					</select>
				</div>				
				<div>		
					<button class="btn btn-primary" type="submit">Simpan</button>
				</div>
			</form>
	</div>
</body>
</html>