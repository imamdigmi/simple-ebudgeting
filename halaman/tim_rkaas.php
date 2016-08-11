<?php if ( ! isset($_SESSION['is_logged'])) header('location: login.php');?>

<?php
if (isset($_POST['form']) AND $_POST['form'] == 'true') {
    if ($koneksi->query("INSERT INTO tim_rkaas VALUES(NULL, '$_POST[username]', '$_POST[nama]', '".md5($_POST['password'])."', '$_POST[status]')")) {
        echo "<script>alert('Berhasil diinput!'); window.location='?halaman=tim_rkaas';</script>";
    } else {
        echo "<script>alert('Gagal diinput!'); window.location='?halaman=tim_rkaas';</script>";
    }
}
if (isset($_GET['action']) AND $_GET['action'] == 'delete') {
    $koneksi->query("DELETE FROM tim_rkaas WHERE id_tim_RKAAS=$_GET[id]");
    echo "<script>alert('Berhasil dihapus!'); window.location='?halaman=tim_rkaas';</script>";
}
?>
<div class="row">
    <div class="col-md-4 hidden-print">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="text-center">TAMBAH</h3></div>
            <div class="panel-body">
                <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <?php if($query = $koneksi->query("SELECT * FROM tim_rkaas WHERE status='ketua'")): ?>
                            <?php if($query->num_rows == 1): ?>
                                <input type="text" name="status" class="form-control disabled" disabled="disabled" value="anggota">
                                <input type="hidden" name="status" value="anggota">
                            <?php else: ?>
                                <select name="status" class="form-control">
                                    <option value="">---</option>
                                    <option value="ketua">Ketua</option>
                                    <option value="anggota">Anggota</option>
                                </select>
                            <?php endif ?>
                        <?php endif ?>
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
                        <th>Status</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th class="hidden-print"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($query = $koneksi->query("SELECT * FROM tim_rkaas")): ?>
                        <?php $no = 1; ?>
                        <?php while($data = $query->fetch_array()): ?>
                            <tr>
                                <td><?=$no++?></td>
                                <td><?=$data['status']?></td>
                                <td><?=$data['nama']?></td>
                                <td><?=$data['username']?></td>
                                <td class="hidden-print">
                                    <div class="btn-group">
                                        <a href="?halaman=tim_rkaas&action=update&id=<?=$data['id_tim_RKAAS']?>" class="btn btn-warning btn-xs">Edit</a>
                                        <a href="?halaman=tim_rkaas&action=delete&id=<?=$data['id_tim_RKAAS']?>" class="btn btn-danger btn-xs">Hapus</a>
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