<?php if ( ! isset($_SESSION['is_logged'])) header('location: login.php');?>

<div class="row">
    <div class="col-md-12">
        <h3 class="text-center">A. REKAPITULASI PENERIMAAN DAN ANGGARAN</h3>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th colspan="4">PENERIMAAN</th>
                    </tr>
                    <tr>
                        <th colspan="2">URAIAN</th>
                        <th>JUMLAH</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($a = $koneksi->query("SELECT * FROM kriteria_masuk")):?>
                        <?php $b = 0; ?>
                        <?php while($_a = $a->fetch_assoc()):?>
                                <tr>
                                    <td colspan="2"><strong><?=$_a['nama_kriteria_masuk']?></strong></td>
                                    <td><strong>Rp.<?=number_format($_a['jumlah'])?>,-</strong></td>
                                    <?php $b += $_a['jumlah']; ?>
                                </tr>
                                <?php if($aa = $koneksi->query("SELECT * FROM sub_kriteria WHERE kd_kriteria=$_a[kd_kriteria]")):?>
                                    <?php $bb = 0; ?>
                                    <?php while($_aa = $aa->fetch_assoc()):?>
                                        <tr>
                                            <td></td>
                                            <td><strong><?=$_aa['nama_sub_kriteria']?></strong></td>
                                            <td><strong>Rp.<?=number_format($_aa['jumlah'])?>,-</strong></td>
                                            <?php $bb += $_aa['jumlah']; ?>
                                        </tr>
                                        <?php if($aaa = $koneksi->query("SELECT * FROM variabel_guna_masuk WHERE kd_sub_kriteria=$_aa[kd_sub_kriteria]")):?>
                                        <?php $bbb = 0; ?>
                                            <?php while($_aaa = $aaa->fetch_assoc()):?>
                                                <tr>
                                                    <td></td>
                                                    <td>- <?=$_aaa['nama_var_guna_masuk']?></td>
                                                    <td>Rp.<?=number_format($_aaa['jumlah'])?>,-</td>
                                                    <?php $bbb += $_aaa['jumlah']; ?>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <tr>
                        <th colspan="2">JUMLAH PENERIMAAN</th>
                        <th><strong>Rp<?=number_format($b)?>.,-</strong></th>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th colspan="4">PENGELUARAN/BELANJA</th>
                    </tr>
                    <tr>
                        <th colspan="2">URAIAN</th>
                        <th>JUMLAH</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($a1 = $koneksi->query("SELECT * FROM kriteria_keluar")):?>
                        <?php $b1 = 0; ?>
                        <?php while($_a1 = $a1->fetch_assoc()):?>
                                <tr>
                                    <td colspan="2"><strong><?=$_a1['nama_kriteria_keluar']?></strong></td>
                                    <td><strong>Rp.<?=number_format($_a1['jumlah'])?>,-</strong></td>
                                    <?php $b1 += $_a1['jumlah']?>
                                </tr>
                                <?php if($aa2 = $koneksi->query("SELECT * FROM variabel_guna_keluar WHERE kd_kriteria_keluar=$_a1[kd_kriteria_keluar]")):?>
                                <?php $b2 = 0; ?>
                                    <?php while($_aa2 = $aa2->fetch_assoc()):?>
                                        <tr>
                                            <td></td>
                                            <td>- <?=$_aa2['nama_var_guna_keluar']?></td>
                                            <td>Rp.<?=number_format($_aa2['jumlah'])?>,-</td>
                                            <?php $b2 += $_aa2['jumlah']?>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <tr>
                        <th colspan="2">JUMLAH PENGELUARAN</th>
                        <th><strong>Rp<?=number_format($b1)?>.,-</strong></th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>