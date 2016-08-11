<?php if ( ! isset($_SESSION['is_logged'])) header('location: login.php');?>
<?php
$b1 = 0;
$b2 = 0;
$b3 = 0;
$b4 = 0;
$b5 = 0;

?>
<div class="row">
    <div class="col-md-12">
        <h3 class="text-center">B. RINCIAN PENGHITUNGAN PEMBELANJAAN TIAP KEGIATAN</h3>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2">URAIAN PENGGUNAAN</th>
                <th colspan="3">RINCIAN PENGHITUNGAN</th>
            </tr>
            <tr>
                <th>SATUAN</th>
                <th>HARGA SATUAN</th>
                <th>JUMLAH BIAYA</th>
            </tr>
            </thead>
            <tbody>
            <?php $no = 1;?>
            <?php if($a1 = $koneksi->query("SELECT * FROM kriteria_keluar")): ?>
                <?php while($_a1 = $a1->fetch_assoc()): ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td colspan="3"><strong><?=$_a1['nama_kriteria_keluar']?></strong></td>
                        <td><strong>Rp.<?=number_format($_a1['jumlah'])?>,-</strong></td>
                        <?php $b1 += $_a1['jumlah']; ?>
                    </tr>
                    <?php if($a2 = $koneksi->query("SELECT * FROM variabel_guna_keluar WHERE kd_kriteria_keluar=$_a1[kd_kriteria_keluar]")): ?>
                        <?php while($_a2 = $a2->fetch_assoc()): ?>
                            <tr>
                                <td></td>
                                <td colspan="3" style="padding-left: 10px;"><strong>- <?=$_a2['nama_var_guna_keluar']?></strong></td>
                                <td><strong>Rp.<?=number_format($_a2['jumlah'])?>,-</strong></td>
                                <?php $b2 += $_a2['jumlah']; ?>
                            </tr>
                            <?php if($a3 = $koneksi->query("SELECT * FROM sub_var_guna_keluar WHERE kd_var_guna_keluar=$_a2[kd_var_guna_keluar]")): ?>
                                <?php while($_a3 = $a3->fetch_assoc()): ?>
                                    <tr>
                                        <td></td>
                                        <td colspan="3" style="padding-left: 20px;">- <?=$_a3['nama_sub_var_guna_keluar']?></td>
                                        <td>Rp.<?=number_format($_a3['jumlah'])?>,-</td>
                                        <?php $b3 += $_a3['jumlah']; ?>
                                    </tr>
                                    <?php if($a4 = $koneksi->query("SELECT * FROM komponen_sub_var_guna WHERE kd_sub_var_guna_keluar=$_a3[kd_sub_var_guna_keluar]")): ?>
                                        <?php while($_a4 = $a4->fetch_assoc()): ?>
                                            <tr>
                                                <td></td>
                                                <td style="padding-left: 30px;">- <?=$_a4['nama_komp_sub_var_guna']?></td>
                                                <td><?=$_a4['satuan']?></td>
                                                <td>Rp.<?=number_format($_a4['harga'])?>,-</td>
                                                <td>Rp.<?=number_format($_a4['jumlah'])?>,-</td>
                                                <?php $b4 += $_a4['jumlah']; ?>
                                            </tr>
                                            <?php if($a5 = $koneksi->query("SELECT * FROM sub_komponen_sub_var_guna WHERE kd_komp_sub_var_guna=$_a4[kd_komp_sub_var_guna]")): ?>
                                                <?php while($_a5 = $a5->fetch_assoc()): ?>
                                                    <tr>
                                                        <td></td>
                                                        <td colspan="3" style="padding-left: 40px;">- <?=$_a5['nama_sub_komp_sub_var_guna']?></td>
                                                        <td>Rp.<?=number_format($_a5['jumlah'])?>,-</td>
                                                        <?php $b5 += $_a5['jumlah']; ?>
                                                    </tr>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>
            </tbody>
        </table>
        <table class="table table-hovered table-bordered">
            <thead>
                <tr>
                    <th>TOTAL KRITERIA KELUAR</th>
                    <th>TOTAL VARIABLE GUNA KELUAR</th>
                    <th>TOTAL SUB VARIABLE GUNA KELUAR</th>
                    <th>TOTAL KOMPONEN SUB VARIABLE GUNA KELUAR</th>
                    <th>TOTAL SUB KOMPONEN SUB VARIABLE GUNA KELUAR</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Rp.<?=number_format($b1)?>,-</td>
                    <td>Rp.<?=number_format($b2)?>,-</td>
                    <td>Rp.<?=number_format($b3)?>,-</td>
                    <td>Rp.<?=number_format($b4)?>,-</td>
                    <td>Rp.<?=number_format($b5)?>,-</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>