<?php if ( ! isset($_SESSION['is_logged'])) header('location: login.php');?>

<?php
if (isset($_POST['form']) AND $_POST['form'] == 'true') {
    if ($koneksi->query("INSERT INTO variabel_guna_masuk VALUES(NULL, $_POST[kd_sub_kriteria], '$_POST[nama_var_guna_masuk]', $_POST[jumlah])")) {
        echo "<script>alert('Berhasil diinput!'); window.location='?halaman=variabel_guna_masuk';</script>";
    } else {
        echo "<script>alert('Gagal diinput!'); window.location='?halaman=variabel_guna_masuk';</script>";
    }
}
if (isset($_GET['action']) AND $_GET['action'] == 'delete') {
    $koneksi->query("DELETE FROM variabel_guna_masuk WHERE kd_var_guna_masuk=$_GET[id]");
    echo "<script>alert('Berhasil dihapus!'); window.location='?halaman=variabel_guna_masuk';</script>";
}
?>
<div class="row">
    <div class="col-md-4 hidden-print">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="text-center">TAMBAH</h3></div>
            <div class="panel-body">
                <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
                    <div class="form-group">
                        <label for="kd_sub_kriteria">Sub Kriteria</label>
                        <select name="kd_sub_kriteria" class="form-control">
                            <option value="" selected="on">---</option>
                            <?php if ($query = $koneksi->query("SELECT * FROM sub_kriteria")): ?>
                                <?php while ($data = $query->fetch_array()): ?>
                                    <option value="<?=$data['kd_sub_kriteria']?>"><?=$data['nama_sub_kriteria']?></option>
                                <?php endwhile ?>
                            <?php endif ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_var_guna_masuk">Nama Var Guna Masuk</label>
                        <input type="text" name="nama_var_guna_masuk" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control">
                    </div>
                    <input type="hidden" name="form" value="true">
                    <button type="submit" class="btn btn-info btn-block">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="text-center">DAFTAR</h3></div>
            <div class="panel-body">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Sub Kriteria</th>
                        <th>Var Guna Masuk</th>
                        <th>Jumlah</th>
                        <th class="hidden-print"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($query = $koneksi->query("SELECT kd_var_guna_masuk, nama_sub_kriteria, nama_var_guna_masuk, v.jumlah AS jumlah_v FROM variabel_guna_masuk v LEFT JOIN sub_kriteria s ON v.kd_sub_kriteria=s.kd_sub_kriteria")): ?>
                        <?php $no = 1; ?>
                        <?php while($data = $query->fetch_array()): ?>
                            <tr>
                                <td><?=$no++?></td>
                                <td><?=$data['nama_sub_kriteria']?></td>
                                <td><?=$data['nama_var_guna_masuk']?></td>
                                <td><?=$data['jumlah_v']?></td>
                                <td class="hidden-print">
                                    <div class="btn-group">
                                        <a href="?halaman=variabel_guna_masuk&action=update&id=<?=$data['kd_var_guna_masuk']?>" class="btn btn-warning btn-xs">Edit</a>
                                        <a href="?halaman=variabel_guna_masuk&action=delete&id=<?=$data['kd_var_guna_masuk']?>" class="btn btn-danger btn-xs">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile ?>
                    <?php endif ?>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer hidden-print ">
                <a onClick="window.print();return false" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i></a>
            </div>
        </div>
    </div>
</div>