<?php
//memanggil file pustaka fungsi
require "fungsi.php";

//memindahkan data kiriman dari form ke var biasa
$idmatkul=$_POST["idmatkul"];
$nama=$_POST["nama"];
$sks=$_POST["sks"];
$jns=$_POST["jns"];
$smt=$_POST["smt"];

//membuat query
$sql="update matkul set namamatkul='$nama',
					    sks='$sks',
						jns='$jns',
						smt='$smt'
							where idmatkul='$idmatkul'";
mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));
header("location:ajaxUpdateMatkul.php");
?>