<?php if ( ! isset($_SESSION['is_logged'])) header('location: login.php');?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($koneksi->query("INSERT INTO pengambilan_dana VALUES(NULL, $_POST[kd_var_guna_masuk], $_POST[kd_komp_sub_var_guna], $_POST[jumlah])")) {
        echo "<script>alert('Berhasil diinput!'); window.location='?halaman=pengambilan_dana';</script>";
    } else {
        echo "<script>alert('Gagal diinput!'); window.location='?halaman=pengambilan_dana';</script>";
    }
}
if (isset($_GET['action']) AND $_GET['action'] == 'delete') {
    $koneksi->query("DELETE FROM pengambilan_dana WHERE kd_pengambilan_dana=$_GET[id]");
    echo "<script>alert('Berhasil dihapus!'); window.location='?halaman=pengambilan_dana';</script>";
}
?>
<div class="row">
    <div class="col-md-4 hidden-print">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="text-center">TAMBAH</h3></div>
            <div class="panel-body">
                <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
                    <div class="form-group">
                        <label for="kd_komp_sub_var_guna">Dana Keluar</label>
                        <select name="kd_komp_sub_var_guna" class="form-control" required="on">
                            <option value="">---</option>
                            <?php if($query = $koneksi->query("SELECT * FROM komponen_sub_var_guna")): ?>
                                <?php while($row = $query->fetch_assoc()): ?>
                                    <option value="<?= $row['kd_komp_sub_var_guna'] ?>"><?= $row['nama_komp_sub_var_guna'] ?></option>
                                <?php endwhile ?>
                            <?php endif ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kd_var_guna_masuk">Dana Masuk</label>
                        <select name="kd_var_guna_masuk" class="form-control" required="on">
                            <option value="">---</option>
                            <?php if($query_1 = $koneksi->query("SELECT * FROM variabel_guna_masuk")): ?>
                                <?php while($row_1 = $query_1->fetch_assoc()): ?>
                                    <option value="<?= $row_1['kd_var_guna_masuk'] ?>"><?= $row_1['nama_var_guna_masuk'] ?></option>
                                <?php endwhile ?>
                            <?php endif ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Dana yang Diambil</label>
                        <input type="text" name="jumlah" class="form-control">
                    </div>
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
                        <th>Dana Keluar</th>
                        <th>Dana Masuk</th>
                        <th>Jumlah Dana</th>
                        <th class="hidden-print"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($query = $koneksi->query("SELECT *, p.jumlah AS jml FROM pengambilan_dana p JOIN komponen_sub_var_guna k ON p.kd_komp_sub_var_guna=k.kd_komp_sub_var_guna JOIN variabel_guna_masuk v ON p.kd_var_guna_masuk=v.kd_var_guna_masuk ")): ?>
                        <?php $no = 1; ?>
                        <?php while($data = $query->fetch_array()): ?>
                            <tr>
                                <td><?=$no++?></td>
                                <td><?=$data['nama_komp_sub_var_guna']?></td>
                                <td><?=$data['nama_var_guna_masuk']?></td>
                                <td><?=$data['jml']?></td>
                                <td class="hidden-print">
                                    <div class="btn-group">
                                        <a href="?halaman=pengambilan_dana&action=update&id=<?=$data['kd_pengambilan_dana']?>" class="btn btn-warning btn-xs">Edit</a>
                                        <a href="?halaman=pengambilan_dana&action=delete&id=<?=$data['kd_pengambilan_dana']?>" class="btn btn-danger btn-xs">Hapus</a>
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