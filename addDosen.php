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
		<h3>TAMBAH DATA DOSEN</h3>
		<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	  		<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
		</div>	
		<form id="faddDosen" method="post" action="sv_addDosen.php" enctype="multipart/form-data">
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
			<div class="form-group">
				<label for="namadosen">Nama dosen:</label>
				<input class="form-control" type="text" name="namadosen" id="namadosen">
			</div>
			<div class="form-group">
				<label for="homebase">Homebase:</label>
				<select class="form-control" name="homebase" id="homebase">
					<?php
					$arrhobe=array('A11','A12','A14','A15','A16','A17','A22','A24','P31');
					foreach($arrhobe as $hb){
						echo "<option value=$hb>$hb";
					}
					?>					
				</select>
			</div>
			<div>		
				<button class="btn btn-primary" type="button" name="tombsimpan" id="tombsimpan">Simpan</button>
			</div>
		</form>
	</div>
	<script>
	$(document).ready(function(){
		$("#tombsimpan").on('click', function(){
			var npp1 = $("#npp1").val();
			var npp2 = $("#npp2").val();
			var npp3 = $("#npp3").val();
			var namadosen = $("#namadosen").val();
			var homebase = $("#homebase").val();
			$.ajax({
				type	: "post",
				url 	: "sv_addDosen.php",
				data 	: {
					npp1	: npp1,
					npp2 	: npp2,
					npp3	: npp3,
					namadosen	: namadosen,
					homebase: homebase
				},
				success : function(data){
					$("#npp1").val('');
					$('#npp2').val('');
					$("#npp3").val('');
					$('#namadosen').val('');
					$('#homebase').val('');
					$('#success').show();
					$('#success').html(data);
				}
			});
		});
	});
	</script>	
</body>
</html>