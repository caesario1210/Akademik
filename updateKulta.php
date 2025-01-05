<!DOCTYPE html>
<html>
<head>
		<title>Sistem Informasi Akademik::Daftar Mahasiswa</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/styleku.css">
    <!-- jQuery Google CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Add custom styles -->
    <style>
        .table-container {
            min-height: 400px;
        }
        .table {
            margin-bottom: 0;
        }
        .table th {
            width: auto;
            white-space: nowrap;
        }
        .table th:nth-child(1) { width: 5%; }
        .table th:nth-child(2) { width: 20%; }
        .table th:nth-child(3) { width: 20%; }
        .table th:nth-child(4) { width: 10%; }
        .table th:nth-child(5) { width: 15%; }
        .table th:nth-child(6) { width: 10%; }
        .table td {
            vertical-align: middle;
        }
        
        .search-container {
            max-width: 500px;
            margin: 20px auto;
            text-align: center;
        }

        .action-container {
            margin-bottom: 20px;
        }

        .empty-message {
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Loading spinner */
        .loading {
            display: none;
            text-align: center;
            padding: 15px;
        }
        .loading:after {
            content: '';
            display: inline-block;
            width: 2rem;
            height: 2rem;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
	</head>
	<body>
		<?php
			//memanggil file berisi fungsi2 yang sering dipakai
			require "fungsi.php";
			require "head.html";

			/*	---- cetak data per halaman ---------	*/

			//--------- konfigurasi
			//jumlah data per halaman
			$jmlDataPerHal = 7;

			//pencarian data
			if (isset($_POST['cari'])){
				$cari=$_POST['cari'];
				$sql="select * from kultawar where idkultawar like'%$cari%' or
						   idmatkul like '%$cari%' or
						  namadosen like '%$cari%' or
                          klp like '%$cari%' or
						  hari like '%$cari%' or
                          jam like '%$cari%' or
						  ruang like '%$cari%'";
			}else{
				$sql="select * from kultawar";		
			}

			$qry = mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));
			$jmlData = mysqli_num_rows($qry);

			// CEIL() digunakan untuk mengembalikan nilai integer terkecil yang lebih besar dari 
			//atau sama dengan angka.
			$jmlHal = ceil($jmlData / $jmlDataPerHal);

			if (isset($_GET['hal'])){
				$halAktif=$_GET['hal'];
			}else{
				$halAktif=1;
			}

			$awalData=($jmlDataPerHal * $halAktif)-$jmlDataPerHal;

			//Jika tabel data kosong
			$kosong=false;
			if (!$jmlData){
				$kosong=true;
			}

			//Klausa LIMIT digunakan untuk membatasi jumlah baris yang dikembalikan oleh pernyataan SELECT
			//data berdasar pencarian atau tidak
// Ambil data untuk ditampilkan
			if (isset($_POST['cari'])) {
				$cari = $_POST['cari'];
				$sql = "
					SELECT 
						matkul.namamatkul,
						dosen.namadosen,
						kultawar.klp,
						kultawar.hari,
						kultawar.jamkul,
						kultawar.ruang
					FROM 
						kultawar
					JOIN 
						dosen 
					ON 
						kultawar.npp = dosen.npp
					JOIN 
						matkul
					ON 
						kultawar.idmatkul = matkul.idmatkul
					WHERE 
						matkul.namamatkul LIKE '%$cari%' OR
						dosen.namadosen LIKE '%$cari%' OR
						kultawar.klp LIKE '%$cari%' OR
						kultawar.hari LIKE '%$cari%' OR
						kultawar.jamkul LIKE '%$cari%' OR
						kultawar.ruang LIKE '%$cari%'
					LIMIT $awalData, $jmlDataPerHal";
			} else {
				$sql = "
					SELECT 
						matkul.namamatkul,
						dosen.namadosen,
						kultawar.klp,
						kultawar.hari,
						kultawar.jamkul,
						kultawar.ruang
					FROM 
						kultawar
					JOIN 
						dosen 
					ON 
						kultawar.npp = dosen.npp
					JOIN 
						matkul
					ON 
						kultawar.idmatkul = matkul.idmatkul
					LIMIT $awalData, $jmlDataPerHal";
			}
			$hasil = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
		?>
		<div class="utama">
			<h2 class="text-center">Daftar Kuliah Tawar</h2>
			<div class="text-center"><a href="cetakKultampdf.php"><span class="fas fa-print">&nbsp;Print</span></a></div>
			<span class="float-left">
				<a class="btn btn-success" href="addKultaw.php">Tambah Data</a>
			</span>
			<span class="float-right">
				<form action="" method="post" class="form-inline">
					<button class="btn btn-success" type="submit" name="cari" id="tombol-cari"> Cari</button>
					<input class="form-control mr-2 ml-2" type="text" name="cari" placeholder="cari data kultawar..." autofocus autocomplete="off" id="keyword">
				</form>
			</span>
			<br><br>

			<ul class="pagination">
				<?php
					//navigasi pagination
					//cetak navigasi back
					if ($halAktif>1){
						$back=$halAktif-1;
						//$back=$halAktif;
						echo "<li class='page-item'><a class='page-link' href=?hal=$back>&laquo;</a></li>";
					}
					//cetak angka halaman
					for($i=1;$i<=$jmlHal;$i++){
						if ($i==$halAktif){
							echo "<li class='page-item'><a class='page-link' href=?hal=$i style='font-weight:bold;color:red;'>$i</a></li>";
						}else{
							
							echo "<li class='page-item'><a class='page-link' href=?hal=$i>$i</a></li>";
						}	
					}
					//cetak navigasi forward
					if ($halAktif<$jmlHal){
						$forward=$halAktif+1;
						echo "<li class='page-item'><a class='page-link' href=?hal=$forward>&raquo;</a></li>";
					}
				?>
			</ul>	

		<div id="container">		
			<!-- Cetak data dengan tampilan tabel -->
			<table class="table table-hover">
				<thead class="thead-light">
				<tr>
                    <th>No.</th>
                    <th>Mata Kuliah</th>
                    <th>Nama Dosen</th>
                    <th>Kelompok</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Ruang</th>
                    <th>Aksi</th>

				</tr>
				</thead>
				
				<tbody>
					<?php
						//jika data tidak ada
						if ($kosong){
					?>
						<tr><th colspan="6">
							<div class="alert alert-info alert-dismissible fade show text-center">
							<!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
							Data tidak ada
							</div>
						</th></tr>
					<?php
					}else{	
						// $awalData==0, data kalau tampail di page pertama, maka 
						if($awalData==0){
							$no=$awalData+1;
						}else{
							//$no=$awalData;
							$no=$awalData+1;
						}
						while($row=mysqli_fetch_assoc($hasil)){
					?>	
						<tr>
                            <td><?php echo $no?></td>
                            <td><?php echo $row["namamatkul"]?></td>
                            <td><?php echo $row["namadosen"]?></td>
                            <td><?php echo $row["klp"]?></td>
                            <td><?php echo $row["hari"]?></td>
                            <td><?php echo $row["jamkul"]?></td>
                            <td><?php echo $row["ruang"]?></td>
                            <td>
								<a class="btn btn-outline-primary btn-sm" href="editKulta.php?kode=<?php echo $row['klp']?>"id="linkEdit" onclick="return confirm('Pasti ada yang salah')">Edit</a>
								<a href="#" class="btn btn-outline-danger btn-sm btn-delete" data-id="<?php echo $row['klp']; ?>">Hapus</a>
							</td>
						</tr>
								<?php 
									$no++;
						}
					}
							?>
				</tbody>
			</table>
		</div>	
		
	</div>
	<script>
	     $(document).on('click', '.btn-delete', function (e) {
    e.preventDefault();
    const klp = $(this).data('id');
    const confirmation = confirm('Yakin dihapus nih?');
    
    if (confirmation) {
        $.ajax({
            url: 'hpsKulta.php', // Ganti dengan file PHP yang menangani penghapusan
            type: 'POST',
            data: { klp: klp },
            success: function (response) {
                alert(response); // Menampilkan pesan sukses
                location.reload(); // Reload halaman untuk memperbarui tampilan
            },
            error: function () {
                alert('Gagal menghapus data.');
            }
        });
    }
});
</script>
</body>
</html>	