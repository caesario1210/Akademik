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
        .table th:nth-child(2) { width: 15%; }
        .table th:nth-child(3) { width: 25%; }
        .table th:nth-child(4) { width: 10%; }
        .table th:nth-child(5) { width: 10%; }
        .table th:nth-child(6) { width: 15%; }
        
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
			$jmlDataPerHal = 5;

			//pencarian data
			if (isset($_POST['cari'])){
				$cari=$_POST['cari'];
				$sql="select * from matkul where idmatkul like'%$cari%' or
						   namamatkul like '%$cari%' or
						  sks like '%$cari%' or
						  jns like '%$cari%' or
						  smt like '%$cari%'";
			}else{
				$sql="select * from matkul";		
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
			if (isset($_POST['cari'])){
				$cari=$_POST['cari'];
				$sql="select * from matkul where idmatkul like'%$cari%' or
						  namamatkul like '%$cari%' or
						  sks like '%$cari%' or
						  jns like '%$cari%' or
						  smt like '%$cari%'
								limit $awalData,$jmlDataPerHal";
			}else{
				$sql="select * from matkul limit $awalData,$jmlDataPerHal";		
			}

			//Ambil data untuk ditampilkan
			$hasil=mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));

		?>
		<div class="utama">
			<h2 class="text-center">Daftar Mata kuliah</h2>
			<div class="text-center"><a href="cetakMatkulmpdf.php"><span class="fas fa-print">&nbsp;Print</span></a></div>
			<span class="float-left">
				<a class="btn btn-success" href="addMatkul.php">Tambah Data</a>
			</span>
			<form class="d-flex" action="" method="POST" style="float:right;">
        		<button class="btn btn-outline-success" style="background-color:black;" type="submit">pencarian</button>
				<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="cari">
        		
      </form>
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
                    <th>Kode</th>
                    <th>Nama mata kuliah</th>
                    <th>SKS</th>
                    <th>Jenis</th>
                    <th>Semester</th>
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
                            <td><?php echo $row["idmatkul"]?></td>
                            <td><?php echo $row["namamatkul"]?></td>
                            <td><?php echo $row["sks"]?></td>
                            <td><?php echo $row["jns"]?></td>
                            <td><?php echo $row["smt"]?></td>
                            <td>
								<a class="btn btn-outline-primary btn-sm" href="editMatkul.php?kode=<?php echo $row['idmatkul']?>"id="linkEdit" onclick="return confirm('Pasti ada yang salah')">Edit</a>
								<a href="#" class="btn btn-outline-danger btn-sm btn-delete" data-id="<?php echo $row['idmatkul']; ?>">Hapus</a>
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
        const idmatkul = $(this).data('id');
        const confirmation = confirm('Yakin dihapus nih?');
        
        if (confirmation) {
            $.ajax({
                url: 'hpsMatkul.php',
                type: 'POST',
                data: { idmatkul: idmatkul },
                success: function (response) {
                    alert(response);
                    location.reload(); // Reload halaman setelah berhasil
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