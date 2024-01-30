<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asets/css/bootstrap.min.css">
    <title></title>
</head>
<style>
    @page {
  size: A4 landscape;
    }
</style>
<body>
        <div class="row justify-content-center mt-4 py-4">
            <div class="col-lg-2 col-md-3">
                <div class="card text-center border-0">
                    <div class="card-img-top">
                        <img src="asets/img/logo.png" width="90" alt="" srcset="">
                    </div>
                </div>
            </div>
            <div class="col-lg-10 col-md-8 ">
                <div class="card border-0">
                    <div class="card-body">
                    <h6 class="text-center">Dinas Kependudukan Dan Catatan Sipil Bone Bolango</h6>
                    <h6 class="text-center">Rekapitulasi Data Tamu</h6>
                    <p class="text-center">Jl. Prof. Dr. Ing. B. J. Habibie, Moutong,Kec. Tilongkabila, Kabupaten Bone Bolango, Gorontalo 96119</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <table border="1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Nama Tamu</th>
                            <th>Alamat</th>
                            <th>Tujuan</th>
                            <th>Asal</th>
                            <th>No. HP</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>		
                        <?php
                        $tgl1 = $_POST['tanggala'];
                        $tgl2 = $_POST['tanggalb'];        
                        $tampil = mysqli_query($koneksi, "SELECT * FROM ttamu where tanggal BETWEEN '$tgl1' and '$tgl2' order by tanggal asc");
                        $no = 1;
                        while($data = mysqli_fetch_array($tampil)) {
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['tanggal'] ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['alamat'] ?></td>
                            <td><?= $data['tujuan'] ?></td>
                            <td><?= $data['asal'] ?></td>
                            <td><?= $data['nope'] ?></td>
                            <td><img src="<?= $data['image'] ?>" width="90" alt="" srcset=""></td>
                        </tr>
                        <?php } ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>