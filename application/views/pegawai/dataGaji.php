<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
    </div>

    <table class="table table-striped table-bordered">
        <tr class="bg-dark text-center text-white">
            <td>Bulan/Tahun</td>
            <td>Gaji Pokok</td>
            <td>Tunjangan Transportasi</td>
            <td>Uang Makan</td>
            <td>Potongan</td>
            <td>Total Gaji</td>
            <td>Cetak Slip</td>
        </tr>
        <?php foreach($potongan as $p ) : ?>
            <?php $potongan = $p->jml_potongan; ?>
        <?php endforeach; ?>
        <?php foreach($gaji as $g) : ?>
        <?php $pot_gaji = $g->alpha * $potongan  ?>
        <tr class="text-center">
            <td><?php echo $g->bulan ?></td>
            <td>Rp. <?php echo number_format($g->gaji_pokok, 0,',','.') ?></td>
            <td>Rp. <?php echo number_format($g->tj_transport, 0,',','.') ?></td>
            <td>Rp. <?php echo number_format($g->uang_makan, 0,',','.') ?></td>
            <td>Rp. <?php echo number_format($pot_gaji, 0,',','.') ?></td>
            <td>Rp. <?php echo number_format($g->gaji_pokok + $g->tj_transport + $g->uang_makan - $pot_gaji, 0,',','.') ?></td>
            <td>
                <center>
                    <a class="btn btn-primary" href="<?php echo base_url('pegawai/dataGaji/cetakSlip/' . $g->id_absensi) ?>"><i class="fas fa-print"></i></a>
                </center>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</div>
<!-- /.container-fluid -->