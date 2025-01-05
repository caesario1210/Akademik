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
<body>
	<?php
	require "head.html";
	?>
	<div class="utama">		
		<br><br><br>
		<h3>TAMBAH DATA MATA KULIAH</h3>
		<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	  		<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
		</div>	
		<form id="faddMatkul">
			<div class="form-group">
				<label for="idmatkul1">Kode:</label>
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
				<label for="nama">Nama mata kuliah:</label>
				<input class="form-control" type="text" name="nama" id="nama">
			</div>
			<div class="form-group">
				<label for="sks">SKS:</label>
				<select class="form-control" name="sks" id="sks">
				<option value=''>--- pilih ---
				<?php
				for($i=1;$i<=6;$i++){
					echo "<option value=$i>$i";
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
					echo "<option value=$jns>$jns";
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
					echo "<option value=$i>$i";
				}
				?>
				</select>
			</div>
			<div>		
				<button class="btn btn-primary" type="button" id="btnSimpan">Simpan</button>
			</div>
		</form>
	</div>
	<script>
	$(document).ready(function(){
		$("#btnSimpan").on('click', function(){
			var idmatkul1 = $("#idmatkul1").val();
			var idmatkul2 = $("#idmatkul2").val();			
			var nama = $("#nama").val();
			var sks = $("#sks").val();
			var jns = $("#jns").val();
			var smt = $("#smt").val();
			$.ajax({
				type	: "post",
				url 	: "sv_addMatkul.php",
				data 	: {
					idmatkul1	: idmatkul1,
					idmatkul2 	: idmatkul2,
					nama 	: nama,
					sks  	: sks,
					jns 	: jns,
					smt 	: smt
				},
				success : function(data){
					$("#idmatkul1").val('');
					$('#idmatkul2').val('');
					$("#nama").val('');
					$('#sks').val('');
					$('#jns').val('');
					$('#smt').val('');
					$('#success').show();
					$('#success').html(data);
				}
			});
		});
	});
	</script>	
</body>
</html>