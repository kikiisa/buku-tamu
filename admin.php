<?php include "header.php"; ?>
<?php

$category = mysqli_query($koneksi, "SELECT * FROM kategori");

if (isset($_POST['bsimpan'])) {
    $tgl = date('Y-m-d');
    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);
    $alamat = htmlspecialchars($_POST['alamat'], ENT_QUOTES);
    $tujuan = htmlspecialchars($_POST['tujuan'], ENT_QUOTES);
    $nope = htmlspecialchars($_POST['nope'], ENT_QUOTES);
    $simpan = mysqli_query($koneksi, "INSERT INTO ttamu VALUES('','$tgl','$nama','$alamat', '$tujuan', '$nope')");

    if ($simpan) {
        echo "<script>alert('Simpan Data Sukses, Terima Kasih');
    document.location='?'</script>";
    } else {
        echo "<script>alert('Simpan Data Gagal');
    document.location='?'</script>";
    }
}
?>
<style>
    #my_camera {
        width: 100%;
        /* Make the image fill the width of the div */
        height: auto;
        /* Maintain the image's aspect ratio */
    }
</style>
<div class="head text-center">
    <img class="mt-4" src="asets/img/logodukcapil.png" width="70">
    <h2 class="text-white">Sistem Informasi Buku Tamu <br> </h2>
</div>
<div class="row mt-2">
    <div class="col-lg-7 mb-3">
        <div class="card shadow bg-gradient-light">
            <div class="card-body">

                <div class="text-center">
                    <h1 class="h4 text-gray-900">Identitas Tamu</h1>
                </div>
                <form class="user" method="POST">
                        <div class="card mb-2">
                            <div class="row justify-content-center">
                                <div id="my_camera">
                                </div>
                                <div id="my_result">
                                </div>
                            </div>
                        </div>
                        <a href="javascript:take_snapshot();" class="btn btn-primary mb-3" id="snap">Ambil</a>
                        <a href="javascript:take_reset();" class="btn btn-danger  mb-3" id="snap">Reset</a>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user nama" name="nama" placeholder="Nama Tamu" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user alamat" name="alamat" placeholder="Alamat Tamu" required>
                        </div>
                        <div class="form-group">
                            <select name="category" id="category" class="form-control category">
                                <option value="" selected disabled>--Pilih Kategori Tamu--</option>
                                <?php while($kategori = mysqli_fetch_array($category)){ ?>
                                    <option value="<?= $kategori["id"] ?>"><?= $kategori["category"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user tujuan" name="tujuan" placeholder="Tujuan Tamu" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user nope" name="nope" placeholder="No.hp Tamu" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user from" name="from" placeholder="Asal Tamu" required>
                        </div>
                        <button type="submit" name="bsimpan" class="btn btn-primary btn-user btn-block">Simpan Data</button>
                    </div>
            </div>
        </div>
        <div class="col-lg-5 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Statistik Data Tamu</h1>
                    </div>
                    <?php
                    $tgl_sekarang = date('Y-m-d');
                    $sekarang = date('Y-m-d h:i:s');
                    $kemarin = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
                    $seminggu = date('Y-m-d h:i:s', strtotime('-1 week +1 day', strtotime($tgl_sekarang)));
                    $bulan_ini = date('m');

                    $tgl_sekarang = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM ttamu where tanggal like '%$tgl_sekarang%'"));
                    $kemarin = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM ttamu where tanggal like '%$kemarin%'"));
                    $seminggu = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM ttamu where tanggal BETWEEN '$seminggu' and '$sekarang'"));
                    $sebulan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM ttamu where month (tanggal) = '$bulan_ini'"));
                    $keseluruhan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM ttamu "));
                    ?>
                    <table class="table table-bordered">
                        <tr>
                            <td>Hari ini</td>
                            <td>: <?= $tgl_sekarang[0] ?></td>
                        </tr>
                        <tr>
                            <td>Kemarin</td>
                            <td>: <?= $kemarin[0] ?></td>
                        </tr>
                        <tr>
                            <td>Minggu ini</td>
                            <td>: <?= $seminggu[0] ?></td>
                        </tr>
                        <tr>
                            <td>Bulan ini</td>
                            <td>: <?= $sebulan[0] ?></td>
                        </tr>
                        <tr>
                            <td>Keseluruhan</td>
                            <td>: <?= $keseluruhan[0] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Tamu Hari ini [<?= date('d-m-Y') ?>]</h6>
        </div>
        <div class="card-body">
            <a href="rekapitulasi.php" class="btn btn-success mb-3"><i class="fa fa-table"></i>Rekapitulasi Data Tamu</a>
            <a href="logout.php" class="btn btn-danger mb-3"><i class="fa fa-sign-out-alt"></i>Logout</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Nama Tamu</th>
                            <th>Alamat</th>
                            <th>Tujuan</th>
                            <th>Asal</th>
                            <th>No. HP</th>
                            <th>Kategori</th>
                            <th>Gambar</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Nama Tamu</th>
                            <th>Alamat</th>
                            <th>Tujuan</th>
                            <th>Asal</th>
                            <th>No. HP</th>
                            <th>Kategori</th>
                            <th>Gambar</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $tgl = date('Y-m-d'); //2023-11-15
                        $tampil = mysqli_query($koneksi, "SELECT * FROM ttamu INNER JOIN kategori ON kategori.id = ttamu.kategori_id where tanggal like '%$tgl%' order by ttamu.id desc ");
                        
                        $no = 1;
                        while ($data = mysqli_fetch_array($tampil)) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['tanggal'] ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['alamat'] ?></td>
                                <td><?= $data['tujuan'] ?></td>
                                <td><?= $data['asal'] ?></td>
                                <td><?= $data['nope'] ?></td>
                                <td><?= $data['category'] ?></td>
                                <td><img src="<?= $data['image'] ?>" width="100"></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="./asets/js/axios.min.js"></script>
    <script src="./asets/js/webcam.min.js"></script>
    <script language="javascript">
        Webcam.set({
            width: 410,
            height: 360,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('#my_camera');
    </script>
    <script>
        const my_camera = document.getElementById('my_camera');
        const submitForm = document.querySelector(".user");
        let dataImage = ""
        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                my_camera.hidden = true
                dataImage = data_uri
                
                document.getElementById('my_result').innerHTML = '<img src="' + data_uri + '"/>';
            });
        }
        function dataURLToBlob(dataUrl) {
            var parts = dataUrl.split(';base64,');
            var contentType = parts[0].split(':')[1];
            var raw = window.atob(parts[1]);
            var rawLength = raw.length;
            var uInt8Array = new Uint8Array(rawLength);

            for (var i = 0; i < rawLength; ++i) {
                uInt8Array[i] = raw.charCodeAt(i);
            }

            return new Blob([uInt8Array], {
                type: contentType
            });
        }

        function take_reset() {
            my_camera.hidden = false
            document.getElementById('my_result').innerHTML = ""; 
        }

        submitForm.addEventListener("submit",async function(event) {
            event.preventDefault();
            const form = new FormData();
            let blobImage = dataURLToBlob(dataImage);
            form.append("nama",document.querySelector(".nama").value)
            form.append("alamat",document.querySelector(".alamat").value)
            form.append("tujuan",document.querySelector(".tujuan").value)
            form.append("nope",document.querySelector(".nope").value)
            form.append("asal",document.querySelector(".from").value)
            form.append("category",document.querySelector(".category").value)
            form.append("image",blobImage)
            try
            {
                const response = await axios.post("api.php",form);
                console.log(response);
                if(response.data.status)
                {
                    window.location.reload()
                    alert("data berhasil di input");
                }else{
                    alert("terjadi kesalahan")
                }
            }catch(error)
            {
                console.log(error);
            }
            
        });
    </script>
    ?>
    <?php include "footer.php"; ?>