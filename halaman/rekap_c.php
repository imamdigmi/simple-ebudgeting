<?php if ( ! isset($_SESSION['is_logged'])) header('location: login.php');?>

<div class="row">
    <div class="col-md-12">
        <?php if ($query = $koneksi->query("SELECT * FROM pengambilan_dana")) :?>
            <?php if ($query->num_rows == 0) :?>
                <h3 class="text-center text-danger">Belum ada penyusunan</h3>
            <?php else: ?>
                <h3 class="text-center">C. RINCIAN BERDASARKAN SUMBER DANA</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th rowspan="4">URAIAN</th>
                            <th rowspan="4">JUMLAH</th>
                            <th colspan="9">SUMBER DANA</th>
                        </tr>
                        <tr>
                            <th colspan="5">PEMERINTAH</th>
                            <th colspan="3">ORANG TUA/KOMITE</th>
<!--                            <th rowspan="3">LAINNYA SALDO</th>-->
                        </tr>
                        <tr>
                            <th colspan="2">RUTIN</th>
                            <th>BOS</th>
                            <th colspan="2">BANTUAN</th>
                            <th rowspan="2">DANA OPERASIONAL</th>
                            <th rowspan="2">DANA INSTITUSI</th>
                            <th rowspan="2">DANA KOMPUTER</th>
                        </tr>
                        <tr>
                            <th>GAJI PNS</th>
                            <th>DANA RUTIN</th>
                            <th>PUSAT</th>
                            <th>DAK</th>
                            <th>BANSOS</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $kriteria_keluar_query = $koneksi->query("SELECT * FROM kriteria_keluar"); ?>
                        <?php while ($a = $kriteria_keluar_query->fetch_assoc()) : ?>
                            <tr>
                                <td><strong><?= $a['nama_kriteria_keluar'] ?></strong></td>
                                <td><strong>Rp.<?= number_format($a['jumlah']) ?>,-</strong></td>
                                <?php for($i=1; $i<=8; $i++) :?>
                                    <td>0</td>
                                <?php endfor?>
                            </tr>
                            <?php $variabel_guna_keluar_query = $koneksi->query("SELECT * FROM variabel_guna_keluar WHERE kd_kriteria_keluar=$a[kd_kriteria_keluar]"); ?>
                            <?php while ($b = $variabel_guna_keluar_query->fetch_assoc()) : ?>
                                <tr>
                                    <td><strong>- <?= $b['nama_var_guna_keluar'] ?></strong></td>
                                    <td><strong>Rp.<?= $b['jumlah'] ?>,-</strong></td>
                                    <?php for($i=1; $i<=8; $i++) :?>
                                        <td>0</td>
                                    <?php endfor?>
                                </tr>
                                <?php $sub_var_guna_keluar_query = $koneksi->query("SELECT * FROM sub_var_guna_keluar WHERE kd_var_guna_keluar=$b[kd_var_guna_keluar]"); ?>
                                <?php while ($c = $sub_var_guna_keluar_query->fetch_assoc()) : ?>
                                    <tr>
                                        <td style="padding-left: 20px;">- <?= $c['nama_sub_var_guna_keluar'] ?></td>
                                        <td>Rp.<?= $c['jumlah'] ?>,-</td>
                                        <?php for($i=1; $i<=8; $i++) :?>
                                            <td>0</td>
                                        <?php endfor?>
                                    </tr>
                                    <?php $komponen_sub_var_guna_query = $koneksi->query("SELECT k.kd_komp_sub_var_guna, k.nama_komp_sub_var_guna, k.jumlah, p.jumlah AS jml, v.nama_var_guna_masuk FROM pengambilan_dana p JOIN komponen_sub_var_guna k ON p.kd_komp_sub_var_guna=k.kd_komp_sub_var_guna JOIN variabel_guna_masuk v ON p.kd_var_guna_masuk=v.kd_var_guna_masuk WHERE k.kd_sub_var_guna_keluar=$c[kd_sub_var_guna_keluar]"); ?>
                                    <?php while ($d = $komponen_sub_var_guna_query->fetch_assoc()) : ?>
                                        <tr>
                                            <td style="padding-left: 30px;">- <?= $d['nama_komp_sub_var_guna'] ?></td>
                                            <td>Rp.<?= $d['jumlah'] ?>,-</td>
                                            <?php if ($d['nama_var_guna_masuk'] == 'GAJI PNS') : ?>
                                                <td>Rp.<?= $d['jml'] ?>,-</td>
                                                <td colspan="7"></td>
                                            <?php elseif ($d['nama_var_guna_masuk'] == 'DANA RUTIN') : ?>
                                                <td></td>
                                                <td>Rp.<?= $d['jml'] ?>,-</td>
                                                <td colspan="6"></td>
                                            <?php elseif ($d['nama_var_guna_masuk'] == 'PUSAT') : ?>
                                                <td colspan="2"></td>
                                                <td>Rp.<?= $d['jml'] ?>,-</td>
                                                <td colspan="5"></td>
                                            <?php elseif ($d['nama_var_guna_masuk'] == 'DAK') : ?>
                                                <td colspan="3"></td>
                                                <td>Rp.<?= $d['jml'] ?>,-</td>
                                                <td colspan="4"></td>
                                            <?php elseif ($d['nama_var_guna_masuk'] == 'BANSOS') : ?>
                                                <td colspan="4"></td>
                                                <td>Rp.<?= $d['jml'] ?>,-</td>
                                                <td colspan="3"></td>
                                            <?php elseif ($d['nama_var_guna_masuk'] == 'DANA OPERSIONAL') : ?>
                                                <td colspan="5"></td>
                                                <td>Rp.<?= $d['jml'] ?>,-</td>
                                                <td colspan="2"></td>
                                            <?php elseif ($d['nama_var_guna_masuk'] == 'DANA INSTITUSI') : ?>
                                                <td colspan="6"></td>
                                                <td>Rp.<?= $d['jml'] ?>,-</td>
                                                <td></td>
                                            <?php elseif ($d['nama_var_guna_masuk'] == 'DANA KOMPUTER') : ?>
                                                <td colspan="7"></td>
                                                <td>Rp.<?= $d['jml'] ?>,-</td>
                                            <?php endif ?>
                                        </tr>
                                        <?php $sub_komponen_sub_var_guna_query = $koneksi->query("SELECT * FROM sub_komponen_sub_var_guna WHERE kd_komp_sub_var_guna=$d[kd_komp_sub_var_guna]"); ?>
                                        <?php while ($e = $sub_komponen_sub_var_guna_query->fetch_assoc()) : ?>
                                            <tr>
                                                <td style="padding-left: 40px;">- <?= $e['nama_sub_komp_sub_var_guna'] ?></td>
                                                <td>Rp.<?= $e['jumlah'] ?>,-</td>
                                                <?php for($i=1; $i<=8; $i++) :?>
                                                    <td>0</td>
                                                <?php endfor?>
                                            </tr>
                                        <?php endwhile ?>
                                    <?php endwhile ?>
                                <?php endwhile ?>
                            <?php endwhile ?>
                        <?php endwhile ?>
                        </tbody>
                    </table>
                </div>
            <?php endif ?>
        <?php endif ?>
    </div>
</div>