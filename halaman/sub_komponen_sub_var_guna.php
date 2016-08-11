<?php if ( ! isset($_SESSION['is_logged'])) header('location: login.php');?>

<?php
if (isset($_POST['form']) AND $_POST['form'] == 'true') {
    $status = false;
    $query_1 = $koneksi->query("SELECT jumlah FROM komponen_sub_var_guna WHERE kd_komp_sub_var_guna=$_POST[kd_komp_sub_var_guna]");
    $query_2 = $koneksi->query("SELECT SUM(jumlah) AS jml FROM sub_komponen_sub_var_guna WHERE kd_komp_sub_var_guna=$_POST[kd_komp_sub_var_guna]");
    $row_1 = $query_1->fetch_assoc();
    $row_2 = $query_2->fetch_assoc();
    $jum = $_POST['jumlah'] + $row_2['jml'];
    if ($row_2['jml'] == '') {
        $status = ($_POST['jumlah'] > $row_1['jumlah']) ? false : true;
    } else {
        $status = ($jum > $row_1['jumlah']) ? false : true;
    }
    if ($status) {
        if ($koneksi->query("INSERT INTO sub_komponen_sub_var_guna VALUES(NULL, $_POST[kd_komp_sub_var_guna], '$_POST[nama_sub_komp_sub_var_guna]', $_POST[jumlah])")) {
            echo "<script>alert('Berhasil diinput!'); window.location='?halaman=sub_komponen_sub_var_guna';</script>";
        } else {
            echo "<script>alert('Gagal diinput!'); window.location='?halaman=sub_komponen_sub_var_guna';</script>";
        }
    } else {
        echo "<script>alert('Jumlah terlalu besar!'); window.location='?halaman=sub_komponen_sub_var_guna';</script>";
    }
}
if (isset($_GET['action']) AND $_GET['action'] == 'delete') {
    $koneksi->query("DELETE FROM sub_komponen_sub_var_guna WHERE kd_sub_komp_sub_var_guna=$_GET[id]");
    echo "<script>alert('Berhasil dihapus!'); window.location='?halaman=sub_komponen_sub_var_guna';</script>";
}
?>
<div class="row">
    <div class="col-md-4 hidden-print">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="text-center">TAMBAH</h3></div>
            <div class="panel-body">
                <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
                    <div class="form-group">
                        <label for="kd_komp_sub_var_guna">Komponen Sub Var Guna</label>
                        <select name="kd_komp_sub_var_guna" class="form-control">
                            <option value="" selected="on">---</option>
                            <?php if ($query = $koneksi->query("SELECT * FROM komponen_sub_var_guna")): ?>
                                <?php while ($data = $query->fetch_array()): ?>
                                    <option value="<?=$data['kd_komp_sub_var_guna']?>"><?=$data['nama_komp_sub_var_guna']?></option>
                                <?php endwhile ?>
                            <?php endif ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_sub_komp_sub_var_guna">Nama Sub Komponen</label>
                        <input type="text" name="nama_sub_komp_sub_var_guna" class="form-control">
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
                        <th>Sub Var Guna Keluar</th>
                        <th>Komponen</th>
                        <th>Jumlah</th>
                        <th class="hidden-print"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($query = $koneksi->query("SELECT *, sk.jumlah AS jumlah_k FROM sub_komponen_sub_var_guna sk LEFT JOIN komponen_sub_var_guna ks ON sk.kd_komp_sub_var_guna=ks.kd_komp_sub_var_guna")): ?>
                        <?php $no = 1; ?>
                        <?php while($data = $query->fetch_array()): ?>
                            <tr>
                                <td><?=$no++?></td>
                                <td><?=$data['nama_komp_sub_var_guna']?></td>
                                <td><?=$data['nama_sub_komp_sub_var_guna']?></td>
                                <td>Rp.<?=number_format($data['jumlah_k'])?>,-</td>
                                <td class="hidden-print">
                                    <div class="btn-group">
                                        <a href="?halaman=sub_komponen_sub_var_guna&action=update&id=<?=$data['kd_sub_komp_sub_var_guna']?>" class="btn btn-warning btn-xs">Edit</a>
                                        <a href="?halaman=sub_komponen_sub_var_guna&action=delete&id=<?=$data['kd_sub_komp_sub_var_guna']?>" class="btn btn-danger btn-xs">Hapus</a>
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