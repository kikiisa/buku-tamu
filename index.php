<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Informasi Buku Tamu</title>

    <link href="asets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="asets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="asets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-success">
    <?php include "koneksi.php"; ?>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand  text-center" href="#">
                <img src="asets/img/logodukcapil.png" width="30">
                <strong>
                    SISTEM INFORMASI BUKU TAMU
                </strong>
            </a>
            <div class="ml-auto">
                <a href="login.php" class="btn btn-primary">Login Admin</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-2 justify-content-center">
            <div class="col-lg-6 mb-3">
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
                                    <?php while ($kategori = mysqli_fetch_array($category)) { ?>
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
                        </form>
                        </div>
                </div>
            </div>
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

        submitForm.addEventListener("submit", async function(event) {
            event.preventDefault();
            const form = new FormData();
            let blobImage = dataURLToBlob(dataImage);
            form.append("nama", document.querySelector(".nama").value)
            form.append("alamat", document.querySelector(".alamat").value)
            form.append("tujuan", document.querySelector(".tujuan").value)
            form.append("nope", document.querySelector(".nope").value)
            form.append("asal", document.querySelector(".from").value)
            form.append("category", document.querySelector(".category").value)
            form.append("image", blobImage)
            try {
                const response = await axios.post("api.php", form);
                console.log(response);
                if (response.data.status) {
                    window.location.reload()
                    alert("data berhasil di input");
                } else {
                    alert("terjadi kesalahan")
                }
            } catch (error) {
                console.log(error);
            }

        });
    </script>
    ?>
    <?php include "footer.php"; ?>
</body>

</html>