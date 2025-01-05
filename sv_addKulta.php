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

// simpan data
$sql="insert kultawar values('$idkultawar','$idmatkul','$npp','$klp','$hari','$jamkul','$ruang')";
mysqli_query($koneksi,$sql);
echo "Data telah tersimpan";
//header("location:addKultaw.php");
?>