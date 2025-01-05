<!DOCTYPE html>
<html>
<head>
	<title>Sistem Informasi Akademik::Edit Data Mata Kuliah</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-5.1.3-dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/styleku.css">
	<script src="bootstrap-5.1.3-dist/js/jquery-3.3.1.js"></script>
	<script src="bootstrap-5.1.3-dist/js/bootstrap.js"></script>
</head>
<body>
	<?php
	require "fungsi.php";
	require "head.html";
	$idkultawar=$_GET['kode'];
	$sql="select * from kultawar where idkultawar='$idkultawar'";
	$qry=mysqli_query($koneksi,$sql);
	$row=mysqli_fetch_assoc($qry);
	?>
	<div class="utama">
		<h2 class="mb-3 text-center">EDIT DATA KULIAH TAWAR</h2>			
			<form enctype="multipart/form-data" method="post" action="sv_editKulta.php">
				<div class="form-group">
                    <label for="idkultawar">ID Kultawar:</label>				
                    <input class="form-control" type="text" name="idkultawar" id="idkultawar" value="<?php echo $row['idkultawar']?>" readonly>
				</div>
                <div class="form-group">
                    <label for="idmatkul1">Kode Matkul:</label>
                    <select class="form-control-ku" name="idmatkul1" id="idmatkul1">
					<option value=''>--- pilih ---
					<?php
					$arrhobe=array('A11','A12','A14','A15','A16','A17','A22','A24','P31');
					foreach($arrhobe as $hb){
						echo "<option value=$hb>$hb";
					}
					?>
				</select>
				<input class="form-control-ku" type="text" name="idmatkul2" id="idmatkul2">
				</div>
				<div class="form-group">
                <label for="npp2">NPP:</label>
				<input class="form-control-ku col-md-2" type="text" name="npp1" id="npp1" value="0686.11" readonly>
				<select class="form-control-ku col-md-2" name="npp2" id="npp2">
					<?php
					for($th=1990;$th<=2020;$th++){
						echo "<option value=$th>$th";
					}
					?>					
				</select>
				<input type="text" class="form-control-ku col-md-2" name="npp3" id="npp3">
			    </div>
                <div class="form-group" style="margin-top: 10px;">
				<label for="klp">Kelompok</label> 
				<select class="form-control-ku" name="klp1" id="klp1" style="width: 100px;">
				<option value=''>--- pilih ---
					<?php
					$arrhobe=array('A11','A12','A14','A15','A16','A17','A22','A24','P31');
					foreach($arrhobe as $hb){
						echo "<option value=$hb>$hb";
					}
					?>
				</select>
                <input class="form-control-ku col-md-2" type="text" name="klp2" id="klp2" style="width: 100px; ">
			</div>
				<div class="form-group">
					<label for="hari">Hari:</label>
					<select class="form-control" name="hari" id="hari">
					<option value=''>--- pilih ---
					<?php
					$arrhobe=array('Senin','Selasa','Rabu','Kamis','Jumat');
                    foreach($arrhobe as $hb){
                        echo "<option value=$hb>$hb";
                    }
					?>
					</select>
				</div>
				<div class="form-group">
					<label for="jamkul">Jam</label> 
					<select class="form-control" name="jamkul" id="jamkul">
					<option value=''>--- pilih ---
					<?php
					$arrhobe=array('07.00-08.40','07.00-09.00','08.40-10.20','09.00-11.30','10.20-12.00','12.30-14.10');
                    foreach($arrhobe as $hb){
                        echo "<option value=$hb>$hb";
                    }
					?>
					</select>
				</div>
				<div class="form-group">
					<label for="ruang">Ruang</label> 
					<select class="form-control" name="ruang" id="ruang">
					<option value=''>--- pilih ---
					<?php
					for ($i = 1; $i <= 12; $i++) {
                        $ruang = 'H.3.' . $i;
                        echo "<option value='$ruang'>$ruang</option>";
                    }
                    for ($i = 1; $i <= 12; $i++) {
                        $ruang = "H.4.$i";
                        echo "<option value='$ruang'>$ruang</option>";
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