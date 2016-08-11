<?php if ( ! isset($_SESSION['is_logged'])) header('location: login.php');?>

<?php
if (isset($_POST['form']) AND $_POST['form'] == 'true') {
    $status = false;
    $query_1 = $koneksi->query("SELECT jumlah FROM kriteria_masuk WHERE kd_kriteria=$_POST[kd_kriteria]");
    $query_2 = $koneksi->query("SELECT SUM(jumlah) AS jml FROM sub_kriteria WHERE kd_kriteria=$_POST[kd_kriteria]");
    $row_1 = $query_1->fetch_assoc();
    $row_2 = $query_2->fetch_assoc();
    if (is_null($row_2['jml'])) {
        $status = ($_POST['jumlah'] > $row_1['jumlah']) ? false : true;
    } else {
        $status = ($row_1['jumlah'] == $row_2['jml']) ? false : true;
    }
    if ($status) {
        if ($koneksi->query("INSERT INTO sub_kriteria VALUES(NULL, $_POST[kd_kriteria], '$_POST[nama_sub_kriteria]', $_POST[jumlah])")) {
            echo "<script>alert('Berhasil diinput!'); window.location='?halaman=sub_kriteria';</script>";
        } else {
            echo "<script>alert('Gagal diinput!'); window.location='?halaman=sub_kriteria';</script>";
        }
    } else {
        echo "<script>alert('Jumlah terlalu besar!'); window.location='?halaman=sub_kriteria';</script>";
    }
}
if (isset($_GET['action']) AND $_GET['action'] == 'delete') {
    $koneksi->query("DELETE FROM sub_kriteria WHERE kd_sub_kriteria=$_GET[id]");
    echo "<script>alert('Berhasil dihapus!'); window.location='?halaman=sub_kriteria';</script>";
}
?>
<div class="row">
    <div class="col-md-4 hidden-print">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="text-center">TAMBAH</h3></div>
            <div class="panel-body">
                <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
                    <div class="form-group">
                        <label for="kd_kriteria">Kriteria</label>
                        <select name="kd_kriteria" class="form-control">
                            <option value="" selected="on">---</option>
                            <?php if ($query = $koneksi->query("SELECT * FROM kriteria_masuk")): ?>
                                <?php while ($data = $query->fetch_array()): ?>
                                    <option value="<?=$data['kd_kriteria']?>"><?=$data['nama_kriteria_masuk']?></option>
                                <?php endwhile ?>
                            <?php endif ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_sub_kriteria">Nama Sub Kriteria</label>
                        <input type="text" name="nama_sub_kriteria" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" value="0">
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
                        <th>Kriteria</th>
                        <th>Sub Kriteria</th>
                        <th>Jumlah</th>
                        <th class="hidden-print"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($query = $koneksi->query("SELECT kd_sub_kriteria, nama_kriteria_masuk, nama_sub_kriteria, s.jumlah AS jumlah_s FROM sub_kriteria s LEFT JOIN kriteria_masuk k ON k.kd_kriteria=s.kd_kriteria")): ?>
                        <?php $no = 1; ?>
                        <?php while($data = $query->fetch_array()): ?>
                            <tr>
                                <td><?=$no++?></td>
                                <td><?=$data['nama_kriteria_masuk']?></td>
                                <td><?=$data['nama_sub_kriteria']?></td>
                                <td>Rp.<?=number_format($data['jumlah_s'])?>,-</td>
                                <td class="hidden-print">
                                    <div class="btn-group">
                                        <a href="?halaman=sub_kriteria&action=update&id=<?=$data['kd_sub_kriteria']?>" class="btn btn-warning btn-xs">Edit</a>
                                        <a href="?halaman=sub_kriteria&action=delete&id=<?=$data['kd_sub_kriteria']?>" class="btn btn-danger btn-xs">Hapus</a>
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