<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            Input Absensi Pegawai
        </div>
        <div class="card-body">
            <form class="form-inline">
                <div class="form-group mb-2">
                    <label for="staticEmail2">Bulan :</label>
                    <select name="bulan" class="form-control ml-2">
                        <option value="">Pilih Bulan</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
                <div class="form-group mb-2 ml-3">
                    <label for="staticEmail2">Tahun :</label>
                    <select name="tahun" class="form-control ml-2">
                        <option value="">Pilih Tahun</option>
                        <?php $tahun = date('Y');
                        for ($i = 2020; $i < $tahun + 5; $i++) { ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-dark mb-2 ml-3"><i class="fas fa-eye"></i> Generate</button>
            </form>
        </div>
    </div>

    <?php
    if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];
        $bulantahun = $bulan . $tahun;
    } else {
        $bulan = date('m');
        $tahun = date('Y');
        $bulantahun = $bulan . $tahun;
    }
    ?>
    <div class="alert alert-info mt-3">
        Menampilkan Data Kehadiran Pegawai Bulan : <span class="font-weight-bold"><?php echo $bulan ?></span> Tahun : <span class="font-weight-bold"><?php echo $tahun ?></span>
    </div>
    <form action="" method="post">
        <button class="btn btn-primary mb-2" type="submit" name="submit" value="submit">Simpan</button>
        <table class="table table-bordered table-hover mt-2">
            <thead class="bg-dark">
                <tr class="text-white">
                    <td class="text-center">No</td>
                    <td class="text-center">NIK</td>
                    <td class="text-center">Nama Pegawai</td>
                    <td class="text-center">Jenis Kelamin</td>
                    <td class="text-center">Jabatan</td>
                    <td class="text-center" style="width: 8%;">Hadir</td>
                    <td class="text-center" style="width: 8%;">Sakit</td>
                    <td class="text-center" style="width: 8%;">Alpha</td>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($input_absensi as $a) : ?>
                    <tr class="text-center">
                        <input type="hidden" name="bulan[]" class="form-control" value="<?php echo $bulantahun ?>">
                        <input type="hidden" name="nik[]" class="form-control" value="<?php echo $a->nik ?>">
                        <input type="hidden" name="nama_pegawai[]" class="form-control" value="<?php echo $a->nama_pegawai ?>">
                        <input type="hidden" name="jenis_kelamin[]" class="form-control" value="<?php echo $a->jenis_kelamin ?>">
                        <input type="hidden" name="nama_jabatan[]" class="form-control" value="<?php echo $a->nama_jabatan ?>">
                        <td><?php echo $no++ ?>.</td>
                        <td><?php echo $a->nik ?></td>
                        <td><?php echo $a->nama_pegawai ?></td>
                        <td><?php echo $a->jenis_kelamin ?></td>
                        <td><?php echo $a->nama_jabatan ?></td>
                        <td><input type="number" name="jml_hadir[]" class="form-control" value="0"></td>
                        <td><input type="number" name="sakit[]" class="form-control" value="0"></td>
                        <td><input type="number" name="alpha[]" class="form-control" value="0"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table><br><br>
    </form>
</div>
<!-- /.container-fluid -->