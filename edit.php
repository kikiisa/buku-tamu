<?php include "header.php"; ?>
<?php  
if(isset($_GET["id"]))
{
    $id = $_GET["id"];
    $tampil = mysqli_query($koneksi, "SELECT ttamu.id,ttamu.nama,ttamu.alamat,ttamu.tujuan,ttamu.asal,ttamu.nope,ttamu.tanggal,ttamu.kategori_id,kategori.category,ttamu.image FROM ttamu INNER JOIN kategori ON kategori.id = ttamu.kategori_id  WHERE ttamu.id = $id");
    $datas = mysqli_query($koneksi, "SELECT * FROM kategori");
}else{
    header("Location: admin.php");
}

if(isset($_POST["bsimpan"]))
{
    $query = mysqli_query($koneksi, "UPDATE ttamu SET kategori_id = '$_POST[category]', nama = '$_POST[nama]', alamat = '$_POST[alamat]', tujuan = '$_POST[tujuan]', asal = '$_POST[asal]', nope = '$_POST[nope]' WHERE id = $id");
    if($query)
    {
        echo "<script>alert('Data Berhasilsil Diubah');</script>";
        header("Location: admin.php");
    }else{
        echo "<script>alert('Data Gagal Diubah');</script>";
    }
}

?>
<div class="head text-center">
    <h2 class="text-white mt-4">Edit Data Tamu <br> </h2>
</div>
<div class="row mt-2 justify-content-center ext-center">
    <div class="col-lg-8 mb-3">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="card shadow bg-gradient-light">
                    <div class="card-body">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900">Identitas Tamu</h1>
                        </div>      
                        <form class="user" method="POST">
                            <?php while($fetch = mysqli_fetch_assoc($tampil)){ ?>
                            <div class="form-group">
                                <input type="text" value="<?= $fetch['nama'] ?>" class="form-control form-control-user nama" name="nama" placeholder="Nama Tamu" required>
                            </div>
                            <div class="form-group">
                                <input value="<?= $fetch['alamat'] ?>" type="text" class="form-control form-control-user alamat" name="alamat" placeholder="Alamat Tamu" required>
                            </div>
                            <div class="form-group">
                                <select name="category" id="category" class="form-control category">
                                    <option value="" selected disabled>--Pilih Kategori Tamu--</option>
                                    <?php while ($kategori = mysqli_fetch_array($datas)) { ?>
                                        <option <?= $fetch['kategori_id'] == $kategori["id"] ? "selected" : "" ?> value="<?= $kategori["id"] ?>"><?= $kategori["category"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user tujuan" value="<?= $fetch['tujuan'] ?>" name="tujuan" placeholder="Tujuan Tamu" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user nope"  name="nope" value="<?= $fetch['nope'] ?>" placeholder="No.hp Tamu" required>
                            </div>
                            <div class="form-group">
                                <input type="text" value="<?= $fetch['asal'] ?>" class="form-control form-control-user from" name="asal" placeholder="Asal Tamu" required>
                            </div>
                            <?php } ?>
                            <button type="submit" name="bsimpan" class="btn btn-primary btn-user btn-block">Simpan Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "../footer.php"; ?>