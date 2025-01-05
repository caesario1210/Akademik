<?php
//memanggil file pustaka fungsi
require "fungsi.php";

//memindahkan data kiriman dari form ke var biasa
$idkultawar=$_POST["idkultawar"];
$idmatkul=$_POST["idmatkul1"].".".$_POST["idmatkul2"];
$npp=$_POST["npp1"].".".$_POST["npp2"].".".$_POST["npp3"];
$klp=$_POST["klp1"].".".$_POST["klp2"];
$hari=$_POST["hari"];
$jamkul=$_POST["jamkul"];
$ruang=$_POST["ruang"];

//membuat query
$sql="update kultawar set npp='$npp',
					    hari='$hari',
                        klp='$klp',
						jamkul='$jamkul',
						ruang='$ruang'
							where idkultawar='$idkultawar'";
mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));
header("location:ajaxUpdateKulta.php");
?>