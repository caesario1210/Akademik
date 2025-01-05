<?php
//memanggil file pustaka fungsi
require "fungsi.php";

//memindahkan data kiriman dari form ke var biasa
$idmatkul=$_POST["idmatkul1"].".".$_POST["idmatkul2"];
$nama=$_POST["nama"];
$sks=$_POST["sks"];
$jns=$_POST["jns"];
$smt=$_POST["smt"];

// simpan data
$sql="insert matkul values('$idmatkul','$nama','$sks','$jns','$smt')";
mysqli_query($koneksi,$sql);
echo "Data telah tersimpan";
//header("location:addMatkul.php");
?>