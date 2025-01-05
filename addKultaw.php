<!DOCTYPE html>
<html>
<head>
	<title>Sistem Informasi Akademik::Tambah Data Mata Kuliah</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styleku.css">
	<script src="bootstrap-5.1.3-dist/js/jquery-3.3.1.js"></script>
	<script src="bootstrap-5.1.3-dist/js/bootstrap.js"></script>
	<style>
            body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            }

            header {
                background-color:#191970;
                color: #fff;
                padding: 20px;
                text-align: center;
            }

            .container {
                max-width: 1000px;
                margin: 0 auto;
                padding: 10px;
				display: flex;
    			align-items: center;
            }

            .grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
            }
            a {
            color: black; /* Mengubah warna font menjadi merah */
            text-decoration: none; /* Menghilangkan garis bawah pada link */
            }

            .card {
                background-color: #87CEFA;
                text-align: center;
                padding: 20px;
                border-radius: 5px;
                box-shadow
            }
            #topBox {
                position: absolute;
                top: 10px;
                right: 10px;
                background-color: lightblue;
                padding: 10px;
            }

            #topBox h2 {
                margin: 0;
                font-size: 15px;
            }

        </style>
</head>
<body>
<div id="topBox" style="display: flex; align-items: center;">
            <img src="img/001.jpg" alt="Dosen"style ="width:50px;height: 50px%;border-radius: 5px;  margin-left: 10px;margin-right: 10px;">
            <div>
            <h2>NIM: A12.2022.06910</h2>
            <h2>Nama: Caesario Gumilang F</h2>
        </div>
        </div>  
        <header>
            <div class="container">
                <h1>SIA Administrator</h1>
            </div>
        </header>
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
				<label for="idkultawar">ID Kultawar:</label>
				<select class="form-control-ku" name="idkultawar" id="idkultawar">
					<option value=''>--- pilih ---
					<?php
                    for($i=1;$i<=20;$i++){
                        echo "<option value=$i>$i";
                    }
                    ?>
				</select>
			</div>
			<div class="form-group" >
				<label for="idmatkul1">Kode :</label>
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
			
            <div class="form-group" style="margin-top: 10px;">
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
			<div class="form-group" style="margin: top 20px;">
				<label for="hari">Hari</label> 
				<select class="form-control-ku col-md-2" name="hari" id="hari" style="width: 100px;">
				<option value=''>--- pilih ---
				<?php
				$arrhobe=array('Senin','Selasa','Rabu','Kamis','Jumat');
                foreach($arrhobe as $hb){
                    echo "<option value=$hb>$hb";
                }
				?>
				</select>
                <label for="jamkul">Jam</label> 
				<select class="form-control-ku col-md-2" name="jamkul" id="jamkul" style="width: 100px;">
				<option value=''>--- pilih ---
				<?php
				$arrhobe=array('07.00-08.40','07.00-09.00','08.40-10.20','09.00-11.30','10.20-12.00','12.30-14.10');
                foreach($arrhobe as $hb){
                    echo "<option value=$hb>$hb";
                }
				?>
				</select>
                <label for="ruang">Ruang</label> 
				<select class="form-control-ku col-md-2" name="ruang" id="ruang" style="width: 100px;">
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
				<button class="btn btn-primary" type="button" id="btnSimpan">Simpan</button>
			</div>
		</form>
	</div>
	<script>
	$(document).ready(function(){
		$("#btnSimpan").on('click', function(){
            var idkultawar = $("#idkultawar").val();
			var idmatkul1 = $("#idmatkul1").val();
			var idmatkul2 = $("#idmatkul2").val();	
            var npp1 = $("#npp1").val();
			var npp2 = $("#npp2").val();	
            var npp3 = $("#npp3").val();		
			var klp1 = $("#klp1").val();
            var klp2 = $("#klp2").val();
			var hari = $("#hari").val();
			var jamkul = $("#jamkul").val();
            var ruang = $("#ruang").val();

			$.ajax({
				type	: "post",
				url 	: "sv_addKulta.php",
				data 	: {
                    idkultawar	: idkultawar,
					idmatkul1	: idmatkul1,
					idmatkul2 	: idmatkul2,
                    npp1	: npp1,
					npp2 	: npp2,
					npp3 	: npp3,
                    klp1	: klp1,
					klp2 	: klp2,
					hari  	: hari,
					jamkul 	: jamkul,
					ruang 	: ruang
				},
				success : function(data){
                    $("#idkultawar").val('');
					$("#idmatkul1").val('');
					$('#idmatkul2').val('');
                    $('#npp1').val('');
                    $('#npp2').val('');
                    $('#npp3').val('');
                    $("#klp1").val('');
					$('#klp2').val('');
					$('#hari').val('');
					$('#jamkul').val('');
					$('#ruang').val('');
					$('#success').show();
					$('#success').html(data);
				}
			});
		});
	});
	</script>	
</body>
</html>