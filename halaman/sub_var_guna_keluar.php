<?php if ( ! isset($_SESSION['is_logged'])) header('location: login.php');?>

<?php
if (isset($_POST['form']) AND $_POST['form'] == 'true') {
    if ($koneksi->query("INSERT INTO sub_var_guna_keluar VALUES(NULL, $_POST[kd_var_guna_keluar], $_POST[kd_var_guna_masuk], '$_POST[nama_sub_var_guna_keluar]', $_POST[jumlah])")) {
        echo "<script>alert('Berhasil diinput!'); window.location='?halaman=sub_var_guna_keluar';</script>";
    } else {
        echo "<script>alert('Gagal diinput!'); window.location='?halaman=sub_var_guna_keluar';</script>";
    }
}
if (isset($_GET['action']) AND $_GET['action'] == 'delete') {
    $koneksi->query("DELETE FROM sub_var_guna_keluar WHERE kd_sub_var_guna_keluar=$_GET[id]");
    echo "<script>alert('Berhasil dihapus!'); window.location='?halaman=sub_var_guna_keluar';</script>";
}
?>
<div class="row">
    <div class="col-md-4 hidden-print">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="text-center">TAMBAH</h3></div>
            <div class="panel-body">
                <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
                    <div class="form-group">
                        <label for="kd_var_guna_keluar">Var Guna Keluar</label>
                        <select name="kd_var_guna_keluar" class="form-control">
                            <option value="" selected="on">---</option>
                            <?php if ($query = $koneksi->query("SELECT * FROM variabel_guna_keluar")): ?>
                                <?php while ($data = $query->fetch_array()): ?>
                                    <option value="<?=$data['kd_var_guna_keluar']?>"><?=$data['nama_var_guna_keluar']?></option>
                                <?php endwhile ?>
                            <?php endif ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kd_var_guna_masuk">Var Guna Masuk</label>
                        <select name="kd_var_guna_masuk" class="form-control">
                            <option value="" selected="on">---</option>
                            <?php if ($query = $koneksi->query("SELECT * FROM variabel_guna_masuk")): ?>
                                <?php while ($data = $query->fetch_array()): ?>
                                    <option value="<?=$data['kd_var_guna_masuk']?>"><?=$data['nama_var_guna_masuk']?></option>
                                <?php endwhile ?>
                            <?php endif ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_sub_var_guna_keluar">Nama Sub Var Guna Keluar</label>
                        <input type="text" name="nama_sub_var_guna_keluar" class="form-control">
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
                        <th>Var Guna Keluar</th>
                        <th>Var Guna Masuk</th>
                        <th>Nama Sub Var Guna Keluar</th>
                        <th>Jumlah</th>
                        <th class="hidden-print"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($query = $koneksi->query("SELECT kd_sub_var_guna_keluar, nama_var_guna_keluar, nama_var_guna_masuk, nama_sub_var_guna_keluar, sk.jumlah AS jumlah_sk FROM sub_var_guna_keluar sk LEFT JOIN variabel_guna_keluar vk ON sk.kd_var_guna_keluar=vk.kd_var_guna_keluar LEFT JOIN variabel_guna_masuk vm ON sk.kd_var_guna_masuk=vm.kd_var_guna_masuk")): ?>
                        <?php $no = 1; ?>
                        <?php while($data = $query->fetch_array()): ?>
                            <tr>
                                <td><?=$no++?></td>
                                <td><?=$data['nama_var_guna_keluar']?></td>
                                <td><?=$data['nama_var_guna_masuk']?></td>
                                <td><?=$data['nama_sub_var_guna_keluar']?></td>
                                <td><?=$data['jumlah_sk']?></td>
                                <td class="hidden-print">
                                    <div class="btn-group">
                                        <a href="?halaman=sub_var_guna_keluar&action=update&id=<?=$data['kd_sub_var_guna_keluar']?>" class="btn btn-warning btn-xs">Edit</a>
                                        <a href="?halaman=sub_var_guna_keluar&action=delete&id=<?=$data['kd_sub_var_guna_keluar']?>" class="btn btn-danger btn-xs">Hapus</a>
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