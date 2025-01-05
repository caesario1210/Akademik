<!DOCTYPE html>
<html>
<head>
    <title>Sistem Informasi Akademik::Mengganti Foto Mahasiswa</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/styleku.css">
    <script src="bootstrap-5.1.3-dist/jquery/3.3.1/jquery-3.3.1.js"></script>
    <script src="bootstrap-5.1.3-dist/js/bootstrap.js"></script>
    <style>
        .photo-container {
            margin-bottom: 30px;
        }
        
        .current-photo {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 15px;
        }
        
        .student-info {
            font-size: 1.1em;
            color: #444;
            margin-bottom: 25px;
        }
        
        .upload-container {
            max-width: 400px;
            margin: 0 auto;
        }
        
        .file-input-container {
            background-color: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        
        .file-input-container:hover {
            border-color: #0d6efd;
            background-color: #f1f4f9;
        }
        
        .custom-file-input {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <?php
    require "fungsi.php";
    
    $id=$_GET['id'];
    $sql="select * from mhs where id='$id'";
    $hasil=mysqli_query($koneksi,$sql) or die (mysqli_error($koneksi));
    $row=mysqli_fetch_assoc($hasil);
    
    require "head.html";
    ?>
    
    <div class="utama">
        <h2 class="mb-5 text-center">GANTI FOTO MAHASISWA</h2>
        
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center photo-container">
                        <img src="<?php echo "foto/".$row["foto"]?>" class="current-photo" alt="Foto Mahasiswa">
                        <div class="student-info">
                            <?php echo $row['nim']." - ".$row['nama']?>
                        </div>
                    </div>
                    
                    <div class="upload-container">
                        <form method="post" action="simpanGantifoto.php" enctype="multipart/form-data" class="text-center">
                            <div class="file-input-container">
                                <input class="form-control custom-file-input" type="file" name="foto" id="foto">
                                <input type="hidden" name="id" value="<?php echo $id?>">
                            </div>
                            <button class="btn btn-primary px-4" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Preview foto sebelum upload
        document.getElementById('foto').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('.current-photo').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>