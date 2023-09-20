<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
    </div>

    <?php echo $this->session->flashdata('pesan') ?>
    <div class="container">
        <a class="btn btn-sm btn-primary mb-2 mt-2" href="<?php echo base_url('admin/potonganGaji/tambahData') ?>"><i class="fas fa-plus"></i> Tambah Data</a>
        <div class="container">
            <table class="table table-bordered table-hover mt-2">
                <thead class="bg-dark lg-9">
                    <tr class="text-center text-white">
                        <td>No</td>
                        <td>Jenis Potongan</td>
                        <td>Jumlah Potongan</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody class="text-dark">
                    <?php $no = 1;
                    foreach ($pot_gaji as $p) : ?>
                        <tr class="text-center">
                            <td><?php echo $no++ ?>.</td>
                            <td><?php echo $p->potongan ?></td>
                            <td>Rp. <?php echo number_format($p->jml_potongan, 0, ',', '.') ?></td>
                            <td>
                                <center>
                                    <a class="btn btn-sm btn-primary mb-2 mt-2" href="<?php echo base_url('admin/potonganGaji/updateData/' . $p->id) ?>"><i class="fas fa-edit"></i></a>
                                    <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-sm btn-danger mb-2 mt-2" href="<?php echo base_url('admin/potonganGaji/deleteData/' . $p->id) ?>"><i class="fas fa-trash"></i></a>
                                </center>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>