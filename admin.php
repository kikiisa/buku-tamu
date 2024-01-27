<?php include "header.php"; ?>
<div class="head text-center">
    <img class="mt-4" src="asets/img/logodukcapil.png" width="70">
    <h2 class="text-white">Sistem Informasi Buku Tamu <br> </h2>
</div>
<div class="row mt-2 justify-content-center ext-center">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Tamu</h6>
            </div>
            
            <div class="card-body">
                <a href="rekapitulasi.php" class="btn btn-success mb-3"><i class="fa fa-table"></i> Rekapitulasi Data Tamu</a>
                <a href="logout.php" class="btn btn-danger mb-3"><i class="fa fa-sign-out-alt"></i> Logout</a>
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
                                <th>Aksi</th>
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
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $tgl = date('Y-m-d'); //2023-11-15
                            $tampil = mysqli_query($koneksi, "SELECT ttamu.id,ttamu.nama,ttamu.alamat,ttamu.tujuan,ttamu.asal,ttamu.nope,ttamu.tanggal,ttamu.kategori_id,kategori.category,ttamu.image FROM ttamu INNER JOIN kategori ON kategori.id = ttamu.kategori_id  order by ttamu.id desc ");
                            
                            $no = 1;
                            while ($data = mysqli_fetch_assoc($tampil)) {
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
                                    <td>
                                        <a href="edit.php?id=<?= $data['id'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                        <a href="delete.php?id=<?= $data['id'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>