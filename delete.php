<?php
require_once "koneksi.php";
if(isset($_GET["id"]))
{
    $delete = mysqli_query($koneksi,"SELECT * FROM ttamu WHERE id = '$_GET[id]'");
    $data = mysqli_fetch_array($delete);
    @unlink($data['image']);
    $del = mysqli_query($koneksi,"DELETE FROM ttamu WHERE id = '$_GET[id]'");
    if($del)
    {
        echo "<script>
        alert('Data Berhasilsil Dihapus');
        document.location='admin.php';
        </script>";
    }
}